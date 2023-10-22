<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_user_acc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'user_student_model', 'user_ep_model', 'user_ac_model', 'user_ea_model',
            'user_e_model', 'organizer_model', 'company_model', 'events_model'
        ]);
        // date_default_timezone_set('Asia/Kuala_Lumpur');

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
        $data['title'] = 'Admin | All Users';
        $data['include_js'] = 'admin_all_users_list';

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/admin_panel/users_accounts_view');
        $this->load->view('internal/templates/footer');
    }

    public function all_users_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $all_users_details = $this->user_model->all_users_details();
        //$student_submitdate=$this->user_model->student_submitdate();

        $data = array();
        $base_url = base_url();

        foreach ($all_users_details as $users) {

            $view = '<span class = "px-1"><button type="button" onclick="view_user(' . $users->user_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_user"><span class="fas fa-eye"></span></button></span>';

            // $submitdate=$ep_detail->ep_submitdate;
            if ($users->user_approval == 0) {
                $status = '<button type="button" onclick="activate_user(' . $users->user_id . ')" class="btn btn-warning">Inactive</button>';
            } else {
                $status = '<button type="button" onclick="deactivate_user(' . $users->user_id . ')" class="btn btn-success">Active</button>';
            }

            // Get students'submitdate
            if ($users->user_role == "Student") {
                $student_detail = $this->user_student_model->get_student_detail($users->user_id);
                $submitdate = $student_detail->student_submitdate;
            }

            // Get eas'submitdate
            else if ($users->user_role == "Education Agent") {
                $ea_detail = $this->user_ea_model->get_ea_detail($users->user_id);
                $submitdate = $ea_detail->ea_submitdate;
            }

            // Get emps'submitdate
            else if ($users->user_role == "Employer") {
                $e_detail = $this->user_e_model->get_e_detail($users->user_id);
                $submitdate = $e_detail->e_submitdate;
            }

            // Get acs'submitdate
            else if ($users->user_role == "Academic Counsellor") {
                $ac_detail = $this->user_ac_model->get_ac_detail($users->user_id);
                $submitdate = $ac_detail->ac_submitdate;
            }

            // Get eps'submitdate
            else {
                $ep_detail = $this->user_ep_model->get_ep_detail($users->user_id);
                $submitdate = $ep_detail->ep_submitdate;
                //var_dump($ep_detail);
            }


            $data[] = array(
                '',
                $users->user_fname . " " . $users->user_lname,
                $users->user_email,
                $users->user_role,
                //$users->user_submitdate,
                $submitdate,
                $status,
                $view,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($all_users_details),
            "recordsFiltered" => count($all_users_details),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function active_users_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $active_users_details = $this->user_model->full_active_users_details();

        $data = array();
        $base_url = base_url();

        foreach ($active_users_details as $users) {

            $view = '<span class = "px-1"><button type="button" onclick="view_user(' . $users->user_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_user"><span class="fas fa-eye"></span></button></span>';
            $status = '<button type="button" onclick="deactivate_user(' . $users->user_id . ')" class="btn btn-success">Active</button>';
            $checkbox = '<input type="checkbox" onclick="check(' . $users->user_id . ')" value=' . $users->user_id . ' id=' . $users->user_id . '>';

            // Get students'submitdate
            if ($users->user_role == "Student") {
                $student_detail = $this->user_student_model->get_student_detail($users->user_id);
                $submitdate = $student_detail->student_submitdate;
            }

            // Get eas'submitdate
            else if ($users->user_role == "Education Agent") {
                $ea_detail = $this->user_ea_model->get_ea_detail($users->user_id);
                $submitdate = $ea_detail->ea_submitdate;
            }

            // Get emps'submitdate
            else if ($users->user_role == "Employer") {
                $e_detail = $this->user_e_model->get_e_detail($users->user_id);
                $submitdate = $e_detail->e_submitdate;
            }

            // Get acs'submitdate
            else if ($users->user_role == "Academic Counsellor") {
                $ac_detail = $this->user_ac_model->get_ac_detail($users->user_id);
                $submitdate = $ac_detail->ac_submitdate;
            }

            // Get eps'submitdate
            else {
                $ep_detail = $this->user_ep_model->get_ep_detail($users->user_id);
                $submitdate = $ep_detail->ep_submitdate;
            }

            $data[] = array(
                $checkbox,
                '',
                $users->user_fname . " " . $users->user_lname,
                $users->user_email,
                $users->user_role,
                //$users->user_submitdate,
                $submitdate,
                $status,
                $view,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($active_users_details),
            "recordsFiltered" => count($active_users_details),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function inactive_users_list()
    {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $inactive_users_details = $this->user_model->full_inactive_users_details();


        $data = array();
        $base_url = base_url();

        foreach ($inactive_users_details as $users) {

            $view = '<span class = "px-1"><button type="button" onclick="view_user(' . $users->user_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_user"><span class="fas fa-eye"></span></button></span>';
            $status = '<button type="button" onclick="activate_user(' . $users->user_id . ')" class="btn btn-warning">Inactive</button>';
            $checkbox = '<input type="checkbox" onclick="check(' . $users->user_id . ')" value=' . $users->user_id . ' id=' . $users->user_id . '>';

            // Get students'submitdate
            if ($users->user_role == "Student") {
                $student_detail = $this->user_student_model->get_student_detail($users->user_id);
                $submitdate = $student_detail->student_submitdate;
            }

            // Get eas'submitdate
            else if ($users->user_role == "Education Agent") {
                $ea_detail = $this->user_ea_model->get_ea_detail($users->user_id);
                $submitdate = $ea_detail->ea_submitdate;
            }

            // Get emps'submitdate
            else if ($users->user_role == "Employer") {
                $e_detail = $this->user_e_model->get_e_detail($users->user_id);
                $submitdate = $e_detail->e_submitdate;
            }

            // Get acs'submitdate
            else if ($users->user_role == "Academic Counsellor") {
                $ac_detail = $this->user_ac_model->get_ac_detail($users->user_id);
                $submitdate = $ac_detail->ac_submitdate;
            }

            // Get eps'submitdate
            else {
                $ep_detail = $this->user_ep_model->get_ep_detail($users->user_id);
                $submitdate = $ep_detail->ep_submitdate;
                //var_dump($ep_detail);
            }


            $data[] = array(
                $checkbox,
                '',
                $users->user_fname . " " . $users->user_lname,
                $users->user_email,
                $users->user_role,
                //$users->user_submitdate,
                $submitdate,
                $status,
                $view,
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($inactive_users_details),
            "recordsFiltered" => count($inactive_users_details),
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    function activate_user()
    {
        $data = ['user_approval' => 1];
        $this->user_model->update($data, $this->input->post('user_id'));

        $users = $this->user_model->search_id($this->input->post('user_id'));
        //$user_email= $this->input->post('user_email');
        $message = "Welcome, " . "$users->user_fname " . "$users->user_lname" . ". Thank you for registering and being part of EventHub, Campus Event System" . "<br><br>Congratulations! Your account has been approved and is now activated. <br><br>You may now login to the system at any time. Your credentials are the same as the ones you have provided upon registration.<br><br><b>EventHub<br>Campus Event Management System"
            . "<br>EVENTHUB. Book and Join Events Online.</b>";
        $this->Email($users->user_email, $message);
    }

    public function Email($user_email, $message)
    {

        $config =
            [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_user' => 'yongqian0437@gmail.com', //important
                'smtp_pass' => 'ekmjwbfajvxepeag', //important
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];

        $this->email->initialize($config);
        $this->email->from('yongqian0437@gmail.com', 'EventHub');
        $this->email->to($user_email);
        $this->email->subject("Account Verification");
        $this->email->message($message);

        if ($this->email->send()) {
        } else {
            echo $this->email->print_debugger();
        }
    }

    function deactivate_user()
    {
        $data = ['user_approval' => 0];
        $this->user_model->update($data, $this->input->post('user_id'));
    }

    function view_user()
    {

        //general users//
        $user_detail = $this->user_model->get_user_id($this->input->post('user_id'));

        //student details//
        $student_detail = $this->user_student_model->get_student_detail($this->input->post('user_id'));

        //ea details//
        $ea_detail = $this->user_ea_model->get_ea_detail($this->input->post('user_id'));

        //ac details//
        $ac_detail = $this->user_ac_model->get_ac_detail($this->input->post('user_id'));

        if ($user_detail->user_role == "Education Partner") {
            //ep and org details//
            $ep_detail = $this->user_ep_model->get_ep_detail($this->input->post('user_id'));
            $org_detail = $this->organizer_model->get_org_detail($ep_detail->organizer_id);

            if ($org_detail->organizer_approval == 0) {
                $ep_status = '<button type="button" style = "cursor: default;" class="btn btn-warning">Inactive</button>';
            } else {
                $ep_status = '<button type="button" style = "cursor: default;" class="btn btn-success">Active</button>';
            }
        }

        if ($user_detail->user_role == "Employer") {
            // e and company details
            $e_detail = $this->user_e_model->get_e_detail($this->input->post('user_id'));
            $c_detail = $this->company_model->get_c_detail($e_detail->c_id);
        }

        if ($user_detail->user_approval == 0) {
            $user_status = '<button type="button" style = "cursor: default;" class="btn btn-warning">Inactive</button>';
        } else {
            $user_status = '<button type="button" style = "cursor: default;" class="btn btn-success">Active</button>';
        }

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">USER DETAILS</th>   
                </tr>
                <tr>
                    <th scope="row">Full Name</th>
                    <td>' . $user_detail->user_fname . ' ' . $user_detail->user_lname . '</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>' . $user_detail->user_email . '</td>
                </tr>
                <tr>
                    <th scope="row">Role</th>
                    <td>' . $user_detail->user_role . '</td>
                </tr>
                <tr>
                    <th scope="row">Action</th>
                    <td>' . $user_status . '</td>
                </tr>
                
            </tbody>
        </table>';
        echo $output;

        if ($user_detail->user_role == "Student") {
            $output = '
            <table class="table table-striped" style = "border:0;">
                <tbody>
                    <tr>
                        <th colspan="2" style = "background-color: white"></th>   
                    </tr>
                    <tr>
                        <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">STUDENT</th>   
                    </tr>
                    <tr>
                        <th scope="row">Applied Date</th>
                        <td>' . $student_detail->student_submitdate . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td>' . $student_detail->student_phonenumber . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Nationality</th>
                        <td>' . $student_detail->student_nationality . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td>' . $student_detail->student_gender . '</td>
                    </tr>
                    <tr>
                        <th scope="row">DOB</th>
                        <td>' . $student_detail->student_dob . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Interest</th>
                        <td>' . $student_detail->student_interest . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Current Level</th>
                        <td>' . $student_detail->student_currentlevel . '</td>
                    </tr>
                </tbody>
            </table>';
            echo $output;
        }

        if ($user_detail->user_role == "Education Agent") {
            $output = '
            <table class="table table-striped" style = "border:0;">
                <tbody>
                    <tr>
                        <th colspan="2" style = "background-color: white"></th>   
                    </tr>
                    <tr>
                        <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">EDUCATION AGENT</th>   
                    </tr>
                    <tr>
                        <th scope="row">Applied Date</th>
                        <td>' . $ea_detail->ea_submitdate . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td>' . $ea_detail->ea_phonenumber . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Business Email</th>
                        <td>' . $ea_detail->ea_businessemail . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Nationality</th>
                        <td>' . $ea_detail->ea_nationality . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td>' . $ea_detail->ea_gender . '</td>
                    </tr>
                    <tr>
                        <th scope="row">DOB</th>
                        <td>' . $ea_detail->ea_dob . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Document</th>
                        <td><a href="' . base_url("assets/uploads/education_agents/") . $ea_detail->ea_document . '" target="_blank">' . $ea_detail->ea_document . '</a></td>
                </tbody>
            </table>';
            echo $output;
        }

        if ($user_detail->user_role == "Employer") {
            $output = '
            <table class="table table-striped" style = "border:0;">
                <tbody>
                    <tr>
                        <th colspan="2" style = "background-color: white"></th>   
                    </tr>
                    <tr>
                        <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">EMPLOYER</th>   
                    </tr>
                    <tr>
                        <th scope="row">Applied Date</th>
                        <td>' . $e_detail->e_submitdate . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td>' . $e_detail->e_phonenumber . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Business Email</th>
                        <td>' . $e_detail->e_businessemail . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Nationality</th>
                        <td>' . $e_detail->e_nationality . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td>' . $e_detail->e_gender . '</td>
                    </tr>
                    <tr>
                        <th scope="row">DOB</th>
                        <td>' . $e_detail->e_dob . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Job Title</th>
                        <td>' . $e_detail->e_jobtitle . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Document</th>
                        <td><a href="' . base_url("assets/uploads/employer/") . $e_detail->e_document . '" target="_blank">' . $e_detail->e_document . '</a></td>
                    <tr>
                    <tr>
                        <th colspan="2" style = "background-color: white"></th>   
                    </tr>
                    <tr>
                        <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">COMPANY</th>   
                    </tr>
                    <tr style="text-align: center">
                        <td colspan="2"><img src="' . base_url("assets/img/company_logos/") . $c_detail->c_logo . '" style="width: 250px; height: 100px; object-fit:contain;">
                        </td>  
                    </tr>
                    <tr>
                        <th scope="row">Company</th>
                        <td>' . $c_detail->c_name . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Country</th>
                        <td>' . $c_detail->c_country . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Registration Number</th>
                        <td>' . $c_detail->c_registrationnum . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Company Address</th>
                        <td>' . $c_detail->c_address . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td>' . $c_detail->c_phonenumber . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Website</th>
                        <td>' . $c_detail->c_website . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>' . $c_detail->c_email . '</td>
                    </tr>
                </tbody>
            </table>';
            echo $output;
        }

        if ($user_detail->user_role == "Education Partner") {
            $output = '
            <table class="table table-striped" style = "border:0;">
                <tbody>
                    <tr>
                        <th colspan="2" style = "background-color: white"></th>   
                    </tr>
                    <tr>
                        <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">EDUCATION PARTNER</th>   
                    </tr>
                    <tr>
                        <th scope="row">Applied Date</th>
                        <td>' . $ep_detail->ep_submitdate . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td>' . $ep_detail->ep_phonenumber . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Business Email</th>
                        <td>' . $ep_detail->ep_businessemail . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Nationality</th>
                        <td>' . $ep_detail->ep_nationality . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td>' . $ep_detail->ep_gender . '</td>
                    </tr>
                    <tr>
                        <th scope="row">DOB</th>
                        <td>' . $ep_detail->ep_dob . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Document</th>
                        <td><a href="' . base_url("assets/uploads/education_partner/") . $ep_detail->ep_document . '" target="_blank">' . $ep_detail->ep_document . '</a></td>
                    <tr>
                   
                    </tbody>
            </table>';

            $output2 = '
                <table class="table table-striped" style = "border:0;">
                    <tbody>
                        <div class="d-grid gap-2 col-2 mx-auto">
                        <button type="button" onclick="view_next(' . $ep_detail->user_id . ')" data-toggle="modal"  data-target="#view_next" class="btn btn-info">Next</button>
                        </div>
                    </tbody>
                </table>';

            echo $output;
            echo $output2;
        }

        if ($user_detail->user_role == "Academic Counsellor") {
            $output = '
            <table class="table table-striped" style = "border:0;">
                <tbody>
                    <tr>
                        <th colspan="2" style = "background-color: white"></th>   
                    </tr>
                    <tr>
                        <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">ACADEMIC COUNSELLOR</th>   
                    </tr>
                    <tr>
                        <th scope="row">Applied Date</th>
                        <td>' . $ac_detail->ac_submitdate . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td>' . $ac_detail->ac_phonenumber . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Business Email</th>
                        <td>' . $ac_detail->ac_businessemail . '</td>
                    </tr>
                    <tr>
                        <th scope="row">organizers</th>
                        <td>' . $ac_detail->ac_organizers . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Nationality</th>
                        <td>' . $ac_detail->ac_nationality . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td>' . $ac_detail->ac_gender . '</td>
                    </tr>
                    <tr>
                        <th scope="row">DOB</th>
                        <td>' . $ac_detail->ac_dob . '</td>
                    </tr>
                    <tr>
                        <th scope="row">Document</th>
                        <td><a href="' . base_url("assets/uploads/academic_counsellor/") . $ac_detail->ac_document . '" target="_blank">' . $ac_detail->ac_document . '</a></td>
                    </tr>
                </tbody>
            </table>';
            echo $output;
        }
    }

    public function view_next()
    {
        $all_users_details = $this->user_model->all_users_details();

        foreach ($all_users_details as $users) {
            $view = '<span class = "px-1"><button type="button" onclick="view_user(' . $users->user_id . ')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_user"><span class="fas fa-eye"></span></button></span>';
        }
        //$ep_detail=$this->user_ep_model->get_full_ep_detail($this->input->post('user_id'));
        $ep_detail = $this->user_ep_model->get_ep_detail($this->input->post('user_id'));
        $org_detail = $this->organizer_model->get_org_detail($ep_detail->organizer_id);

        $output = '
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">organizers</th>   
                </tr>
                <tr>
                    <th scope="row">Applied Date</th>
                    <td>' . $org_detail->organizer_submitdate . '</td>
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/organizer/") . $org_detail->organizer_logo . '" style="width: 250px; height: 100px; object-fit:contain;">
                    </td>  
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/organizer/") . $org_detail->organizer_background . '" style="width: 250px; height: 100px; object-fit:contain;">
                    </td>  
                </tr>
                
                <tr>
                    <th scope="row">organizers</th>
                    <td>' . $org_detail->organizer_name . '</td>
                </tr>
                <tr>
                    <th scope="row">Short Profile</th>
                    <td>' . $org_detail->organizer_shortprofile . '</td>
                </tr>
                <tr>
                    <th scope="row">Fun Fact</th>
                    <td>' . $org_detail->organizer_fun_fact . '</td>
                </tr>
                <tr>
                    <th scope="row">Country</th>
                    <td>' . $org_detail->organizer_country . '</td>
                </tr>
                <tr>
                    <th scope="row">Hotline</th>
                    <td>' . $org_detail->organizer_hotline . '</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>' . $org_detail->organizer_email . '</td>
                </tr>
                <tr>
                    <th scope="row">organizers Address</th>
                    <td>' . $org_detail->organizer_address . '</td>
                </tr>
                <tr>
                    <th scope="row">Website</th>
                    <td>' . $org_detail->organizer_website . '</td>
                </tr>
                <tr>
                    <th scope="row">QS Rank</th>
                    <td>' . $org_detail->uni_qsrank . '</td>
                </tr>
                <tr>
                    <th scope="row">Employability Rank</th>
                    <td>' . $org_detail->uni_employabilityrank . '</td>
                </tr>
                <tr>
                    <th scope="row">Total Students</th>
                    <td>' . $org_detail->uni_totalstudents . '</td>
                </tr>
                
            </tbody>
           
        </table>';

        echo $output;
    }
}
