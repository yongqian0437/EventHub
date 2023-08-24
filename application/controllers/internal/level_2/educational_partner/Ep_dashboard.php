<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ep_dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('user_ep_model');
		$this->load->model('courses_model');
		$this->load->model('universities_model');
		$this->load->model('rd_projects_model');
        $this->load->model('rd_applicants_model');

        // Checks if session is set and if user signed in has a role. If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')){  
            redirect('user/login/Auth/login');
        }

		// Checks if session is set and if user signed in is not ep. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Education Partner"  ){  

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
			else if ($users['user_role']=="Student")
			{
				redirect('external/homepage');
			}
		}
	}

	public function index()
	{
		
		$data['title'] = 'iJEES | Dashboard';
		$data['include_js'] = 'ep_dashboard';

		//get number of course
		$university_data = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id')); 
		$data['num_courses'] = count($this->user_ep_model->get_course_for_uni($university_data->uni_id));

		//get number of my R&D project
		$ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));
		$data['num_rd_projects'] = count($this->user_ep_model->get_rd_for_ep($ep_data->ep_id));

		//get number of all my application
        $ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));
		$data['num_rd_applicants'] = count($this->rd_applicants_model->all_my_applications($ep_data->ep_id));

		//Get number of partners
        $ep_data = $this->user_ep_model->get_ep_detail_with_user_id($this->session->userdata('user_id'));
		$data['num_partners']= count($this->rd_applicants_model->all_project_partners($ep_data->ep_id));

		//data for barchart
		$data['course_field'] = $this->courses_model->course_field_bar_chart($university_data->uni_id); 

		$this->load->view('internal/templates/header',$data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_dashboard_view');
        $this->load->view('internal/templates/footer');  
	}


}