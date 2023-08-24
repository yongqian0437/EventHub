<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_rd_project extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('universities_model');
		$this->load->model('rd_projects_model');
	
        // Checks if session is set and if user signed in has a role. If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')){  
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is not admin. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Admin"  ){  

			$users['user_role'] = $this->session->userdata('user_role');

			if($users['user_role']=="Student")
			{
				redirect('external/homepage');
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
		$data['include_js'] = 'admin_rd_project_list';
		$data['title'] = 'Admin | R&D Projects';
        $this->load->view('internal/templates/header',$data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/admin_panel/content/admin_rd_project_list_view');
        $this->load->view('internal/templates/footer'); 
    }

	public function admin_all_rd_project_list()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$rd_data = $this->rd_projects_model->select_all_join();
        
		$data = array();

		foreach($rd_data as $r) {

            $view = '<span><button type="button" onclick="view_admin_rd_project('.$r->rd_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_my_rd_project"><span class="fas fa-eye"></span></button></span>';
            
            if($r->rd_approval==1){
                $approval = '<span><button type="button" style = "cursor: default;" class="btn icon-btn btn-xs btn-success waves-effect waves-light">Approved</button></span>';
            } else{
                $approval = '<span><button type="button" onclick="edit_approval('.$r->rd_id.')" class="btn icon-btn btn-xs btn-warning waves-effect waves-light">Pending</button></span>';
            }

			$data[] = array(
                '',
                $r->rd_title,
				$r->rd_pic,
				$r->rd_submitdate,
				$approval,
				$view,
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($rd_data),
			"recordsFiltered" =>count($rd_data),
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

    public function admin_pending_rd_project_list()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$rd_data = $this->rd_projects_model->select_pending_join();
        
		$data = array();

		foreach($rd_data as $r) {

            $view = '<span><button type="button" onclick="view_admin_rd_project('.$r->rd_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_my_rd_project"><span class="fas fa-eye"></span></button></span>';
            
            if($r->rd_approval==1){
                $approval = '<span><button type="button" class="btn icon-btn btn-xs btn-success waves-effect waves-light">Approved</button></span>';
            } else{
                $approval = '<span><button type="button" onclick="edit_approval('.$r->rd_id.')" class="btn icon-btn btn-xs btn-warning waves-effect waves-light">Pending</button></span>';
            }
            $checkbox = '<input type="checkbox" onclick="check('.$r->rd_id.')" value='.$r->rd_id.' id='.$r->rd_id.'>';

			$data[] = array(
                $checkbox,
                '',
                $r->rd_title,
				$r->rd_pic,
				$r->rd_submitdate,
				$approval,
				$view,
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($rd_data),
			"recordsFiltered" =>count($rd_data),
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

	function view_admin_rd_project()
    {

        $rd_detail = $this->rd_projects_model->select_one_rd_join($this->input->post('rd_id'));

        if($rd_detail->rd_approval){
            $approval = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
        }
        else{
            $approval = '<button type="button" style = "cursor: default;" class="btn btn-warning">Pending</button>';
        }

        $output ='
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>R&D PROJECT DETAILS</center></th>
                </tr>
                <tr>
                    <th scope="row">Submit Date</th>
                    <td>'.$rd_detail->rd_submitdate.'</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>'.$approval.'</td>
                </tr>
                <tr>
                    <th scope="row">Title</th>
                    <td>'.$rd_detail->rd_title.'</td>
                </tr>
                <tr>
                    <th scope="row">Organisation</th>
                    <td>'.$rd_detail->rd_organisation.'</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge</th>
                    <td>'.$rd_detail->rd_pic.'</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge position</th>
                    <td>'.$rd_detail->rd_pic_post.'</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge department</th>
                    <td>'.$rd_detail->rd_pic_dept.'</td>
                </tr>
                <tr>
                    <th scope="row">Person in charge email</th>
                    <td>'.$rd_detail->rd_pic_email.'</td>
                </tr>
                <tr>
                    <th scope="row">R&D Scope</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">'.$rd_detail->rd_scope.'</td>
                </tr>
                <tr>
                    <th scope="row">R&D Objective</th>
                    <td style = "white-space: pre-wrap; word-break: break-word; text-align: justify;">'.$rd_detail->rd_objective.'</td>
                </tr>
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="'.base_url("assets/uploads/rd_projects/").$rd_detail->rd_document.'" target="_blank">'.$rd_detail->rd_document.'</a></td>
                </tr>
                <tr>
                    <th colspan="2" style = "background-color: white;" scope="row"></th>        
                <tr>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight:900; font-size:1.1em;" scope="row"><center>EDUCATION PARTNER DETAILS</center></th>
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="' . base_url("assets/img/universities/") . $rd_detail->uni_logo . '" style="width: 250px; height: 100px; object-fit:contain;"></td>
                </tr> 
                <tr>
                    <th scope="row">University Name</th>
                    <td>'.$rd_detail->uni_name.'</td>
                </tr>
                <tr>
                    <th scope="row">University Country</th>
                    <td>'.$rd_detail->uni_country.'</td>
                </tr>
                <tr>
                    <th scope="row">Owner Name</th>
                    <td>'.$rd_detail->user_fname.' '.$rd_detail->user_lname.'</td>
                </tr>
                <tr>
                    <th scope="row">Business Email</th>
                    <td>'.$rd_detail->ep_businessemail.'</td>
                </tr>
                <tr>
                <th scope="row">Phone Number</th>
                    <td>'.$rd_detail->ep_phonenumber.'</td>
                </tr>
                <tr>
                <th scope="row">Nationality</th>
                    <td>'.$rd_detail->ep_nationality.'</td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td>'.$rd_detail->ep_gender.'</td>
                </tr>
                <tr>
                    <th scope="row">Job Title</th>
                    <td>'.$rd_detail->ep_jobtitle.'</td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

    function edit_one_approval()
    {
        $this->rd_projects_model->edit_one_approval($this->input->post('rd_id'));
    }

    function approve_rd() 
    {
        $data = ['rd_approval'=>1]; 
        $this->rd_projects_model->update($data, $this->input->post('rd_id'));
    }

 
}