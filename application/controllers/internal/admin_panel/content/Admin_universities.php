<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_universities extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('universities_model');
        $this->load->model('events_model');
        $this->load->model('rd_projects_model');

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
        $data['include_js'] = 'admin_universities_list';
        $data['title'] = 'Admin | Universities';
        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/admin_panel/content/admin_universities_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function admin_all_universities_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $uni_data = $this->universities_model->all_uni_by_date();

        $data = array();

        foreach ($uni_data as $r) {

            $view = '<span><button type="button" onclick="view_admin_university(' . $r->uni_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_admin_uni"><span class="fas fa-eye"></span></button></span>';

            if ($r->uni_approval == 1) {
                $approval = '<span><button type="button" style = "cursor: default;" class="btn icon-btn btn-xs btn-success waves-effect waves-light">Approved</button></span>';
            } else {
                $approval = '<span><button type="button" onclick="edit_approval(' . $r->uni_id . ')" class="btn icon-btn btn-xs btn-warning waves-effect waves-light">Pending</button></span>';
            }

            $data[] = array(
                '',
                $r->uni_name,
                $r->uni_country,
                $r->uni_email,
                $r->uni_submitdate,
                $approval,
                $view,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($uni_data),
            "recordsFiltered" => count($uni_data),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function admin_pending_universities_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $uni_data = $this->universities_model->all_pending_uni_by_date();

        $data = array();

        foreach ($uni_data as $r) {

            $view = '<span><button type="button" onclick="view_admin_university(' . $r->uni_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_admin_uni"><span class="fas fa-eye"></span></button></span>';

            if ($r->uni_approval == 1) {
                $approval = '<span><button type="button" style = "cursor: default;" class="btn icon-btn btn-xs btn-success waves-effect waves-light">Approved</button></span>';
            } else {
                $approval = '<span><button type="button" onclick="edit_approval(' . $r->uni_id . ')" class="btn icon-btn btn-xs btn-warning waves-effect waves-light">Pending</button></span>';
            }
            $checkbox = '<input type="checkbox" onclick="check(' . $r->uni_id . ')" value=' . $r->uni_id . ' id=' . $r->uni_id . '>';


            $data[] = array(
                $checkbox,
                '',
                $r->uni_name,
                $r->uni_country,
                $r->uni_email,
                $r->uni_submitdate,
                $approval,
                $view,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($uni_data),
            "recordsFiltered" => count($uni_data),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function view_admin_university()
    {

        $uni_detail = $this->universities_model->get_uni_detail($this->input->post('uni_id'));
        $total_event = $this->events_model->get_totalevent_for_uni($this->input->post('uni_id'));

        if ($uni_detail->uni_approval) {
            $approval = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
        } else {
            $approval = '<button type="button" style = "cursor: default;" class="btn btn-warning">Pending</button>';
        }

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr style = "display:none;"><td colspan="2"></td></tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/universities/") . $uni_detail->uni_logo . '" style="width: 250px; height: 100px; object-fit:contain;"></td>
                </tr> 
                <tr>
                    <th scope="row">Submitted Date</th>
                    <td>' . $uni_detail->uni_submitdate . '</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>' . $approval . '</td>
                </tr>
                <tr>
                    <th scope="row">University Name</th>
                    <td>' . $uni_detail->uni_name . '</td>
                </tr>
                <tr>
                <th scope="row">Country</th>
                    <td>' . $uni_detail->uni_country . '</td>
                </tr>
                <tr>
                    <th scope="row">Hotline</th>
                    <td>' . $uni_detail->uni_hotline . '</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>' . $uni_detail->uni_email . '</td>
                </tr>
                <tr>
                <th scope="row">Address</th>
                    <td>' . $uni_detail->uni_address . '</td>
                </tr>
                <tr>
                    <th scope="row">QS Ranking</th>
                    <td>' . $uni_detail->uni_qsrank . '</td>
                </tr>
                <tr>
                    <th scope="row">Employability Ranking</th>
                    <td>' . $uni_detail->uni_employabilityrank . '</td>
                </tr>
                <tr>
                    <th scope="row">Total Students</th>
                    <td>' . $uni_detail->uni_totalstudents . '</td>
                </tr>
                <tr>
                    <th scope="row">Total Events</th>
                    <td>' . $total_event . '</td>
                </tr>
                <tr>
                    <th scope="row">Official Website</th>
                    <td><a href="' . $uni_detail->uni_website . '" target="_blank">' . $uni_detail->uni_website . '</a></td>
                </tr>
                <tr>
                    <th scope="row">Shortprofile</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $uni_detail->uni_shortprofile . '</td>
                </tr>
                <tr>
                    <th scope="row">Fun Fact</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $uni_detail->uni_fun_fact . '</td>
                </tr>
                <tr style = "background-color:white;">
                    <th scope="row">Background Image</th>
                    <td><img src="' . base_url("assets/img/universities/") . $uni_detail->uni_background . '" style="width: 350px; height: 200px; object-fit:contain;"></td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

    function edit_one_approval()
    {
        $this->universities_model->edit_one_approval($this->input->post('uni_id'));
    }

    function approve_uni()
    {
        $data = ['uni_approval' => 1];
        $this->universities_model->update($data, $this->input->post('uni_id'));
    }
}
