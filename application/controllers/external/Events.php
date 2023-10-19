<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		header('Cache-Control: no-cache');
		$this->load->model('user_model');
		$this->load->model('events_model');
		$this->load->model('universities_model');
		$this->load->model('event_applicants_model');
		$this->load->model('user_student_model');

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
		// Check if session is established. Get User ID from session.
		$user_id = $this->session->userdata('user_id');
		$data['user_role'] = $this->session->userdata('user_role');
		if ($data['user_role'] == 'Student') {
			// From the User ID, get Student ID  
			$data['user_email'] = $this->session->userdata('user_email');
			$student_details = $this->user_student_model->student_details($user_id);
			$data['student_id'] = $student_details['student_id'];
		}
		$data['title'] = 'EventHub | Events';

		$data['event_data'] = $this->events_model->select_all_approved();
		$data['dropdown_area'] = $this->events_model->filter_dropdown('event_type');
		$data['dropdown_country'] = $this->events_model->filter_dropdown('event_country');
		$data['title'] = 'EventHub | Events';
		$this->load->view('external/templates/header', $data);
		$this->load->view('external/events_view');  // view num 1 - jordan
		$this->load->view('external/templates/footer');
	}

	public function view_event($id)
	{
		$user_id = $this->session->userdata('user_id');
		$data['user_role'] = $this->session->userdata('user_role');
		if ($data['user_role'] == 'Student') {
			// From the User ID, get Student ID  
			$data['user_email'] = $this->session->userdata('user_email');
			$student_details = $this->user_student_model->student_details($user_id);
			$data['student_id'] = $student_details['student_id'];
		}
		$data['title'] = 'EventHub | Event Details';
		$data['event_data'] = $this->events_model->select_condition($id, 'events');
		$data['uni_data'] = $this->universities_model->get_uni_detail($data['event_data'][0]->organizer_id);
		$data['title'] = 'EventHub | Event Details';

		$this->load->view('external/templates/header', $data);
		$this->load->view('external/events_detail_view'); //view num 2 - jordan
		$this->load->view('external/templates/footer');
	}

	public function event_filter()
	{
		$data['dropdown_area'] = $this->events_model->filter_dropdown('event_type');
		$data['dropdown_country'] = $this->events_model->filter_dropdown('event_country');
		$data['title'] = 'EventHub | Events';
		$data['user_role'] = $this->session->userdata('user_role');
		if ($data['user_role'] == 'Student') {
			// From the User ID, get Student ID  
			$data['user_email'] = $this->session->userdata('user_email');
			$student_details = $this->user_student_model->student_details($this->session->userdata('user_id'));
			$data['student_id'] = $student_details['student_id'];
		}
		$event_type = $this->input->post('event_typeid');
		$event_level = $this->input->post('event_levelid');
		$event_intake = $this->input->post('event_intakeid');
		$event_country = $this->input->post('event_countryid');
		$event_fee = $this->input->post('event_feeid');

		$data['event_data'] = $this->events_model->filter_event($event_type, $event_level, $event_intake, $event_country, $event_fee);
		$this->load->view('external/templates/header', $data);
		$this->load->view('external/events_view');
		$this->load->view('external/templates/footer');
	}

	public function event_applicant($event_id)
	{

		if ($this->session->has_userdata('user_id')) {
			$data['student_data'] = $this->event_applicants_model->find_data_with_id($this->session->userdata('user_id'));
			$data['event_id'] = $event_id;

			$data['title'] = 'EventHub | Event Applicant';
			$this->load->view('external/templates/header', $data);
			$this->load->view('user/registration/events_applicant_registration_view');
			$this->load->view('external/templates/footer');
		} else {

			// redirect to login controller 
		}
	}

	public function submit_event_applicant_form($event_id)
	{

		$user_id = $this->session->userdata('user_id');
		$data['student_data'] = $this->event_applicants_model->find_data_with_id($this->session->userdata('user_id'));
		$e_applicant_document = $this->upload_doc('./assets/uploads/event_applicants', 'e_applicant_document', $event_id);

		$data = array(
			'e_applicant_fname' => $this->session->userdata('user_fname'),
			'e_applicant_lname' => $this->session->userdata('user_lname'),
			'e_applicant_phonenumber' => $data['student_data']->student_phonenumber,
			'e_applicant_email' => $this->session->userdata('user_email'),
			'e_applicant_nationality' => $data['student_data']->student_nationality,
			'e_applicant_gender' => $data['student_data']->student_gender,
			'e_applicant_dob' => $data['student_data']->student_dob,
			'e_applicant_currentlevel' => $data['student_data']->student_currentlevel,
			'e_applicant_address' => $this->input->post('e_applicant_address'),
			'e_applicant_identification' => $this->input->post('e_applicant_identification'),
			'event_id' => $event_id,
			'e_applicant_document' => $e_applicant_document['file_name'],
			'e_applicant_method' => $this->session->userdata('user_id'),
		);

		$data['event_data'] = $this->event_applicants_model->insert($data);
		redirect('external/Events');
	}

	public function upload_doc($path, $file_input_name, $event_id)
	{
		if ($_FILES) {
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($file_input_name)) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                The file format is not correct</div>');
				redirect('external/Events/submit_event_applicant_form/' . $event_id);
			} else {
				$doc_data = ($this->upload->data());
				echo $doc_data;
				return $doc_data;
			}
		}
	}

	// -------------------------- WC TO INCLUDE event_applicant FUNCTIONS HERE ----------------------------------------------
	//  ------------------------- **event_applicant.PHP CONTROLLER IS TO BE DELETE** ----------------------------------------------
}
