<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Compare extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('universities_model');
		$this->load->model('courses_model');

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

		$data['title'] = 'EventHub | Comparison';

		$data['university_data'] = $this->universities_model->sorted_uni_dropdown();
		$data['include_js'] = 'compare';
		$data['include_css'] = 'compare';
		$this->load->view('external/templates/header', $data);
		$this->load->view('external/compare_view');
		$this->load->view('external/templates/footer');
	}

	function fetch_courses()
	{
		echo $this->courses_model->fetch_courses($this->input->post('uni_id'), $this->input->post('course_level'));
	}

	function fetch_table()
	{
		$course_data1 = $this->courses_model->get_course_with_id($this->input->post('course_id1'));
		$course_data2 = $this->courses_model->get_course_with_id($this->input->post('course_id2'));
		$course_data3 = $this->courses_model->get_course_with_id($this->input->post('course_id3'));
		$uni_data1 = $this->universities_model->get_uni_with_id($this->input->post('uni_id1'));
		$uni_data2 = $this->universities_model->get_uni_with_id($this->input->post('uni_id2'));
		$uni_data3 = $this->universities_model->get_uni_with_id($this->input->post('uni_id3'));

		$base_url = base_url();
		$logo1 = $base_url . "assets/img/universities/" . $uni_data1[0]->uni_logo;
		$logo2 = $base_url . "assets/img/universities/" . $uni_data2[0]->uni_logo;
		$logo3 = $base_url . "assets/img/universities/" . $uni_data3[0]->uni_logo;

		$course_link1 = $base_url . "external/Courses/view_course/" . $course_data1[0]->course_id;
		$course_link2 = $base_url . "external/Courses/view_course/" . $course_data2[0]->course_id;
		$course_link3 = $base_url . "external/Courses/view_course/" . $course_data3[0]->course_id;

		$uni_link1 = $base_url . "external/Universities/university_detail/" . $uni_data1[0]->uni_id;
		$uni_link2 = $base_url . "external/Universities/university_detail/" . $uni_data2[0]->uni_id;
		$uni_link3 = $base_url . "external/Universities/university_detail/" . $uni_data3[0]->uni_id;

		$output =
			'<tbody>
			<tr>
				<td scope="col"></td>
				<td scope="col">
                    <center>
                        <img style=" height:85px; width: 250px; object-fit: contain;" src="' . $logo1 . '" alt="logo1"><br><br>
                        <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto; " target="_blank" href="' . $uni_link1 . '" class = "btn btn-icon-split">
                            <span class = "icon text-white-600">
                                <i class = "fas fa-university p-1"></i>
                            </span>
                            <span style = "" class = "text">View University</span>
                        </a>
                    </center>  
                </td>
				<td scope="col">
                    <center>
                        <img style=" height:85px; width: 250px;  object-fit: contain;" src="' . $logo2 . '" alt="logo2"><br><br>
                        <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto;" target="_blank" href="' . $uni_link2 . '" class = "btn btn-icon-split">
                            <span class = "icon text-white-600">
                                <i class = "fas fa-university p-1"></i>
                            </span>
                            <span style = "" class = "text">View University</span>
                        </a>                    
                    </center>   
                </td>
				<td scope="col">
                    <center>
                        <img style=" height:85px; width: 250px; object-fit: contain;" src="' . $logo3 . '" alt="logo3"><br><br>
                        <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto; " target="_blank" href="' . $uni_link3 . '" class = "btn btn-icon-split">
                            <span class = "icon text-white-600">
                                <i class = "fas fa-university p-1"></i>
                            </span>
                            <span style = "" class = "text">View University</span>
                        </a>                    
                    </center>    
                </td>
			</tr>
			<tr>
				<th scope="row">Course Name</th>
				<td>' . $course_data1[0]->course_name . '</td>
				<td>' . $course_data2[0]->course_name . '</td>
				<td>' . $course_data3[0]->course_name . '</td>
			</tr>
			<tr>
				<th scope="row">Malaysian based Fee (RM)</th>
				<td>RM ' . number_format($course_data1[0]->course_fee) . '</td>
				<td>RM ' . number_format($course_data2[0]->course_fee) . '</td>
				<td>RM ' . number_format($course_data3[0]->course_fee) . '</td>
			</tr>
			<tr>
				<th scope="row">International Fee (USD)</th>
				<td>$ ' . number_format($course_data1[0]->course_usd_fee) . '</td>
				<td>$ ' . number_format($course_data2[0]->course_usd_fee) . '</td>
				<td>$ ' . number_format($course_data3[0]->course_usd_fee) . '</td>
			</tr>
			<tr>
				<th scope="row">Country</th>
				<td>' . $uni_data1[0]->uni_country . '</td>
				<td>' . $uni_data2[0]->uni_country . '</td>
				<td>' . $uni_data3[0]->uni_country . '</td>
			</tr>			
			<tr>
				<th scope="row">Area</th>
				<td>' . $course_data1[0]->event_type . '</td>
				<td>' . $course_data2[0]->event_type . '</td>
				<td>' . $course_data3[0]->event_type . '</td>
			</tr>
			<tr>
				<th scope="row">Level</th>
				<td>' . $course_data1[0]->course_level . '</td>
				<td>' . $course_data2[0]->course_level . '</td>
				<td>' . $course_data3[0]->course_level . '</td>
			</tr>
			<tr>
				<th scope="row">Duration (Year)</th>
				<td>' . $course_data1[0]->course_duration . ' years</td>
				<td>' . $course_data2[0]->course_duration . ' years</td>
				<td>' . $course_data3[0]->course_duration . ' years</td>
			</tr>
			<tr>
				<th scope="row">Intake</th>
				<td>' . $course_data1[0]->course_intake . '</td>
				<td>' . $course_data2[0]->course_intake . '</td>
				<td>' . $course_data3[0]->course_intake . '</td>
			</tr>
			<tr>
				<th scope="row">World Ranking</th>
				<td>' . $uni_data1[0]->uni_qsrank . '</td>
				<td>' . $uni_data2[0]->uni_qsrank . '</td>
				<td>' . $uni_data3[0]->uni_qsrank . '</td>
			</tr>
            <tr>
				<th scope="row"></th>
                    <td>
                        <center>
                            <span>
                                <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto;" target="_blank" href="' . $course_link1 . '" class = "btn btn-icon-split pr-1">
                                    <span class = "icon text-white-600">
                                        <i class = "fas fa-book p-1"></i>
                                    </span>
                                    <span style = "" class = "text">View Course</span>
                                </a>
                            </span>
                        </center>
                    </td>
                    <td>  
                        <center>  
                            <span>
                                <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto;" target="_blank" href="' . $course_link2 . '" class = "btn btn-icon-split pr-1">
                                    <span class = "icon text-white-600">
                                        <i class = "fas fa-book p-1"></i>
                                    </span>
                                    <span style = "" class = "text">View Course</span>
                                </a>
                            </span>
                        </center>
                    </td>
                    <td>
                        <center>
                            <span>
                                <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto;" target="_blank" href="' . $course_link3 . '" class = "btn btn-icon-split pr-1">
                                    <span class = "icon text-white-600">
                                        <i class = "fas fa-book p-1"></i>
                                    </span>
                                    <span style = "" class = "text">View Course</span>
                                </a>
                            </span>
                        </center>
                    </td>
			</tr>

		</tbody>';

		echo $output;
	}

	function fetch_table_for_2courses()
	{
		$course_data1 = $this->courses_model->get_course_with_id($this->input->post('course_id1'));
		$course_data2 = $this->courses_model->get_course_with_id($this->input->post('course_id2'));
		$uni_data1 = $this->universities_model->get_uni_with_id($this->input->post('uni_id1'));
		$uni_data2 = $this->universities_model->get_uni_with_id($this->input->post('uni_id2'));

		$base_url = base_url();
		$logo1 = $base_url . "assets/img/universities/" . $uni_data1[0]->uni_logo;
		$logo2 = $base_url . "assets/img/universities/" . $uni_data2[0]->uni_logo;

		$course_link1 = $base_url . "external/Courses/view_course/" . $course_data1[0]->course_id;
		$course_link2 = $base_url . "external/Courses/view_course/" . $course_data2[0]->course_id;

		$uni_link1 = $base_url . "external/Universities/university_detail/" . $uni_data1[0]->uni_id;
		$uni_link2 = $base_url . "external/Universities/university_detail/" . $uni_data2[0]->uni_id;

		$output =
			'<tbody>
			<tr>
				<td scope="col"></td>
				<td scope="col">
                    <center>
                        <img style=" height:85px; width: 250px; object-fit: contain;" src="' . $logo1 . '" alt="logo1"><br><br>
                        <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto; " target="_blank" href="' . $uni_link1 . '" class = "btn btn-icon-split">
                            <span class = "icon text-white-600">
                                <i class = "fas fa-university p-1"></i>
                            </span>
                            <span style = "" class = "text">View University</span>
                        </a>
                    </center>  
                </td>
				<td scope="col">
                    <center>
                        <img style=" height:85px; width: 250px;  object-fit: contain;" src="' . $logo2 . '" alt="logo2"><br><br>
                        <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto;" target="_blank" href="' . $uni_link2 . '" class = "btn btn-icon-split">
                            <span class = "icon text-white-600">
                                <i class = "fas fa-university p-1"></i>
                            </span>
                            <span style = "" class = "text">View University</span>
                        </a>                    
                    </center>   
                </td>
			</tr>
			<tr>
				<th scope="row">Course Name</th>
				<td>' . $course_data1[0]->course_name . '</td>
				<td>' . $course_data2[0]->course_name . '</td>
			</tr>
			<tr>
				<th scope="row">Malaysian based Fee (MYR)</th>
				<td>RM ' . number_format($course_data1[0]->course_fee) . '</td>
				<td>RM ' . number_format($course_data2[0]->course_fee) . '</td>
			</tr>
			<tr>
				<th scope="row">International Fee (USD)</th>
				<td>$ ' . number_format($course_data1[0]->course_usd_fee) . '</td>
				<td>$ ' . number_format($course_data2[0]->course_usd_fee) . '</td>
			</tr>
			<tr>
				<th scope="row">Country</th>
				<td>' . $uni_data1[0]->uni_country . '</td>
				<td>' . $uni_data2[0]->uni_country . '</td>
			</tr>			
			<tr>
				<th scope="row">Area</th>
				<td>' . $course_data1[0]->event_type . '</td>
				<td>' . $course_data2[0]->event_type . '</td>
			</tr>
			<tr>
				<th scope="row">Level</th>
				<td>' . $course_data1[0]->course_level . '</td>
				<td>' . $course_data2[0]->course_level . '</td>
			</tr>
			<tr>
				<th scope="row">Duration (Year)</th>
				<td>' . $course_data1[0]->course_duration . ' years</td>
				<td>' . $course_data2[0]->course_duration . ' years</td>
			</tr>
			<tr>
				<th scope="row">Intake</th>
				<td>' . $course_data1[0]->course_intake . '</td>
				<td>' . $course_data2[0]->course_intake . '</td>
			</tr>
			<tr>
				<th scope="row">World Ranking</th>
				<td>' . $uni_data1[0]->uni_qsrank . '</td>
				<td>' . $uni_data2[0]->uni_qsrank . '</td>
			</tr>
            <tr>
				<th scope="row"></th>
                    <td>
                        <center>
                            <span>
                                <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto;" target="_blank" href="' . $course_link1 . '" class = "btn btn-icon-split pr-1">
                                    <span class = "icon text-white-600">
                                        <i class = "fas fa-book p-1"></i>
                                    </span>
                                    <span style = "" class = "text">View Course</span>
                                </a>
                            </span>
                        </center>
                    </td>
                    <td>  
                        <center>  
                            <span>
                                <a style = "border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto;" target="_blank" href="' . $course_link2 . '" class = "btn btn-icon-split pr-1">
                                    <span class = "icon text-white-600">
                                        <i class = "fas fa-book p-1"></i>
                                    </span>
                                    <span style = "" class = "text">View Course</span>
                                </a>
                            </span>
                        </center>
                    </td>
			</tr>

		</tbody>';

		echo $output;
	}
}
