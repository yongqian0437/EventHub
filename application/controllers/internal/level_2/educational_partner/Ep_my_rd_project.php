<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ep_my_rd_project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('user_ep_model');
        $this->load->model('rd_projects_model');
        $this->load->model('rd_applicants_model');
        $this->load->model('universities_model');

        // Checks if session is set and if user signed in has a role. If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is not ep. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Education Partner") {

            $users['user_role'] = $this->session->userdata('user_role');

            if ($users['user_role'] == "Admin") {
                redirect('internal/admin_panel/Admin_dashboard');
            }
            // check user role is  EA
            else if ($users['user_role'] == "Education Agent") {
                redirect('internal/level_2/education_agent/Ea_dashboard');
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
            else if ($users['user_role'] == "Student") {
                redirect('external/homepage');
            }
        }
    }

    public function index()
    {

        $data['title'] = 'EventHub | My R&D Project';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        // $data['c'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id')); 
        $data['include_js'] = 'ep_my_rd_list';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_my_rd_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function my_rd_project_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        //get uni detail for one ep user with user_id
        $event_data = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        //get ep details with user id
        $ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));
        //get rd project details with ep_id
        $rd_project_data = $this->user_ep_model->get_rd_for_ep($ep_data->ep_id);

        $data = array();
        $base_url = base_url();

        foreach ($rd_project_data as $r) {

            $edit_link = $base_url . "internal/level_2/educational_partner/ep_my_rd_project/edit_my_rd_project/" . $r->rd_id;

            $delete = '<span><button type="button" onclick="delete_my_rd_project(' . $r->rd_id . ')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
            $edit_opt = '<span class = "px-1"><a type="button" href = "' . $edit_link . '"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
            $view = '<span><button type="button" onclick="view_my_rd_project(' . $r->rd_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_my_rd_project"><span class="fas fa-eye"></span></button></span>';
            $function = $view . $edit_opt . $delete;

            if ($r->rd_approval) {
                $approval = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
            } else {
                $approval = '<button type="button" style = "cursor: default;" class="btn btn-warning">Pending</button>';
            }

            $data[] = array(
                '',
                $r->rd_title,
                $r->rd_organisation,
                $r->rd_pic,
                $r->rd_submitdate,
                $approval,
                $function,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($rd_project_data),
            "recordsFiltered" => count($rd_project_data),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function add_rd_project()
    {
        $data['title'] = 'EventHub | Add R&D Project';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_my_rd_add_view');
        $this->load->view('internal/templates/footer');
    }

    function submit_add_rd_project()
    {
        //get ep details with user id
        $ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));
        $rd_document = $this->upload_doc('./assets/uploads/rd_projects', 'rd_document');

        $data =
            [
                'ep_id' => $ep_data->ep_id,
                'rd_title' => htmlspecialchars($this->input->post('rd_title')),
                'rd_organisation' => htmlspecialchars($this->input->post('rd_organisation')),
                'rd_pic' => htmlspecialchars($this->input->post('rd_pic')),
                'rd_pic_post' => htmlspecialchars($this->input->post('rd_pic_post')),
                'rd_pic_dept' => htmlspecialchars($this->input->post('rd_pic_dept')),
                'rd_pic_email' => htmlspecialchars($this->input->post('rd_pic_email')),
                'rd_scope' => htmlspecialchars($this->input->post('rd_scope')),
                'rd_objective' => htmlspecialchars($this->input->post('rd_objective')),
                'rd_document' => $rd_document['file_name'],
                'rd_approval' => 0,
            ];


        $this->rd_projects_model->insert($data);

        $this->session->set_flashdata('insert_message', 1);
        $this->session->set_flashdata('rd_title', $this->input->post('rd_title'));

        redirect('internal/level_2/educational_partner/ep_my_rd_project');
    }

    function view_my_rd_project()
    {
        $rd_detail = $this->user_ep_model->get_one_rd_detail($this->input->post('rd_id'));

        if ($rd_detail->rd_approval) {
            $approval = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
        } else {
            $approval = '<button type="button" style = "cursor: default;" class="btn btn-warning">Pending</button>';
        }

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th scope="row">Submit Date</th>
                    <td>' . $rd_detail->rd_submitdate . '</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>' . $approval . '</td>
                </tr>
                <tr>
                    <th scope="row">Title</th>
                    <td>' . $rd_detail->rd_title . '</td>
                </tr>
                <tr>
                    <th scope="row">Organisation</th>
                    <td>' . $rd_detail->rd_organisation . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge</th>
                    <td>' . $rd_detail->rd_pic . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge position</th>
                    <td>' . $rd_detail->rd_pic_post . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge department</th>
                    <td>' . $rd_detail->rd_pic_dept . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge email</th>
                    <td>' . $rd_detail->rd_pic_email . '</td>
                </tr>
                <tr>
                    <th scope="row">R&D Scope</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $rd_detail->rd_scope . '</td>
                </tr>
                <tr>
                    <th scope="row">R&D Objective</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $rd_detail->rd_objective . '</td>
                </tr>
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="' . base_url("assets/uploads/rd_projects/") . $rd_detail->rd_document . '" target="_blank">' . $rd_detail->rd_document . '</a></td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

    function delete_my_rd_project()
    {
        $rd_data = $this->rd_projects_model->get_rd_details($this->input->post('rd_id'));
        unlink('./assets/uploads/rd_projects/' . $rd_data->rd_document);

        $this->rd_projects_model->delete($this->input->post('rd_id'));
        $this->rd_applicants_model->delete_rd_applicant_with_rd_id($this->input->post('rd_id'));
    }

    function edit_my_rd_project($rd_id)
    {
        $data['title'] = 'EventHub | Edit My R&D Project';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        $data['rd_detail'] = $this->user_ep_model->get_one_rd_detail($rd_id);

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_my_rd_edit_view');
        $this->load->view('internal/templates/footer');
    }

    function submit_edit_my_rd_project($rd_id)
    {
        //get ep details with user id
        $ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));

        if ($_FILES['rd_document']['name'] != "") {

            $rd_data = $this->rd_projects_model->get_rd_details($rd_id);
            unlink('./assets/uploads/rd_projects/' . $rd_data->rd_document);

            $rd_document = $this->upload_doc('./assets/uploads/rd_projects', 'rd_document');
            $data = [
                'rd_document' => $rd_document['file_name'],
            ];
            $this->rd_projects_model->update($data, $rd_id);
        }

        $data =
            [
                'ep_id' => $ep_data->ep_id,
                'rd_title' => htmlspecialchars($this->input->post('rd_title')),
                'rd_organisation' => htmlspecialchars($this->input->post('rd_organisation')),
                'rd_pic' => htmlspecialchars($this->input->post('rd_pic')),
                'rd_pic_post' => htmlspecialchars($this->input->post('rd_pic_post')),
                'rd_pic_dept' => htmlspecialchars($this->input->post('rd_pic_dept')),
                'rd_pic_email' => htmlspecialchars($this->input->post('rd_pic_email')),
                'rd_scope' => htmlspecialchars($this->input->post('rd_scope')),
                'rd_objective' => htmlspecialchars($this->input->post('rd_objective')),
            ];

        $this->rd_projects_model->update($data, $rd_id);

        $this->session->set_flashdata('edit_message', 1);
        $this->session->set_flashdata('rd_title', $this->input->post('rd_title'));

        redirect('internal/level_2/educational_partner/ep_my_rd_project');
    }

    public function upload_doc($path, $file_input_name)
    {
        if ($_FILES) {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_input_name)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                The file format is not correct</div>');
                redirect('user/login/Auth/ep_reg');
            } else {
                $doc_data = ($this->upload->data());
                return $doc_data;
            }
        }
    }
}
