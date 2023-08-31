<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ea_dashboard extends CI_Controller 
{

    public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
        $this->load->model(['user_model','course_applicants_model','universities_model','courses_model']);
        // Checks if session is set and if user is signed in as Level 2 user (authorised access). If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')){  
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is not ea. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Education Agent"  ){  

			$users['user_role'] = $this->session->userdata('user_role');

			if($users['user_role']=="Admin")
			{
				redirect('internal/admin_panel/Admin_dashboard');
			}
			// check user role is  Student
			else if ($users['user_role']=="Student")
			{
				redirect('external/homepage');
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
        $data['title'] = 'EventHub | Dashboard';
        $data['include_js'] ='ea_dashboard';
       
       // $user_details = $this->user_model->get_user_details($this->session->userdata('user_id'));
        

        // Total Student
       $data['total_students']= count($this->course_applicants_model->get_total_students($this->session->userdata('user_id')));
// var_dump($data['total_student']);
// die;
       //get nationality
       $data['total_applicants']=$this->course_applicants_model->applicants_per_nationality($this->session->userdata('user_id'));
      
// var_dump( $data['total_applicants']);
// die;
       //Bar Chart
       

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/education_agent/ea_dashboard_view',$data);
        $this->load->view('internal/templates/footer');
    }

   
}
