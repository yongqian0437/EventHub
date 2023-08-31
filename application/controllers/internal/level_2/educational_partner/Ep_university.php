<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ep_university extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('user_ep_model');
		$this->load->model('courses_model');
		$this->load->model('universities_model');

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

		$data['title'] = 'EventHub | University';
		$data['university_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));

		$this->load->view('internal/templates/header', $data);
		$this->load->view('internal/templates/sidenav');
		$this->load->view('internal/templates/topbar');
		$this->load->view('internal/level_2/educational_partner/ep_university_view');
		$this->load->view('internal/templates/footer');
	}

	public function edit_university()
	{
		$data['title'] = 'EventHub | University';
		$data['university_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));


		$this->load->view('internal/templates/header', $data);
		$this->load->view('internal/templates/sidenav');
		$this->load->view('internal/templates/topbar');
		$this->load->view('internal/level_2/educational_partner/ep_university_edit_view');
		$this->load->view('internal/templates/footer');
	}

	public function after_edit_university($uni_id)
	{
		$university_data = $this->universities_model->get_uni_with_id($uni_id);

		if ($_FILES['uni_background']['name'] != "") {

			unlink($university_data[0]->uni_background);

			$uni_background = $this->upload_img('./assets/img/universities', 'uni_background');
			$data = [
				'uni_background' => $uni_background['file_name'],
			];
			$this->universities_model->update($data, $uni_id);
		}

		if ($_FILES['uni_logo']['name'] != "") {

			unlink($university_data[0]->uni_logo);

			$uni_logo = $this->upload_img('./assets/img/universities', 'uni_logo');
			$data = [
				'uni_logo' => $uni_logo['file_name'],
			];
			$this->universities_model->update($data, $uni_id);
		}

		$data =
			[
				'uni_name' => htmlspecialchars($this->input->post('uni_name')),
				'uni_shortprofile' => htmlspecialchars($this->input->post('uni_shortprofile')),
				'uni_country' => htmlspecialchars($this->input->post('uni_country')),
				'uni_hotline' => htmlspecialchars($this->input->post('uni_hotline')),
				'uni_email' => htmlspecialchars($this->input->post('uni_email')),
				'uni_website' => htmlspecialchars($this->input->post('uni_website')),
				'uni_address' => htmlspecialchars($this->input->post('uni_address')),
				'uni_qsrank' => htmlspecialchars($this->input->post('uni_qsrank')),
				'uni_employabilityrank' => htmlspecialchars($this->input->post('uni_employabilityrank')),
				'uni_totalstudents' => htmlspecialchars($this->input->post('uni_totalstudents')),
			];
		$this->universities_model->update($data, $uni_id);

		$this->session->set_flashdata('edit_message', '<div id = "alert_message" class="alert alert-success px-4	" role="alert">
		University Information has been edited</div>');

		redirect('internal/level_2/educational_partner/ep_university');
	}

	public function upload_img($path, $file_input_name)
	{
		if ($_FILES) {
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpeg|jpg|png';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($file_input_name)) {
				if ($this->session->userdata('user_role') == "Education Partner") {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    The file format must be in "png, jpg or jpeg"</div>');
					redirect('user/login/Auth/university');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    The file format must be in "png, jpg or jpeg"</div>');
					redirect('user/login/Auth/company');
				}
			} else {
				$doc_data = $this->upload->data();
				return $doc_data;
			}
		}
	}
}
