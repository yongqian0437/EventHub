<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_emps extends CI_Controller 
{

    public function __construct()
	{
		parent::__construct();
		$this->load->model(['user_e_model', 'company_model', 'employer_projects_model']);
        date_default_timezone_set('Asia/Kuala_Lumpur');

        // Checks if session is set and if user is signed in as Admin (authorised access). If not, deny his/her access.
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_role') != "Admin"){  
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
        $data['title'] = 'Admin | Employer Projects (EPs)';
        $data['include_js'] = 'admin_emp_list';
        
        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/admin_panel/content/admin_emp_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function all_emp_list()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

        $employer_projects = $this->employer_projects_model->full_emps_details();

		$data = array();
		$base_url = base_url();

		foreach($employer_projects as $emp) {

			$view = '<span class = "px-1"><button type="button" onclick="view_emp('.$emp->emp_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_emp"><span class="fas fa-eye"></span></button></span>';

            if ($emp->emp_approval == 0) {
                $status = '<button type="button" onclick="approve_emp('.$emp->emp_id.')" class="btn btn-warning">Pending</button>';
            } else {
                $status = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
            }

			$data[] = array(
				'',
				$emp->c_name,
				$emp->emp_title,
                $emp->emp_submitdate,
                $status,
                $view,
			);

		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($employer_projects),
			"recordsFiltered" =>count($employer_projects),
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

    public function pending_emp_list()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

        $employer_projects = $this->employer_projects_model->full_pending_emps_details();

		$data = array();
		$base_url = base_url();

		foreach($employer_projects as $emp) {

			$view = '<span class = "px-1"><button type="button" onclick="view_emp('.$emp->emp_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_emp"><span class="fas fa-eye"></span></button></span>';
            $status = '<button type="button" onclick="approve_emp('.$emp->emp_id.')" class="btn btn-warning">Pending</button>';
            $checkbox = '<input type="checkbox" onclick="check('.$emp->emp_id.')" value='.$emp->emp_id.' id='.$emp->emp_id.'>';
			$data[] = array(
                $checkbox,
				'',
				$emp->c_name,
				$emp->emp_title,
                $emp->emp_submitdate,
                $status,
                $view,
			);

		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => count($employer_projects),
			"recordsFiltered" =>count($employer_projects),
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

    function view_emp()
    {
        $emp_detail = $this->employer_projects_model->emp_details($this->input->post('emp_id'));
        // var_dump($emp_detail);
        // die;

        if ($emp_detail[0]->emp_approval == 0) {
            $status = '<button type="button" style = "cursor: default;" class="btn btn-warning">Pending</button>';
        } else {
            $status = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
        }

        $output ='
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">EMPLOYER DETAILS</th>   
                </tr>
                <tr style="text-align: center">
                    <td colspan="2"><img src="'.base_url("assets/img/company_logos/").$emp_detail[0]->c_logo.'" style="width: 250px; height: 100px; object-fit:contain;">
                    </td>  
                </tr>
                <tr>
                    <th scope="row">Company</th>
                    <td>'.$emp_detail[0]->c_name.'</td>
                </tr>
                <tr>
                    <th scope="row">Country</th>
                    <td>'.$emp_detail[0]->c_country.'</td>
                </tr>
                <tr>
                    <th scope="row">Employer</th>
                    <td>'.$emp_detail[0]->user_fname. ' ' .$emp_detail[0]->user_lname.'</td>
                </tr>
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>'.$emp_detail[0]->e_phonenumber.'</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>'.$emp_detail[0]->user_email.'</td>
                </tr>
                <tr>
                    <th colspan="2" style = "background-color: white"></th>   
                </tr>
                </tr>
                <tr>
                    <th colspan="2" style = "background-color: #CCE3DE; font-weight: 900; text-align: center; font-size: 1.1em;">EMPLOYER PROJECT (EP) DETAILS</th>   
                </tr>
                <tr>
                    <th scope="row">Date Submitted</th>
                    <td>'.$emp_detail[0]->emp_submitdate.'</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>'.$status.'</td>
                </tr>
                <tr>
                    <th scope="row">Title</th>
                    <td>'.$emp_detail[0]->emp_title.'</td>
                </tr>
                <tr>
                    <th scope="row">Field(s)</th>
                    <td>'.$emp_detail[0]->emp_area.'</td>
                </tr>
                <tr>
                    <th scope="row">Level</th>
                    <td>'.$emp_detail[0]->emp_level.'</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td>'.$emp_detail[0]->emp_description.'</td>
                </tr>
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="'.base_url("assets/uploads/employer_projects/").$emp_detail[0]->emp_document.'" target="_blank">'.$emp_detail[0]->emp_document.'</a></td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

    function approve_emp() 
    {
        $data = ['emp_approval'=>1]; 
        $this->employer_projects_model->update($data, $this->input->post('emp_id'));
    }

}
?>