<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ac_event_applicants extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user_ac_model', 'event_applicants_model', 'organizer_model']);
        date_default_timezone_set('Asia/Kuala_Lumpur');

        // Checks if session is set and if user is signed in as Academic Counsellor (authorised access). If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is not ac. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Academic Counsellor") {

            $users['user_role'] = $this->session->userdata('user_role');

            if ($users['user_role'] == "Admin") {
                redirect('internal/admin_panel/Admin_dashboard');
            }
            // check user role is  EA
            else if ($users['user_role'] == "Education Agent") {
                redirect('internal/level_2/education_agent/Ea_dashboard');
            }
            // check user role is Student
            else if ($users['user_role'] == "Student") {
                redirect('external/homepage');
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
        $data['include_js'] = 'ac_event_applicants_list';

        $ac_details = $this->user_ac_model->ac_details($this->session->userdata('user_id'));
        $data['event_data'] = $this->organizer_model->uni_details($ac_details['organizer_id']);

        // $ac_details = $this->user_ac_model->ac_details($this->session->userdata('user_id'));
        // $event_applicants = $this->event_applicants_model->get_applicants_from_event($ac_details['ac_id'], $ac_details['organizer_id']);
        // var_dump($event_applicants); die;
        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/academic_counsellor/ac_event_app_list_view');
        $this->load->view('internal/templates/footer');
    }

    function event_applicants_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $ac_details = $this->user_ac_model->ac_details($this->session->userdata('user_id'));
        $event_applicants = $this->event_applicants_model->get_applicants_from_event($ac_details['organizer_id']);

        $data = array();
        $base_url = base_url();

        foreach ($event_applicants as $event_app) {

            $view = '<span><button type="button" onclick="view_event_applicant(' . $event_app['e_applicant_id'] . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_event_applicant"><span class="fas fa-eye"></span></button></span>';

            if ($event_app['user_role'] == 'Student') {
                $chat = '<span class = "px-1 "><a type="button" onclick="chat_with_event_applicant(\'' . str_replace("'", "\\'", $event_app['user_id']) . '\', \'' . str_replace("'", "\\'", $event_app['user_fname']) . '\', \'' . str_replace("'", "\\'", $event_app['user_lname']) . '\');")" id="' . $event_app['user_id'] . '" title="' . $event_app['user_fname'] . ' ' . $event_app['user_lname'] . '" class="btn icon-btn btn-xs btn-success waves-effect waves-light"><span class="fas fa-comment"></span></a></span>';
                $function = $view . $chat;
            } else {
                $function = $view;
            }

            $data[] = [
                '',
                $event_app['e_applicant_fname'] . ' ' . $event_app['e_applicant_lname'], // from event_applicants table
                $event_app['e_applicant_nationality'], // from event_applicants table
                $event_app['event_name'], // from events table
                $event_app['user_role'], // from user table
                $event_app['c_app_submitdate'], // from event_applicants table
                $function,
            ];
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

    function view_event_applicant()
    {
        $event_applicant_details = $this->event_applicants_model->event_applicant_details($this->input->post('e_applicant_id'));

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                <th scope="row">Date Applied</th>
                    <td>' . $event_applicant_details['c_app_submitdate'] . '</td>
                </tr>
                <tr>
                    <th scope="row">event Name</th>
                    <td>' . $event_applicant_details['event_name'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Full Name</th>
                    <td>' . $event_applicant_details['e_applicant_fname'] . ' ' . $event_applicant_details['e_applicant_lname'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>' . $event_applicant_details['e_applicant_phonenumber'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>' . $event_applicant_details['e_applicant_email'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Nationality</th>
                    <td>' . $event_applicant_details['e_applicant_nationality'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Identification</th>
                    <td>' . $event_applicant_details['e_applicant_identification'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td>' . $event_applicant_details['e_applicant_address'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td>' . $event_applicant_details['e_applicant_gender'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Date of Birth</th>
                    <td>' . $event_applicant_details['e_applicant_dob'] . '</td>
                </tr>
                <tr>
                    <th scope="row">Current Level</th>
                    <td>' . $event_applicant_details['e_applicant_currentlevel'] . '</td>
                </tr>            
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="' . base_url("assets/uploads/event_applicants/") . $event_applicant_details['e_applicant_document'] . '" target="_blank">' . $event_applicant_details['e_applicant_document'] . '</a></td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }
}
