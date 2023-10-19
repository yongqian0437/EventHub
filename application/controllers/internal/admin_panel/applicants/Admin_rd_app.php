<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_rd_app extends CI_Controller
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

        // Checks if session is set and if user signed in is not admin. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Admin") {

            $users['user_role'] = $this->session->userdata('user_role');

            if ($users['user_role'] == "Student") {
                redirect('external/homepage');
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
            else if ($users['user_role'] == "Education Partner") {
                redirect('internal/level_2/educational_partner/Ep_dashboard');
            }
        }
    }

    public function index()
    {

        $data['title'] = 'Admin | R&D Project Applications';
        // $data['c'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id')); 
        $data['include_js'] = 'admin_rd_app';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/admin_panel/applicants/admin_rd_app_view');
        $this->load->view('internal/templates/footer');
    }

    public function admin_rd_project_app_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        //get rd project details with ep_id
        $rd_project_app_data = $this->rd_applicants_model->sort_select_all();

        $data = array();
        $base_url = base_url();

        foreach ($rd_project_app_data as $r) {

            $rd_data = $this->rd_projects_model->get_rd_details($r->rd_id);
            $ep_owner = $this->rd_applicants_model->get_ep_partner_detail($r->ep_owner_id);
            $ep_collab = $this->rd_applicants_model->get_ep_partner_detail($r->ep_collab_id);

            $view = '<span><button type="button" onclick="view_rd_project(' . $r->rd_applicant_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_my_rd_project"><span class="fas fa-eye"></span></button></span>';

            $data[] = array(
                '',
                $rd_data->rd_title,
                $ep_owner->organizer_name,
                $ep_collab->organizer_name,
                $r->rd_app_submitdate,
                $view,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($rd_project_app_data),
            "recordsFiltered" => count($rd_project_app_data),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function view_admin_rd_project_app()
    {

        $rd_applicant_data = $this->rd_applicants_model->get_one_rd_applicant($this->input->post('rd_applicant_id'));

        $rd_data = $this->rd_projects_model->get_rd_details($rd_applicant_data->rd_id);
        $ep_owner = $this->rd_applicants_model->get_ep_partner_detail($rd_applicant_data->ep_owner_id);
        $ep_collab = $this->rd_applicants_model->get_ep_partner_detail($rd_applicant_data->ep_collab_id);

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>OWNER DETAILS</center></th>
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/organizer/") . $ep_owner->organizer_logo . '" style="width: 250px; height: 100px; object-fit:contain;"></td>
                </tr> 
                <tr>
                <th scope="row">organizers Name</th>
                    <td>' . $ep_owner->organizer_name . '</td>
                </tr>
                <tr>
                    <th scope="row">organizers Country</th>
                    <td>' . $ep_owner->organizer_country . '</td>
                </tr>
                <tr>
                    <th scope="row">Owner Name</th>
                    <td>' . $ep_owner->user_fname . ' ' . $ep_owner->user_lname . '</td>
                </tr>
                <tr>
                    <th scope="row">Business Email</th>
                    <td>' . $ep_owner->ep_businessemail . '</td>
                </tr>
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>' . $ep_owner->ep_phonenumber . '</td>
                </tr>
                <tr>
                    <th scope="row">Nationality</th>
                    <td>' . $ep_owner->ep_nationality . '</td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td>' . $ep_owner->ep_gender . '</td>
                </tr>
                <tr>
                    <th scope="row">Job Title</th>
                    <td>' . $ep_owner->ep_jobtitle . '</td>
                </tr>
                <tr>
                    <th colspan="2" style = "background-color: white;" scope="row"></th>        
                <tr>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>COLLABORATOR DETAILS</center></th>
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/organizer/") . $ep_collab->organizer_logo . '" style="width: 250px; height: 100px; object-fit:contain;"></td>
                </tr> 
                <tr>
                <th scope="row">organizers Name</th>
                    <td>' . $ep_collab->organizer_name . '</td>
                </tr>
                <tr>
                    <th scope="row">organizers Country</th>
                    <td>' . $ep_collab->organizer_country . '</td>
                </tr>
                <tr>
                    <th scope="row">Collaborator Name</th>
                    <td>' . $ep_collab->user_fname . ' ' . $ep_collab->user_lname . '</td>
                </tr>
                <tr>
                    <th scope="row">Business Email</th>
                    <td>' . $ep_collab->ep_businessemail . '</td>
                </tr>
                <tr>
                <th scope="row">Phone Number</th>
                    <td>' . $ep_collab->ep_phonenumber . '</td>
                </tr>
                <tr>
                <th scope="row">Nationality</th>
                    <td>' . $ep_collab->ep_nationality . '</td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td>' . $ep_collab->ep_gender . '</td>
                </tr>
                <tr>
                    <th scope="row">Job Title</th>
                    <td>' . $ep_collab->ep_jobtitle . '</td>
                </tr>
                <tr>
                    <th colspan="2" style = "background-color: white;" scope="row"></th>        
                <tr>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>R&D PROJECT DETAILS</center></th>        
                <tr>
                    <th scope="row">Project Title</th>
                    <td>' . $rd_data->rd_title . '</td>
                </tr>
                <tr>
                    <th scope="row">Organisation</th>
                    <td>' . $rd_data->rd_organisation . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in Charge</th>
                    <td>' . $rd_data->rd_pic . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in Charge Email</th>
                    <td>' . $rd_data->rd_pic_email . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in Charge Position</th>
                    <td>' . $rd_data->rd_pic_post . '</td>
                </tr>
                <tr>
                    <th scope="row">Person in Charge Department</th>
                    <td>' . $rd_data->rd_pic_dept . '</td>
                </tr>
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="' . base_url("assets/uploads/rd_projects/") . $rd_data->rd_document . '" target="_blank">' . $rd_data->rd_document . '</a></td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }
}
