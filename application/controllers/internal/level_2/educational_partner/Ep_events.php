<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ep_events extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('user_ep_model');
        $this->load->model('events_model');
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

    public function index()
    {

        $data['title'] = 'EventHub | Events';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        // $data['c'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id')); 
        $data['include_js'] = 'ep_event_list';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_event_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function event_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $event_data = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));

        $events = $this->user_ep_model->get_event_for_uni($event_data->organizer_id);

        $data = array();
        $base_url = base_url();

        foreach ($events as $r) {

            $edit_link = $base_url . "internal/level_2/educational_partner/ep_events/edit_event/" . $r->event_id;

            $delete = '<span><button type="button" onclick="delete_event(' . $r->event_id . ')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
            $edit_opt = '<span class = "px-1"><a type="button" href = "' . $edit_link . '"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
            $view = '<span><button type="button" onclick="view_event(' . $r->event_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_event"><span class="fas fa-eye"></span></button></span>';
            $function = $view . $edit_opt . $delete;

            $data[] = array(
                '',
                $r->event_name,
                $r->event_type,
                $r->event_intake,
                $r->event_duration,
                "RM " . number_format($r->event_fee),
                $function,
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

    function add_event()
    {
        $data['title'] = 'EventHub | Add event';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_event_add_view');
        $this->load->view('internal/templates/footer');
    }

    function submit_added_event($organizer_id)
    {
        $data =
            [
                'organizer_id' => $organizer_id,
                'event_name' => htmlspecialchars($this->input->post('event_name')),
                'event_type' => htmlspecialchars($this->input->post('event_type')),
                'event_level' => htmlspecialchars($this->input->post('event_level')),
                'event_duration' => htmlspecialchars($this->input->post('event_duration')),
                'event_fee' => $this->input->post('event_fee'),
                'event_shortprofile' => htmlspecialchars($this->input->post('event_shortprofile')),
                'event_structure' => htmlspecialchars($this->input->post('event_structure')),
                'event_requirements' => htmlspecialchars($this->input->post('event_requirements')),
                'event_country' => htmlspecialchars($this->input->post('event_country')),
                'event_intake' => htmlspecialchars($this->input->post('event_intake')),
                'event_careeropportunities' => htmlspecialchars($this->input->post('event_careeropportunities')),
            ];

        $this->events_model->insert($data);

        $this->session->set_flashdata('insert_message', 1);
        $this->session->set_flashdata('event_name', $this->input->post('event_name'));

        redirect('internal/level_2/educational_partner/ep_events');
    }

    function delete_event()
    {
        $this->events_model->delete($this->input->post('event_id'));
    }

    function edit_event($event_id)
    {
        $data['title'] = 'EventHub | Edit event';
        $data['event_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        $data['event_data'] = $this->user_ep_model->get_event_detail($event_id);

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_event_edit_view');
        $this->load->view('internal/templates/footer');
    }

    function submit_edit_event($event_id)
    {
        $event_data = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        $data =
            [
                'organizer_id' => $event_data->organizer_id,
                'event_name' => htmlspecialchars($this->input->post('event_name')),
                'event_type' => htmlspecialchars($this->input->post('event_type')),
                'event_level' => htmlspecialchars($this->input->post('event_level')),
                'event_duration' => htmlspecialchars($this->input->post('event_duration')),
                'event_fee' => $this->input->post('event_fee'),
                'event_shortprofile' => htmlspecialchars($this->input->post('event_shortprofile')),
                'event_structure' => htmlspecialchars($this->input->post('event_structure')),
                'event_requirements' => htmlspecialchars($this->input->post('event_requirements')),
                'event_country' => htmlspecialchars($this->input->post('event_country')),
                'event_intake' => htmlspecialchars($this->input->post('event_intake')),
                'event_careeropportunities' => htmlspecialchars($this->input->post('event_careeropportunities')),
            ];

        $this->events_model->update($data, $event_id);

        $this->session->set_flashdata('edit_message', 1);
        $this->session->set_flashdata('event_name', $this->input->post('event_name'));

        redirect('internal/level_2/educational_partner/ep_events');
    }

    function view_event()
    {
        $event_detail = $this->events_model->get_event_with_id($this->input->post('event_id'));

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th scope="row">Event Name</th>
                    <td>' . $event_detail[0]->event_name . '</td>
                </tr>
                <tr>
                    <th scope="row">Event Type</th>
                    <td>' . $event_detail[0]->event_type . '</td>
                </tr>
                 
                <tr>
                    <th scope="row">Duration</th>
                    <td>' . $event_detail[0]->event_duration . '</td>
                </tr>
                <tr>
                    <th scope="row">Malaysian based Fee (MYR)</th>
                    <td>RM ' . number_format($event_detail[0]->event_fee) . '</td>
                </tr>
                
                <tr>
                    <th scope="row">Contact</th>
                    <td>' . $event_detail[0]->event_intake . '</td>
                </tr>
                <tr>
                    <th scope="row">Venue</th>
                    <td>' . $event_detail[0]->event_careeropportunities  . '</td>
                </tr>
                <tr>
                    <th scope="row">Shortprofile</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $event_detail[0]->event_shortprofile . '</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $event_detail[0]->event_structure . '</td>
                </tr>
                <tr>
                    <th scope="row">Activities</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $event_detail[0]->event_requirements . '</td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }
}
