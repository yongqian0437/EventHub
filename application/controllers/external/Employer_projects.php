<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employer_projects extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user_student_model', 'company_model', 'user_e_model', 'employer_projects_model', 'emp_applicants_model']);
        date_default_timezone_set('Asia/Kuala_Lumpur');

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
        // Check if session is established. Get User ID from session.
        $user_id = $this->session->userdata('user_id');
        $data['user_role'] = $this->session->userdata('user_role');
        if ($data['user_role'] == 'Student') {
            // From the User ID, get Student ID  
            $student_details = $this->user_student_model->student_details($user_id);
            $data['student_id'] = $student_details['student_id'];
        }

        // $emp_info = $this->employer_projects_model->emp_details(1);
        // var_dump($emp_info[0]->c_name);
        // die;
        $data['title'] = "iJEES | Employer Projects";

        // Get EPs that are approved and their details
        $eps= $this->employer_projects_model->approved_eps();
        $data['eps'] = $eps;
        $data['include_css'] = 'projects';
        $data['include_js'] = 'emp_projects_list';
        $this->load->view('external/templates/header', $data);
        $this->load->view('external/employer_projects_view', $data); 
        $this->load->view('external/templates/footer', $data);
    }

    public function send_emp_application() {

        $user_id = $this->session->userdata('user_id');
        $student_details = $this->user_student_model->student_details($user_id);
        $student_id = $student_details['student_id'];

        $data = 
        [
            'emp_id'            => $this->input->post('ep_id'),
            'student_id'        => $student_id
        ];
        
        $this->emp_applicants_model->insert($data);
    }

    public function fetch_emp_information()
    {
        $emp_info = $this->employer_projects_model->emp_details($this->input->post('emp_id'));
        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th scope="row">Employer</th>
                    <td>' . $emp_info[0]->c_name . '</td>
                </tr>
                <tr>
                    <th scope="row">Country</th>
                    <td>' . $emp_info[0]->c_country . '</td>
                </tr>
                <tr>
                    <th scope="row">Employer Project Title</th>
                    <td>' . $emp_info[0]->emp_title . '</td>
                </tr>
                <tr>
                    <th scope="row">Level</th>
                    <td>' . $emp_info[0]->emp_level . '</td>
                </tr>
                <tr>
                    <th scope="row">Field(s)</th>
                    <td>' . $emp_info[0]->emp_area . '</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $emp_info[0]->emp_description . '</td>
                </tr>
            </tbody>
        </table>  
        ';
        echo $output;
    }
}