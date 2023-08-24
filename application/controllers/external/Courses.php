<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courses extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		header('Cache-Control: no-cache');
		$this->load->model('user_model');
		$this->load->model('courses_model');
		$this->load->model('universities_model');
		$this->load->model('course_applicants_model');
		$this->load->model('user_student_model');

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
			$data['user_email'] = $this->session->userdata('user_email');
			$student_details = $this->user_student_model->student_details($user_id);
			$data['student_id'] = $student_details['student_id'];
		}
		$data['title'] = 'iJEES | Courses';

		$data['course_data'] = $this->courses_model->select_all_approved();
		$data['dropdown_area'] = $this->courses_model->filter_dropdown('course_area');
		$data['dropdown_country'] = $this->courses_model->filter_dropdown('course_country');
		$data['title'] = 'iJEES | Courses';
		$this->load->view('external/templates/header', $data);
		$this->load->view('external/courses_view');  // view num 1 - jordan
		$this->load->view('external/templates/footer');
	}

	public function view_course($id)
	{
		$user_id = $this->session->userdata('user_id');
		$data['user_role'] = $this->session->userdata('user_role');
		if ($data['user_role'] == 'Student') {
			// From the User ID, get Student ID  
			$data['user_email'] = $this->session->userdata('user_email');
			$student_details = $this->user_student_model->student_details($user_id);
			$data['student_id'] = $student_details['student_id'];
		}
		$data['title'] = 'iJEES | Course Details';	
		$data['course_data'] = $this->courses_model->select_condition($id, 'courses');
		$data['uni_data'] = $this->universities_model->get_uni_detail($data['course_data'][0]->uni_id);
		$data['title'] = 'iJEES | Course Details';

		$this->load->view('external/templates/header', $data);
		$this->load->view('external/courses_detail_view'); //view num 2 - jordan
		$this->load->view('external/templates/footer');
	}

	public function course_filter()
	{
		$data['dropdown_area'] = $this->courses_model->filter_dropdown('course_area');
		$data['dropdown_country'] = $this->courses_model->filter_dropdown('course_country');
		$data['title'] = 'iJEES | Courses';
		$data['user_role'] = $this->session->userdata('user_role');
		if ($data['user_role'] == 'Student') {
			// From the User ID, get Student ID  
			$data['user_email'] = $this->session->userdata('user_email');
			$student_details = $this->user_student_model->student_details($this->session->userdata('user_id'));
			$data['student_id'] = $student_details['student_id'];
		}
		$course_area = $this->input->post('course_areaid');
		$course_level = $this->input->post('course_levelid');
		$course_intake = $this->input->post('course_intakeid');
		$course_country = $this->input->post('course_countryid');
		$course_fee = $this->input->post('course_feeid');

		$data['course_data'] = $this->courses_model->filter_course($course_area, $course_level, $course_intake, $course_country, $course_fee);
		$this->load->view('external/templates/header', $data);
		$this->load->view('external/courses_view');
		$this->load->view('external/templates/footer');
	}

	public function course_applicant($course_id)
	{

		if ($this->session->has_userdata('user_id')) {
			$data['student_data'] = $this->course_applicants_model->find_data_with_id($this->session->userdata('user_id'));
			$data['course_id'] = $course_id;

			$data['title'] = 'iJEES | Course Applicant';
			$this->load->view('external/templates/header', $data);
			$this->load->view('user/registration/courses_applicant_registration_view');
			$this->load->view('external/templates/footer');
		} else {

			// redirect to login controller 
		}
	}

	public function submit_courses_applicant_form($course_id)
	{

		$user_id = $this->session->userdata('user_id');
		$data['student_data'] = $this->course_applicants_model->find_data_with_id($this->session->userdata('user_id'));
		$c_applicant_document = $this->upload_doc('./assets/uploads/course_applicants', 'c_applicant_document', $course_id);

		$data = array(
			'c_applicant_fname' => $this->session->userdata('user_fname'),
			'c_applicant_lname' => $this->session->userdata('user_lname'),
			'c_applicant_phonenumber' => $data['student_data']->student_phonenumber,
			'c_applicant_email' => $this->session->userdata('user_email'),
			'c_applicant_nationality' => $data['student_data']->student_nationality,
			'c_applicant_gender' => $data['student_data']->student_gender,
			'c_applicant_dob' => $data['student_data']->student_dob,
			'c_applicant_currentlevel' => $data['student_data']->student_currentlevel,
			'c_applicant_address' => $this->input->post('c_applicant_address'),
			'c_applicant_identification' => $this->input->post('c_applicant_identification'),
			'course_id' => $course_id,
			'c_applicant_document' => $c_applicant_document['file_name'],
			'c_applicant_method' => $this->session->userdata('user_id'),
		);

		$data['course_data'] = $this->course_applicants_model->insert($data);
		redirect('external/Courses');
	}

	public function upload_doc($path, $file_input_name, $course_id)
	{
		if ($_FILES) {
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($file_input_name)) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                The file format is not correct</div>');
				redirect('external/Courses/submit_courses_applicant_form/' . $course_id);
			} else {
				$doc_data = ($this->upload->data());
				echo $doc_data;
				return $doc_data;
			}
		}
	}

	// -------------------------- WC TO INCLUDE COURSES_APPLICANT FUNCTIONS HERE ----------------------------------------------
	//  ------------------------- **COURSES_APPLICANT.PHP CONTROLLER IS TO BE DELETE** ----------------------------------------------
}
