<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['user_model', 'chat_model', 'user_student_model', 'user_ac_model', 'user_e_model', 'company_model']);
        $this->load->helper('string');
        date_default_timezone_set('Asia/Kuala_Lumpur');

        // Checks if session is set and if user signed in has a role. If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')) {
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is a student, EP or AC. Otherwise, direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Student" && $this->session->userdata('user_role') != "Employer" && $this->session->userdata('user_role') != "Academic Counsellor") {

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
        $user_role = $this->session->userdata('user_role');
        $data['user_role'] = $user_role;
        $data['title'] = 'EventHub | Chat Room';
        $data['sub_title'] = '';
        $data['chat_title'] = 'Select Contact to Chat With';
        $data['profile_pic'] = base_url('assets/img/chat_user/profile_pic.png');

        $list = [];

        // Show ACs and Employers as contacts if Student is accessing the chat
        if ($this->session->userdata['user_role'] == 'Student') {
            $list = $this->user_model->counsellors_list(); // check in model
            $list2 = $this->user_model->employers_list(); // check in model
            $data['sub_title'] = 'Academic Counsellors';
            $data['sub_title2'] = 'Employers';
            $userslist2 = [];
            $userslist = [];

            // Academic Counsellors List
            foreach ($list as $user) {
                $userslist[] =
                    [
                        'user_id'    => $user['user_id'],
                        'user_email' => $user['user_email'],
                        'user_fname' => $user['user_fname'],
                        'user_lname' => $user['user_lname'],
                        'ac_university' => $user['ac_university'],
                        'uni_logo'   => $user['uni_logo'],
                        'uni_country' => $user['uni_country'],
                    ];
            }

            // Employers List
            foreach ($list2 as $user2) {
                $userslist2[] =
                    [
                        'user_id'    => $user2['user_id'],
                        'user_fname' => $user2['user_fname'],
                        'user_lname' => $user2['user_lname'],
                        'c_name'     => $user2['c_name'],
                        'c_logo'     => $user2['c_logo'],
                        'c_country'  => $user2['c_country'],
                        'e_jobtitle' => $user2['e_jobtitle']
                    ];
            }

            $data['userslist2'] = $userslist2;
        }

        // Show Students if AC or Employer is accessing the chat
        else if ($this->session->userdata['user_role'] == 'Employer' || $this->session->userdata['user_role'] == 'Academic Counsellor') {
            $list = $this->user_model->students_list(); // check in model
            $data['sub_title'] = 'Students';

            // Students List
            $userslist = [];
            foreach ($list as $user) {
                $userslist[] =
                    [
                        'user_id'    => $user['user_id'],
                        'user_email' => $user['user_email'],
                        'user_fname' => $user['user_fname'],
                        'user_lname' => $user['user_lname'],
                        'student_nationality' => $user['student_nationality'],
                        'student_interest' => $user['student_interest'],
                        'student_currentlevel' => $user['student_currentlevel']
                    ];
            }
        }

        // var_dump($userslist);
        // die;

        $data['userslist'] = $userslist;
        $data['include_css'] = 'chat';
        $data['include_js'] = 'chat';
        $this->load->view('internal/templates/header', $data); // header

        // Load sidenav if user is a Level 2 user
        if ($user_role != "Student") {
            $this->load->view('internal/templates/sidenav'); // sidenav
            $this->load->view('internal/templates/topbar'); // topbar
        }

        $this->load->view('user/chat/chat_view', $data);
        $this->load->view('internal/templates/footer', $data); // footer
    }

    public function send_text_message()
    {
        $post = $this->input->post();
        $text_message = 'NULL';
        $attachment_name = '';
        $file_ext = '';
        $mime_type = '';

        // If sender sends an attachment
        if (isset($post['type']) == 'Attachment') {
            $attachment_data = $this->chat_attachment_upload();
            $attachment_name = $attachment_data['file_name'];
            $file_ext = $attachment_data['file_ext'];
            $mime_type = $attachment_data['file_type'];
        } else {
            $text_message = reduce_multiples($post['text_message'], ' ');
        }

        $data =
            [
                'sender_id'         => $this->session->userdata['user_id'],
                'receiver_id'       => $post['receiver_id'],
                'message'           => $text_message,
                'attachment_name'   => $attachment_name,
                'file_extension'    => $file_ext,
                'mime_type'         => $mime_type,
                'message_date_time' => date('Y-m-d h:i:s A'), //23 Jan 2:05 pm 'H' 24 hours, 'h' 12
                'ip_address'        => $this->input->ip_address(),
            ];

        $query = $this->chat_model->send_message($data); // check in model

        $response = '';
        if ($query == true) {
            $response = ['status' => 1, 'message' => ''];
        } else {
            $response = ['status' => 0, 'message' => 'Sorry, there seems to be a technical error that occured. Please try again.'];
        }

        echo json_encode($response); // remove later
    }

    public function chat_attachment_upload()
    {
        $file_data = '';

        // If user decides to send an attachment
        if (isset($_FILES['attachmentfile']['name']) && !empty($_FILES['attachmentfile']['name'])) {
            $config['upload_path']          = './assets/uploads/chat_attachments'; // Store attachments in this folder
            $config['allowed_types']        = 'jpeg|jpg|png|txt|pdf|docx|xlsx|pptx|rtf';
            //$config['max_size']             = 500;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('attachmentfile')) {
                echo json_encode([
                    'status' => 0,
                    'message' => '<span style="color:#900;">' . $this->upload->display_errors() . '<span>'
                ]);
            } else {
                $file_data = $this->upload->data();
                //$filePath = $file_data['file_name'];
                return $file_data;
            }
        }
    }

    public function get_chat_history()
    {
        $receiver_id = $this->input->get('receiver_id');
        // var_dump($receiver_id);
        // die;
        $Logged_sender_id = $this->session->userdata['user_id'];

        $history = $this->chat_model->receiver_chat_history($receiver_id); // check in model

        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        // Get current user's country/nationality
        $current_user_data = $this->user_model->get_user_data();

        if ($current_user_data['user_role'] == 'Student') {
            $student_details = $this->user_student_model->student_details($Logged_sender_id);
            $sender_country = $student_details['student_nationality'];
        } else if ($current_user_data['user_role'] == 'Academic Counsellor') {
            $ac_details = $this->user_ac_model->ac_details($Logged_sender_id);
            $sender_country = $this->user_ac_model->ac_university_country($ac_details['ac_university']);
        } else {
            $e_details =  $this->user_e_model->e_details($Logged_sender_id);
            $e_company_details = $this->company_model->c_details($e_details['c_id']);
            $sender_country = $e_company_details['c_country'];
        }

        // Get receiver's country/nationality
        $receiver_user_data = $this->user_model->search_id($receiver_id);
        if ($receiver_user_data->user_role == 'Student') {
            $student_details = $this->user_student_model->student_details($receiver_id);
            $receiver_country = $student_details['student_nationality'];
        } else if ($receiver_user_data->user_role == 'Academic Counsellor') {
            $ac_details = $this->user_ac_model->ac_details($receiver_id);
            $receiver_country = $this->user_ac_model->ac_university_country($ac_details['ac_university']);
        } else {
            $e_details =  $this->user_e_model->e_details($receiver_id);
            $e_company_details = $this->company_model->c_details($e_details['c_id']);
            $receiver_country =  $e_company_details['c_country'];
        }

        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        //print_r($history);
        foreach ($history as $chat) :
            $message_id = $chat['chat_id'];
            $sender_id = $chat['sender_id'];
            $userName = $this->user_model->get_name($chat['sender_id']); // check in model
            $userPic = base_url('assets/img/chat_user/profile_pic.png'); // Set default user picture
            $message = $chat['message'];
            $messagedatetime = date('d M h:i A', strtotime($chat['message_date_time']));
?>
            <?php
            $messageBody = '';
            if ($message == 'NULL') //fetch media objects like images,pdf,documents etc
            {
                $classBtn = 'right';
                if ($Logged_sender_id == $sender_id) {
                    $classBtn = 'left';
                }

                $attachment_name = $chat['attachment_name'];
                $file_ext = $chat['file_extension'];
                $mime_type = explode('/', $chat['mime_type']);

                $document_url = base_url('assets/uploads/chat_attachments/' . $attachment_name);

                if ($mime_type[0] == 'image') {
                    $messageBody .= '<img src="' . $document_url . '" onClick="ViewAttachmentImage(' . "'" . $document_url . "'" . ',' . "'" . $attachment_name . "'" . ');" class="attachmentImgCls" style="width: 200px">';
                } else {
                    $messageBody = '';
                    // Appends text on the right to $messageBody
                    $messageBody .= '<div class="attachment">';
                    $messageBody .= '<h6>Attachments:</h6>';
                    $messageBody .= '<p class="filename font-weight-bold">';
                    $messageBody .= $attachment_name;
                    $messageBody .= '<br><br></p>';
                    $messageBody .= '<div class="pull-' . $classBtn . '">';
                    $messageBody .= '<a download href="' . $document_url . '" target="_blank"><button type="button" id="' . $message_id . '" class="btn btn-primary btn-sm btn-flat btnFileOpen">Open</button></a>';
                    $messageBody .= '</div>';
                    $messageBody .= '</div>';
                }
            } else {
                $messageBody = $message;
            }
            ?>

            <?php
            // If the current user is NOT the sender of the message
            if ($Logged_sender_id != $sender_id) {
            ?>
                <!-- Message is displayed to the left by default -indicating that it is from another user- -->
                <div class="direct-chat-msg">

                    <div class="row" style="width: 100%">
                        <div class="col-1"></div>
                        <div class="col-11">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left"><?= $userName; ?></span>
                                <span class="direct-chat-timestamp pull-right"><?= $messagedatetime; ?>, </span>
                                <span><?= $receiver_country ?></span>
                                <!--EP CP change: add country-->
                            </div>
                        </div>
                    </div>

                    <div class="row" style="width: 100%">
                        <div class="col-1 d-flex justify-content-end">
                            <img class="direct-chat-img" src="<?= $userPic; ?>" alt="<?= $userName; ?>">
                        </div>
                        <div class="col-9">
                            <div class="direct-chat-text">
                                <?= $messageBody; ?>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>

                </div>
                <!-- /.direct-chat-msg -->
            <?php
            }
            // If the current user is the sender of the message
            else {
            ?>
                <!-- Message is displayed to the right -->
                <div class="direct-chat-msg right">

                    <div class="row" style="width: 100%">
                        <div class="col-11">
                            <div class="direct-chat-info clearfix" style="text-align: right;">
                                <span class="direct-chat-name"><?= $userName; ?></span>
                                <span class="direct-chat-timestamp"><?= $messagedatetime; ?>, </span>
                                <span><?= $sender_country ?></span>
                                <!--EP CP change: add country-->
                            </div>
                        </div>
                    </div>

                    <div class="row" style="width: 100%">
                        <div class="col-2"></div>
                        <div class="col-9 right d-flex justify-content-end">
                            <div class="direct-chat-text">
                                <?= $messageBody; ?>
                            </div>
                        </div>
                        <div class="col-1 d-flex justify-content-start">
                            <img class="direct-chat-img" src="<?= $userPic; ?>" alt="<?= $userName; ?>">
                        </div>
                    </div>

                </div>
                <!-- /.direct-chat-msg -->
            <?php
            }
            ?>

<?php endforeach;
    }

    // public function clear_chat()
    // {
    //     $receiver_id = $this->input->get('receiver_id');

    //     // Get messages that were sent to the specific receiver
    //     $messagelist = $this->chat_model->receiver_message_list($receiver_id) ; // check in model

    //     foreach ($messagelist as $row) 
    //     {
    //         if ($row['message'] == 'NULL') 
    //         {
    //             $attachment_name = unlink('assets/uploads/chat_attachments/' . $row['attachment_name']);
    //         }
    //     }

    //     // Delete the messages sent
    //     $this->chat_model->clear_chat_by_id($receiver_id) ; // check in model
    // }

}
