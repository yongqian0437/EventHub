<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ep_courses extends CI_Controller
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

        $data['title'] = 'EventHub | Courses';
        $data['university_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        // $data['c'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id')); 
        $data['include_js'] = 'ep_course_list';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_course_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function course_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $university_data = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));

        $courses = $this->user_ep_model->get_course_for_uni($university_data->uni_id);

        $data = array();
        $base_url = base_url();

        foreach ($courses as $r) {

            $edit_link = $base_url . "internal/level_2/educational_partner/ep_courses/edit_course/" . $r->course_id;

            $delete = '<span><button type="button" onclick="delete_course(' . $r->course_id . ')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
            $edit_opt = '<span class = "px-1"><a type="button" href = "' . $edit_link . '"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
            $view = '<span><button type="button" onclick="view_course(' . $r->course_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_course"><span class="fas fa-eye"></span></button></span>';
            $function = $view . $edit_opt . $delete;

            $data[] = array(
                '',
                $r->course_name,
                $r->course_area,
                $r->course_level,
                $r->course_duration,
                "RM " . number_format($r->course_fee),
                $function,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($courses),
            "recordsFiltered" => count($courses),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function add_course()
    {
        $data['title'] = 'EventHub | Add Course';
        $data['university_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_course_add_view');
        $this->load->view('internal/templates/footer');
    }

    function submit_added_course($uni_id)
    {
        $data =
            [
                'uni_id' => $uni_id,
                'course_name' => htmlspecialchars($this->input->post('course_name')),
                'course_area' => htmlspecialchars($this->input->post('course_area')),
                'course_level' => htmlspecialchars($this->input->post('course_level')),
                'course_duration' => htmlspecialchars($this->input->post('course_duration')),
                'course_fee' => $this->input->post('course_fee'),
                'course_usd_fee' => $this->input->post('course_usd_fee'),
                'course_shortprofile' => htmlspecialchars($this->input->post('course_shortprofile')),
                'course_structure' => htmlspecialchars($this->input->post('course_structure')),
                'course_requirements' => htmlspecialchars($this->input->post('course_requirements')),
                'course_country' => htmlspecialchars($this->input->post('course_country')),
                'course_intake' => htmlspecialchars($this->input->post('course_intake')),
                'course_careeropportunities' => htmlspecialchars($this->input->post('course_careeropportunities')),
            ];

        $this->courses_model->insert($data);

        $this->session->set_flashdata('insert_message', 1);
        $this->session->set_flashdata('course_name', $this->input->post('course_name'));

        redirect('internal/level_2/educational_partner/ep_courses');
    }

    function delete_course()
    {
        $this->courses_model->delete($this->input->post('course_id'));
    }

    function edit_course($course_id)
    {
        $data['title'] = 'EventHub | Edit Course';
        $data['university_data'] = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        $data['course_data'] = $this->user_ep_model->get_course_detail($course_id);

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/educational_partner/ep_course_edit_view');
        $this->load->view('internal/templates/footer');
    }

    function submit_edit_course($course_id)
    {
        $university_data = $this->user_ep_model->get_uni_from_ep($this->session->userdata('user_id'));
        $data =
            [
                'uni_id' => $university_data->uni_id,
                'course_name' => htmlspecialchars($this->input->post('course_name')),
                'course_area' => htmlspecialchars($this->input->post('course_area')),
                'course_level' => htmlspecialchars($this->input->post('course_level')),
                'course_duration' => htmlspecialchars($this->input->post('course_duration')),
                'course_fee' => $this->input->post('course_fee'),
                'course_usd_fee' => $this->input->post('course_usd_fee'),
                'course_shortprofile' => htmlspecialchars($this->input->post('course_shortprofile')),
                'course_structure' => htmlspecialchars($this->input->post('course_structure')),
                'course_requirements' => htmlspecialchars($this->input->post('course_requirements')),
                'course_country' => htmlspecialchars($this->input->post('course_country')),
                'course_intake' => htmlspecialchars($this->input->post('course_intake')),
                'course_careeropportunities' => htmlspecialchars($this->input->post('course_careeropportunities')),
            ];

        $this->courses_model->update($data, $course_id);

        $this->session->set_flashdata('edit_message', 1);
        $this->session->set_flashdata('course_name', $this->input->post('course_name'));

        redirect('internal/level_2/educational_partner/ep_courses');
    }

    function view_course()
    {
        $course_detail = $this->courses_model->get_course_with_id($this->input->post('course_id'));

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th scope="row">Course Name</th>
                    <td>' . $course_detail[0]->course_name . '</td>
                </tr>
                <tr>
                    <th scope="row">Course Area</th>
                    <td>' . $course_detail[0]->course_area . '</td>
                </tr>
                <tr>
                    <th scope="row">level</th>
                    <td>' . $course_detail[0]->course_level . '</td>
                </tr>
                <tr>
                    <th scope="row">Duration</th>
                    <td>' . $course_detail[0]->course_duration . '</td>
                </tr>
                <tr>
                    <th scope="row">Malaysian based Fee (MYR)</th>
                    <td>RM ' . number_format($course_detail[0]->course_fee) . '</td>
                </tr>
                <tr>
                    <th scope="row">International Fee (USD)</th>
                    <td>$ ' . number_format($course_detail[0]->course_usd_fee) . '</td>
                </tr>
                <tr>
                    <th scope="row">Intake</th>
                    <td>' . $course_detail[0]->course_intake . '</td>
                </tr>
                <tr>
                    <th scope="row">Career Opportunities</th>
                    <td>' . $course_detail[0]->course_careeropportunities    . '</td>
                </tr>
                <tr>
                    <th scope="row">Shortprofile</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $course_detail[0]->course_shortprofile . '</td>
                </tr>
                <tr>
                    <th scope="row">Structure</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $course_detail[0]->course_structure . '</td>
                </tr>
                <tr>
                    <th scope="row">Requirements</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">' . $course_detail[0]->course_requirements . '</td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }
}
