<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ep_rd_applicants extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('user_ep_model');
        $this->load->model('rd_projects_model');
        $this->load->model('rd_applicants_model');
        $this->load->model('organizer_model');

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

    //===========================================================================================================================
    //============================================== My Application =============================================================
    //===========================================================================================================================

    public function index()
    {

        $data['title'] = 'EventHub | My R&D Applications';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        $data['include_js'] = 'ep_my_app_list_view';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_my_app_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function my_rd_project_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        //get ep details with user id
        $ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));

        //Get rd applicants that mathces ep_collab_id with current ep_id
        $rd_applicants_data = $this->rd_applicants_model->all_my_applications($ep_data->ep_id);

        $data = array();
        $base_url = base_url();

        foreach ($rd_applicants_data as $r) {

            $rd_owner_data = $this->rd_applicants_model->get_rd_owner_detail($r->rd_id);

            $delete = '<span><button type="button" onclick="delete_my_application(' . $r->rd_applicant_id . ')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
            $view = '<span class = "pr-1"><button type="button" onclick="view_my_application(' . $r->ep_owner_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_my_rd_project"><span class="fas fa-eye"></span></button></span>';
            $function = $view . $delete;


            $data[] = array(
                '',
                $rd_owner_data->rd_title,
                $rd_owner_data->rd_organisation,
                $rd_owner_data->rd_pic,
                $r->rd_app_submitdate,
                $function,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($rd_applicants_data),
            "recordsFiltered" => count($rd_applicants_data),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }


    function view_my_application()
    {
        $rd_owner_data = $this->rd_applicants_model->get_rd_owner_detail($this->input->post('rd_id'));

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th scope="row">Upload Date</th>
                    <td>' . $rd_owner_data->rd_submitdate . '</td>
                </tr>
                <tr>
                    <th scope="row">Title</th>
                    <td>' . $rd_owner_data->rd_title . '</td>
                </tr>
                <tr>
                    <th scope="row">Organisation</th>
                    <td>' . $rd_owner_data->rd_organisation . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge</th>
                    <td>' . $rd_owner_data->rd_pic . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge position</th>
                    <td>' . $rd_owner_data->rd_pic_post . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge department</th>
                    <td>' . $rd_owner_data->rd_pic_dept . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge email</th>
                    <td>' . $rd_owner_data->rd_pic_email . '</td>
                </tr>
                <tr>
                    <th scope="row">R&D Scope</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $rd_owner_data->rd_scope . '</td>
                </tr>
                <tr>
                    <th scope="row">R&D Objective</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $rd_owner_data->rd_objective . '</td>
                </tr>
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="' . base_url("assets/uploads/rd_projects/") . $rd_owner_data->rd_document . '" target="_blank">' . $rd_owner_data->rd_document . '</a></td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

    function delete_my_application()
    {
        $this->rd_applicants_model->delete($this->input->post('rd_applicant_id'));
    }


    //===========================================================================================================================
    //============================================== Project Partners ===========================================================
    //===========================================================================================================================

    function project_partners_page()
    {
        $data['title'] = 'EventHub | Project Partners';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        $data['include_js'] = 'ep_project_partners';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_project_partners_view');
        $this->load->view('internal/templates/footer');
    }

    public function project_partners_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        //get ep details with user id
        $ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));

        //Get rd applicants that mathces ep_collab_id with current ep_id
        $rd_applicants_data = $this->rd_applicants_model->all_project_partners($ep_data->ep_id);


        $data = array();
        $base_url = base_url();

        foreach ($rd_applicants_data as $r) {

            $rd_owner_data = $this->rd_applicants_model->get_rd_owner_detail($r->rd_id);

            $ep_partner = $this->rd_applicants_model->get_ep_partner_detail($r->ep_collab_id);


            $view = '<span class = "pr-1"><button type="button" onclick="view_project_partners(' . $r->rd_applicant_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_my_rd_project"><span class="fas fa-eye"></span></button></span>';
            $function = $view;

            $data[] = array(
                '',
                $ep_partner->user_fname . ' ' . $ep_partner->user_lname,
                $ep_partner->organizer_name,
                $rd_owner_data->rd_title,
                $rd_owner_data->rd_pic,
                $r->rd_app_submitdate,
                $function,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($rd_applicants_data),
            "recordsFiltered" => count($rd_applicants_data),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function view_project_partners()
    {
        $rd_applicant_data = $this->rd_applicants_model->get_one_rd_applicant($this->input->post('rd_applicant_id'));

        $rd_project_data =  $this->rd_applicants_model->get_rd_owner_detail($rd_applicant_data->rd_id);

        $ep_partner =  $this->rd_applicants_model->get_ep_partner_detail($rd_applicant_data->ep_collab_id);

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>PARTNER DETAILS</center></th>
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/organizer/") . $ep_partner->organizer_logo . '" style="width: 250px; height: 100px; object-fit:contain;"></td>
                </tr> 
                <tr>
                    <th scope="row">Partner Name</th>
                    <td>' . $ep_partner->user_fname . ' ' . $ep_partner->user_lname . '</td>
                </tr>
                <tr>
                    <th scope="row">Business Email</th>
                    <td>' . $ep_partner->ep_businessemail . '</td>
                </tr>
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>' . $ep_partner->ep_phonenumber . '</td>
                </tr>
                <tr>
                    <th scope="row">organizers</th>
                    <td>' . $ep_partner->organizer_name . '</td>
                </tr>
                <tr>
                    <th scope="row">organizers Country</th>
                    <td>' . $ep_partner->organizer_country . '</td>
                </tr>
                <tr>
                    <th olspan="2" style = "background-color: white;" scope="row"></th>        
                <tr>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>COLLABORATION PROJECT DETAIL</center></th>        
                <tr>
                    <th scope="row">Project Title</th>
                    <td>' . $rd_project_data->rd_title . '</td>
                </tr>
                <tr>
                    <th scope="row">Organisation</th>
                    <td>' . $rd_project_data->rd_organisation . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in Charge</th>
                    <td>' . $rd_project_data->rd_pic . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in Charge Email</th>
                    <td>' . $rd_project_data->rd_pic_email . '</td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }
}
