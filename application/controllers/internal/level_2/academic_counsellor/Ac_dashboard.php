<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ac_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user_ac_model', 'event_applicants_model', 'organizer_model', 'user_student_model', 'user_ea_model']);
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
        $data['title'] = 'EventHub | Dashboard';
        $data['include_js'] = 'ac_dashboard';

        $ac_details = $this->user_ac_model->ac_details($this->session->userdata('user_id'));
        $data['total_event_applicants'] = count($this->event_applicants_model->get_applicants_from_event($ac_details['organizer_id']));
        $data['total_by_students'] = count($this->event_applicants_model->get_applicants_from_method($ac_details['organizer_id'], 'Student'));
        $data['total_by_ea'] = count($this->event_applicants_model->get_applicants_from_method($ac_details['organizer_id'], 'Education Agent'));


        // $ac_details = $this->user_ac_model->ac_details($this->session->userdata('user_id'));
        // $event_applicants = $this->event_applicants_model->get_applicants_from_event($ac_details['ac_id'], $ac_details['organizer_id']);
        // var_dump($event_applicants); die;

        // For Bar Graph: Total event Applicants by Nationality
        $data['total_event_app'] = $this->event_applicants_model->event_applicants_per_nationality($ac_details['organizer_id']);
        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/academic_counsellor/ac_dashboard_view');
        $this->load->view('internal/templates/footer');
    }
}
