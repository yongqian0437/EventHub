<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user_model', 'user_student_model', 'emp_applicants_model', 'user_model', 'user_student_model', 'course_applicants_model']);
        
        // Checks if session is set and if user signed in is an internal user. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Student"  ){  

			$users['user_role'] = $this->session->userdata('user_role');

			if($users['user_role']=="Admin")
			{
				redirect('internal/admin_panel/Admin_dashboard');
			}
			// check user role is  EA
			else if ($users['user_role']=="Education Agent")
			{
			   redirect('internal/level_2/education_agent/Ea_dashboard');
			}
			// check user role is AC
			else if ($users['user_role']=="Academic Counsellor")
			{
			   redirect('internal/level_2/academic_counsellor/Ac_dashboard');
			}
			// check user role is E
			else if ($users['user_role']=="Employer")
			{
			   redirect('internal/level_2/employer/Employer_dashboard');
			}
			// check user role is  EP
			else if ($users['user_role']=="Education Partner")
			{
			   redirect('internal/level_2/educational_partner/Ep_dashboard');
			}
		}	
    }

    public function index()
    {
        $data['title'] = 'iJEES | Profile';
        $user_id = $this->session->userdata('user_id');

        $user_data = $this->user_model->get_user_data();
        $data['user_data'] = $user_data;

        $student_data = $this->user_student_model->student_details($user_id, 'user_id');
        $data['student_data'] = $student_data;

        $student_emp_data = $this->emp_applicants_model->get_user_emp($user_id, 'user_id');
        $data['student_emp_data'] = $student_emp_data;

        $student_course_data = $this->course_applicants_model->get_student_courses($user_id);
        $data['student_course_data'] = $student_course_data;

        $this->load->view('external/templates/header', $data);
        $this->load->view('user/profile_view');
        $this->load->view('external/templates/footer');
    }

    public function edit_profile()
    {
        $user_id = $this->session->userdata('user_id');
        $student_details = $this->user_student_model->student_details($user_id);

        $data =
            [
                'student_phonenumber' => htmlspecialchars($this->input->post('student_contactNoid')),
                'student_nationality' => htmlspecialchars($this->input->post('student_countryid')),
                'student_currentlevel' => htmlspecialchars($this->input->post('student_levelid')),
                'student_interest' => htmlspecialchars($this->input->post('student_interestid')),
            ];

        $data['student_data'] = $this->user_student_model->update($data, $student_details['student_id']);

        $this->session->set_flashdata('edit_message', 1);
        /* var_dump($this->session->flashdata('edit_message'));
        die; */

        redirect('user/profile');
    }
}
