<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'user_student_model', 'user_ep_model', 'user_ac_model', 'user_ea_model', 'user_e_model',
            'event_applicants_model', 'user_model', 'universities_model', 'employer_projects_model',
            'rd_projects_model'
        ]);

        // Checks if session is set and if user is signed in as Admin (authorised access). If not, deny his/her access.
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_role') != "Admin") {
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is not admin. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Admin") {

            $users['user_role'] = $this->session->userdata('user_role');

            if ($users['user_role'] == "Student") {
                redirect('external/homepage');
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
        $data['title'] = 'Admin | Dashboard';
        $data['include_js'] = 'admin_dashboard';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');

        //total user based on role
        $data['total_student'] = count($this->user_student_model->select_all());
        $data['total_e'] = count($this->user_e_model->approved_employers());
        $data['total_ea'] = count($this->user_ea_model->approved_ea());
        $data['total_ac'] = count($this->user_ac_model->approved_ac());
        $data['total_ep'] = count($this->user_ep_model->approved_ep());

        //6 latest uni list
        $data['latest_uni'] = $this->universities_model->uni_max_5();
        $data['total_uni'] = count($this->universities_model->select_all_approved_only());

        //total users
        $Jan = $this->get_monthly_user('2021-01-01', '2021-01-31');
        $Feb = $Jan + $this->get_monthly_user('2021-02-01', '2021-02-28');
        $Mar = $Feb + $this->get_monthly_user('2021-03-01', '2021-03-31');
        $Apr = $Mar + $this->get_monthly_user('2021-04-01', '2021-04-30');
        $May = $Apr + $this->get_monthly_user('2021-05-01', '2021-05-31');
        $Jun = $May + $this->get_monthly_user('2021-06-01', '2021-06-30');
        $Jul = $Jun + $this->get_monthly_user('2021-07-01', '2021-07-31');

        $data['monthly_user'] =
            [
                $Jan,
                $Feb,
                $Mar,
                $Apr,
                $May,
                $Jun,
                $Jul,
            ];

        //applicants by uni
        $data['total_applicants'] = $this->event_applicants_model->applicants_per_uni();

        //enrollment method
        $data['total_by_ea'] = count($this->event_applicants_model->enrollment_method('Education Agent'));
        $data['total_by_student'] = count($this->event_applicants_model->enrollment_method('Student'));

        //active & pending uni
        $data['active_uni'] = count($this->universities_model->uni_by_approval(1));
        $data['pending_uni'] = count($this->universities_model->uni_by_approval(0));

        //active & pending emp
        $data['active_emp'] = count($this->employer_projects_model->emp_by_approval(1));
        $data['pending_emp'] = count($this->employer_projects_model->emp_by_approval(0));

        //active & pending rd
        $data['active_rd'] = count($this->rd_projects_model->rd_by_approval(1));
        $data['pending_rd'] = count($this->rd_projects_model->rd_by_approval(0));

        $this->load->view('internal/admin_panel/admin_dashboard_view', $data);
        $this->load->view('internal/templates/footer');
    }

    public function get_monthly_user($date1, $date2)         //total users
    {
        $total_per_month = $this->user_model->get_monthly_user($date1, $date2, 'user_ac', 'ac_submitdate') +
            $this->user_model->get_monthly_user($date1, $date2, 'user_e', 'e_submitdate') +
            $this->user_model->get_monthly_user($date1, $date2, 'user_ea', 'ea_submitdate') +
            $this->user_model->get_monthly_user($date1, $date2, 'user_ep', 'ep_submitdate') +
            $this->user_model->get_monthly_user($date1, $date2, 'user_student', 'student_submitdate');
        return $total_per_month;
    }
}
