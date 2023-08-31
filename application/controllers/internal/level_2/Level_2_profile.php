<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level_2_profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user_model', 'user_ac_model', 'user_e_model', 'user_ea_model', 'user_ep_model']);

        // Checks if session is set and if user signed in has a role. If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is an admin or student. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') == "Student" || $this->session->userdata('user_role') == "Admin") {

            $users['user_role'] = $this->session->userdata('user_role');

            if ($users['user_role'] == "Admin") {
                redirect('internal/admin_panel/Admin_dashboard');
            }
            // check user role is  Student
            else if ($users['user_role'] == "Student") {
                redirect('external/homepage');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'EventHub | Profile';
        $user_id = $this->session->userdata('user_id');
        $data['user_role'] = $this->session->userdata('user_role');

        $user_data = $this->user_model->get_user_data();
        $data['user_data'] = $user_data;

        // From the User ID, get AC data  
        $ac_data = $this->user_ac_model->ac_details($user_id);
        $data['ac_data'] = $ac_data;

        $e_data = $this->user_e_model->e_profile_details($user_id);
        $data['e_data'] = $e_data;

        $ea_data = $this->user_ea_model->ea_details($user_id);
        $data['ea_data'] = $ea_data;

        $ep_data = $this->user_ep_model->ep_profile_details($user_id);
        $data['ep_data'] = $ep_data;

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav', $data);
        $this->load->view('internal/templates/topbar', $data);
        $this->load->view('internal/level_2/level2_profile_view');
        $this->load->view('internal/templates/footer');
    }

    public function edit_profile()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user_role'] = $this->session->userdata('user_role');
        $user_role = $data['user_role'];
        $ac_id = $this->user_ac_model->ac_details($user_id);
        $e_id = $this->user_e_model->e_details($user_id);
        $ea_id = $this->user_ea_model->ea_details($user_id);
        $ep_id = $this->user_ep_model->ep_details($user_id);

        /*  $data = [
            'user_email' => htmlspecialchars($this->input->post('user_email'))
        ];
        $data['user_data'] = $this->user_model->update($user_id, $data); */

        if ($user_role == 'Academic Counsellor') {
            $data =
                [
                    'ac_businessemail' => htmlspecialchars($this->input->post('business_email')),
                    'ac_phonenumber' => htmlspecialchars($this->input->post('phonenumber')),
                ];
            $data['ac_data'] = $this->user_ac_model->update($data, $ac_id['ac_id']);
        } else if ($user_role == 'Employer') {
            $data =
                [
                    'e_businessemail' => htmlspecialchars($this->input->post('business_email')),
                    'e_phonenumber' => htmlspecialchars($this->input->post('phonenumber')),
                ];
            $data['e_data'] = $this->user_e_model->update($data, $e_id['e_id']);
        } else if ($user_role == 'Education Agent') {
            $data =
                [
                    'ea_businessemail' => htmlspecialchars($this->input->post('business_email')),
                    'ea_phonenumber' => htmlspecialchars($this->input->post('phonenumber')),
                ];
            $data['ea_data'] = $this->user_ea_model->update($data, $ea_id['ea_id']);
        } else if ($user_role == 'Education Partner') {
            $data =
                [
                    'ep_businessemail' => htmlspecialchars($this->input->post('business_email')),
                    'ep_phonenumber' => htmlspecialchars($this->input->post('phonenumber')),
                ];
            $data['ep_data'] = $this->user_ep_model->update($data, $ep_id['ep_id']);
        }

        $this->session->set_flashdata('edit_message', 1);
        /* var_dump($this->session->flashdata('edit_message'));
        die; */

        redirect('/internal/level_2/Level_2_profile');
    }
}
