<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ea_event_application extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model(['user_model', 'event_applicants_model', 'organizer_model', 'events_model']);
        $this->load->library('form_validation');
        $this->load->helper('form');

        // Checks if session is set and if user is signed in as Level 2 user (authorised access). If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is not ea. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Education Agent") {

            $users['user_role'] = $this->session->userdata('user_role');

            if ($users['user_role'] == "Admin") {
                redirect('internal/admin_panel/Admin_dashboard');
            }
            // check user role is Student
            else if ($users['user_role'] == "Student") {
                redirect('external/homepage');
            }
            // check user role is AC
            else if ($users['user_role'] == "Academic Counsellor") {
                redirect('internal/level_2/academic_counsellor/Ac_dashboard');
            }
            // check user role is E
            else if ($users['user_role'] == "Employer") {
                redirect('internal/level_2/employer/Employer_dashboard');
            }
            // check user role is  EP
            else if ($users['user_role'] == "Education Partner") {
                redirect('internal/level_2/educational_partner/Ep_dashboard');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'EventHub | event Applications';
        $data['include_js'] = 'ea_event_application_list';
        $user_id = $this->session->userdata('user_id');


        $data['event_applicants'] = $this->event_applicants_model->get_user_id($user_id);

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/education_agent/ea_event_application_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function add_event_application()
    {
        $data['title'] = 'EventHub | Add Student Applicant';
        $data['include_js'] = 'ea_event_application_add';
        $data['users'] = $this->user_model->search_email();
        $data['event_data'] = $this->organizer_model->select_all_approved_only();

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav', $data);
        $this->load->view('internal/templates/topbar', $data);
        $this->load->view('internal/level_2/education_agent/ea_event_application_add_view', $data);
        $this->load->view('internal/templates/footer');
    }

    function fetch_events()
    {
        echo $this->events_model->fetch_events_id($this->input->post('organizer_id'));
    }

    public function upload_doc($path, $file_input_name)
    {
        if ($_FILES) {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_input_name)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" id="alert_message">
                The file format is not correct</div>');
                // redirect('internal/level_2/ea_event_application/submit_added_registration_page');
            } else {
                $doc_data = ($this->upload->data());
                return $doc_data;
            }
        }
    }

    public function submit_added_event_applicant()
    {
        $data['title'] = "EventHub | event Applicant Registration";
        $get_event_id = $this->events_model->fetch_events_id($this->input->post('organizer_id'));
        $this->form_validation->set_rules('e_applicant_phonenumber', 'Phone Number', 'required|trim|min_length[5]', [
            'min_length' => 'Phone number too short'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "EventHub | event Applicant Registration";
            $data['include_css'] = "forms";
            $this->load->view('internal/templates/header', $data);
            $this->load->view('internal/templates/sidenav', $data);
            $this->load->view('internal/templates/topbar', $data);
            $this->load->view('internal/level_2/education_agent/ea_event_application_add_view', $data);
            $this->load->view('internal/templates/footer');
        } else {

            $e_applicant_document = $this->upload_doc('./assets/uploads/event_applicants', 'e_applicant_document');
            $user_id = $this->session->userdata('user_id');
            $data =
                [
                    'e_applicant_method' => $user_id,
                    'e_applicant_fname' => htmlspecialchars($this->input->post('e_applicant_fname', true)),
                    'e_applicant_lname' => htmlspecialchars($this->input->post('e_applicant_lname', true)),
                    'e_applicant_phonenumber' => htmlspecialchars($this->input->post('e_applicant_phonenumber', true)),
                    'e_applicant_email' => htmlspecialchars($this->input->post('e_applicant_email', true)),
                    'e_applicant_nationality' => htmlspecialchars($this->input->post('e_applicant_nationality', true)),
                    'e_applicant_gender' => htmlspecialchars($this->input->post('e_applicant_gender', true)),
                    'e_applicant_dob' => htmlspecialchars($this->input->post('e_applicant_dob', true)),
                    'e_applicant_currentlevel' => htmlspecialchars($this->input->post('e_applicant_currentlevel', true)),
                    'e_applicant_address' => htmlspecialchars($this->input->post('e_applicant_address', true)),
                    'e_applicant_identification' => htmlspecialchars($this->input->post('e_applicant_identification', true)),
                    'event_id' => htmlspecialchars($this->input->post('event1_id', true)),
                    'e_applicant_document' => $e_applicant_document['file_name'],

                ];

            // insert data into database
            $this->event_applicants_model->insert($data);

            $this->session->set_flashdata('insert_message', 1);
            $this->session->set_flashdata('e_applicant_fname', $this->input->post('e_applicant_fname'));

            redirect('internal/level_2/education_agent/ea_event_application');
        }
    }

    public function event_application_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $event_applicants = $this->event_applicants_model->get_user_id($this->session->userdata('user_id'));

        $data = array();
        $base_url = base_url();

        foreach ($event_applicants as $ca) {
            $get_organizer_id = $this->events_model->get_organizer_id($ca->event_id); // get event id to get the org id

            foreach ($get_organizer_id as $details) {
                $get_organizer_name = $this->organizer_model->get_org_detail($details->organizer_id); // get org id to get the org name
            }

            $edit_link = $base_url . "internal/level_2/education_agent/ea_event_application/edit_event_applicant/" . $ca->e_applicant_id;

            $delete = '<span><button type="button" onclick="delete_event_applicant(' . $ca->e_applicant_id . ')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
            $edit_opt = '<span class = "px-1"><a type="button" href = "' . $edit_link . '"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
            $view = '<span><button type="button" onclick="view_event_applicant(' . $ca->e_applicant_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_event_application"><span class="fas fa-eye"></span></button></span>';

            $function = $view . $edit_opt . $delete;

            $data[] = array(
                '',
                $ca->e_applicant_fname . " " . $ca->e_applicant_lname,
                $ca->e_applicant_nationality,
                $ca->e_applicant_currentlevel,
                //    $ca->event_id,
                $get_organizer_name->organizer_name,
                $ca->c_app_submitdate,
                $function,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($event_applicants),
            "recordsFiltered" => count($event_applicants),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function edit_event_applicant($e_applicant_id)
    {
        $data['title'] = 'EventHub | Edit event Applicant';
        $data['include_js'] = 'ea_event_application_edit';
        $data['edit_event_applicant'] = $this->event_applicants_model->get_cas_with_id($e_applicant_id);
        // $data['edit_event_applicant']=$this->event_applicants_model->get_cas_with_id($data);
        $data['event_data'] = $this->organizer_model->select_all_approved_only();
        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/education_agent/ea_event_applicant_edit_view', $data);
        $this->load->view('internal/templates/footer');
    }


    function submit_edit_event_applicant($e_applicant_id)
    {
        $data['title'] = "EventHub | event Applicant Registration";

        if ($_FILES['e_applicant_document']['name'] != "") {
            $original_details = $this->event_applicants_model->ca_details($e_applicant_id);
            unlink('./assets/uploads/event_applicants/' . $original_details['e_applicant_document']);

            $e_applicant_document = $this->upload_doc('./assets/uploads/event_applicants', 'e_applicant_document');
            $data = [
                'e_applicant_document' => $e_applicant_document['file_name'],
            ];
            $this->event_applicants_model->update($data, $e_applicant_id);
        }

        $user_id = $this->session->userdata('user_id');
        $data =
            [
                'e_applicant_method' => $user_id,
                'e_applicant_fname' => htmlspecialchars($this->input->post('e_applicant_fname', true)),
                'e_applicant_lname' => htmlspecialchars($this->input->post('e_applicant_lname', true)),
                'e_applicant_phonenumber' => htmlspecialchars($this->input->post('e_applicant_phonenumber', true)),
                'e_applicant_email' => htmlspecialchars($this->input->post('e_applicant_email', true)),
                'e_applicant_nationality' => htmlspecialchars($this->input->post('e_applicant_nationality', true)),
                'e_applicant_gender' => htmlspecialchars($this->input->post('e_applicant_gender', true)),
                'e_applicant_dob' => htmlspecialchars($this->input->post('e_applicant_dob', true)),
                'e_applicant_currentlevel' => htmlspecialchars($this->input->post('e_applicant_currentlevel', true)),
                'e_applicant_address' => htmlspecialchars($this->input->post('e_applicant_address', true)),
                'e_applicant_identification' => htmlspecialchars($this->input->post('e_applicant_identification', true)),
                'event_id' => htmlspecialchars($this->input->post('event1_id', true)),

            ];

        $this->event_applicants_model->update($data, $e_applicant_id);

        // $this->session->set_flashdata('message','<div class="alert alert-success" role="alert" id="alert_message">
        // You have updated successfully</div>');

        $this->session->set_flashdata('edit_message', 1);
        $this->session->set_flashdata('e_applicant_fname', $this->input->post('e_applicant_fname'));

        redirect('internal/level_2/education_agent/ea_event_application');
    }


    function delete_event_applicant()
    {
        //$this->event_applicants_model->delete($this->input->post('e_applicant_id'));
        $ca_details = $this->event_applicants_model->ca_details($this->input->post('e_applicant_id'));
        unlink('./assets/uploads/event_applicants/' . $ca_details['e_applicant_document']);
        $this->event_applicants_model->delete($this->input->post('e_applicant_id'));
    }

    function view_event_applicant()
    {
        $ca_detail = $this->event_applicants_model->get_cas_id($this->input->post('e_applicant_id'));
        //$event_applicants=$this->event_applicants_model->get_user_id($this->session->userdata('user_id'));

        $get_organizer_id = $this->events_model->get_organizer_id($ca_detail->event_id); // get event id to get the org id

        foreach ($get_organizer_id as $details) {
            $org_details = $this->organizer_model->get_org_detail($details->organizer_id); // get org id to get the org name
        }

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th scope="row">Submitted Date</th>
                    <td>' . $ca_detail->c_app_submitdate . '</td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="2"><img src="' . base_url("assets/img/organizer/") . $org_details->organizer_logo . '" style="width: 250px; height: 100px; object-fit:contain;">
                    </td>  
                </tr>
                <tr>
                    <th scope="row">organizers</th>
                    <td>' . $org_details->organizer_name . '</td>
                </tr>
                <tr>
                    <th scope="row">event</th>
                    <td>' . $details->event_name . '</td>
                </tr>
                <tr>
                    <th scope="row">Full Name</th>
                    <td>' . $ca_detail->e_applicant_fname . ' ' . $ca_detail->e_applicant_lname . '</td>
                </tr>
               
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>' . $ca_detail->e_applicant_phonenumber . '</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>' . $ca_detail->e_applicant_email . '</td>
               </tr>
                <tr>
                    <th scope="row">Nationality</th>
                    <td>' . $ca_detail->e_applicant_nationality . '</td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td>' . $ca_detail->e_applicant_gender . '</td>
                </tr>
                <tr>
                    <th scope="row">DOB</th>
                    <td>' . $ca_detail->e_applicant_dob . '</td>
                </tr>
                <tr>
                    <th scope="row">Current Level</th>
                    <td>' . $ca_detail->e_applicant_currentlevel . '</td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td>' . $ca_detail->e_applicant_address . '</td>
                </tr>
                <tr>
                    <th scope="row">Identification</th>
                    <td>' . $ca_detail->e_applicant_identification . '</td>
                </tr>
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="' . base_url("assets/uploads/event_applicants/") . $ca_detail->e_applicant_document . '" target="_blank">' . $ca_detail->e_applicant_document . '</a></td>
            </tbody>
        </table>';

        echo $output;
    }
}
