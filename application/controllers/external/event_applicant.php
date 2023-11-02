<?php
defined('BASEPATH') or exit('No direct script access allowed');

class event_applicant extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_applicants_model');

        // Checks if session is set and if user signed in is an internal user. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Student") {

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
            else if ($users['user_role'] == "Education Partner") {
                redirect('internal/level_2/educational_partner/Ep_dashboard');
            }
        }
    }

    public function index()
    {

        $data['student_data'] = $this->event_applicants_model->find_data_with_id($this->session->userdata('user_id'));

        // if($this->session->has_userdata('user_id')){

        $data['title'] = 'EventHub | Event Applicant Page';
        $this->load->view('external/templates/header', $data);
        $this->load->view('user/registration/events_applicant_registration_view');
        $this->load->view('external/templates/footer');
    }

    public function event_appplicant($event_id)
    {

        if ($this->session->has_userdata('user_id')) {

            $data['student_data'] = $this->event_applicants_model->find_data_with_id($this->session->userdata('user_id'));
            $data['event_id'] = $event_id;

            // $data['title'] = 'EventHub | Homepage';
            $this->load->view('external/templates/header', $data);
            $this->load->view('user/registration/events_applicant_registration_view');
            $this->load->view('external/templates/footer');
        } else {

            // redirect to login controller 
        }
    }

    public function submit_event_applicant_form()
    {
    }
}
