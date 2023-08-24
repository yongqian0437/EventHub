<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_dashboard extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model(['user_e_model', 'employer_projects_model', 'emp_applicants_model']);
        date_default_timezone_set('Asia/Kuala_Lumpur');
        
        // Checks if session is set and if user signed in has a role. If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')){  
            redirect('user/login/Auth/login');
        }
        
        // Checks if session is set and if user signed in is not employer. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Employer"  ){  

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
			// check user role is Student
			else if ($users['user_role']=="Student")
			{
				redirect('external/homepage');
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
        $data['title'] = 'iJEES | Dashboard';
        $data['include_js'] = 'employer_dashboard';

        $e_details = $this->user_e_model->e_details($this->session->userdata('user_id'));

        // Total EMPs Posted
        $data['num_emps'] = count($this->employer_projects_model->get_emps_from_employer($e_details['e_id']));

        // Total Approved EMPs
        $approve_condition = array (
            'e_id' => $e_details['e_id'],
            'emp_approval' => 1
        ); 
        $data['num_approved_emps'] = count($this->employer_projects_model->select_condition($approve_condition));

         // Total Pending EMPs
        $pending_condition = array (
            'e_id' => $e_details['e_id'],
            'emp_approval' => 0
        );
        $data['num_pending_emps'] = count($this->employer_projects_model->select_condition($pending_condition));
        
        // Total EMP Applicants
        $data['num_emp_applicants'] = count($this->emp_applicants_model->get_applicants_from_emps($e_details['e_id']));

        // For Bar Graph: Total EMP Applicants by Nationality
        $data['total_applicants'] = $this->emp_applicants_model->applicants_per_nationality($e_details['e_id']);

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/employer/employer_dashboard_view');
        $this->load->view('internal/templates/footer');
    }
}

?>