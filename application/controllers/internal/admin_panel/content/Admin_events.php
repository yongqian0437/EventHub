<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_events extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('universities_model');
        $this->load->model('events_model');
        $this->load->model('event_applicants_model');

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
        $data['include_js'] = 'admin_events_list';
        $data['title'] = 'Admin | Events';
        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/admin_panel/content/admin_events_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function admin_events_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $events = $this->events_model->event_join_uni();

        $data = array();

        foreach ($events as $r) {

            $view = '<span><button type="button" onclick="view_admin_event(' . $r->event_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_my_rd_project"><span class="fas fa-eye"></span></button></span>';

            $data[] = array(
                '',
                $r->uni_name,
                $r->event_name,
                $r->event_type,
                $r->event_level,
                $view,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($events),
            "recordsFiltered" => count($events),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function view_admin_event()
    {

        $event = $this->events_model->one_event_join_uni($this->input->post('event_id'));
        $total_event = $this->events_model->get_totalevent_for_uni($event->uni_id);

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>event DETAILS</center></th>
                </tr>
                <tr>
                    <th scope="row">event Name</th>
                    <td>' . $event->event_name . '</td>
                </tr>
                <tr>
                    <th scope="row">event Area</th>
                    <td>' . $event->event_type . '</td>
                </tr>
                <tr>
                    <th scope="row">level</th>
                    <td>' . $event->event_level . '</td>
                </tr>
                <tr>
                    <th scope="row">Duration</th>
                    <td>' . $event->event_duration . '</td>
                </tr>
                <tr>
                    <th scope="row">Malaysian based Fee (MYR)</th>
                    <td>RM ' . number_format($event->event_fee) . '</td>
                </tr>
             
                <tr>
                    <th scope="row">Intake</th>
                    <td>' . $event->event_intake . '</td>
                </tr>
                <tr>
                    <th scope="row">Career Opportunities</th>
                    <td>' . $event->event_careeropportunities    . '</td>
                </tr>
                <tr>
                    <th scope="row">Structure</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $event->event_structure . '</td>
                </tr>
                <tr>
                    <th scope="row">Shortprofile</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $event->event_shortprofile . '</td>
                </tr>
                <tr>
                    <th scope="row">Requirements</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $event->event_requirements . '</td>
                </tr>
                <tr>
                    <th olspan="2" style = "background-color: white;" scope="row"></th>        
                <tr>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>UNIVERSITY DETAILS</center></th>
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/universities/") . $event->uni_logo . '" style="width: 250px; height: 100px; object-fit:contain;"></td>
                </tr> 
                <tr>
                    <th scope="row">University Name</th>
                    <td>' . $event->uni_name . '</td>
                </tr>
                <tr>
                <th scope="row">Country</th>
                    <td>' . $event->uni_country . '</td>
                </tr>
                <tr>
                    <th scope="row">Hotline</th>
                    <td>' . $event->uni_hotline . '</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>' . $event->uni_email . '</td>
                </tr>
                <tr>
                <th scope="row">Address</th>
                    <td>' . $event->uni_address . '</td>
                </tr>
                <tr>
                    <th scope="row">QS Ranking</th>
                    <td>' . $event->uni_qsrank . '</td>
                </tr>
                <tr>
                    <th scope="row">Employability Ranking</th>
                    <td>' . $event->uni_employabilityrank . '</td>
                </tr>
                <tr>
                    <th scope="row">Total Events</th>
                    <td>' . $total_event . '</td>
                </tr>
                <tr>
                    <th scope="row">Total Students</th>
                    <td>' . $event->uni_totalstudents . '</td>
                </tr>
                <tr>
                    <th scope="row">Official Website</th>
                    <td><a href="' . $event->uni_website . '" target="_blank">' . $event->uni_website . '</a></td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }
}
