<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_emps extends CI_Controller 
{

    public function __construct()
	{
		parent::__construct();
		$this->load->model(['user_e_model', 'company_model', 'employer_projects_model']);
        date_default_timezone_set('Asia/Kuala_Lumpur');
        
        // Checks if session is set and if user is signed in as Employer (authorised access). If not, deny his/her access.
        if (!$this->session->userdata('user_id') || !$this->session->userdata('user_role')){  
            redirect('user/login/Auth/login');
        }

        // Checks if session is set and if user signed in is not employer. Direct them back to their own dashboard.
        if ($this->session->has_userdata('has_login') && $this->session->userdata('user_role') != "Employer"  ){  

			$users['user_role'] = $this->session->userdata('user_role');

			if($users['user_role']=="Admin")
			{
				redirect('internal/admin_panel/Admin_dashboard');
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
			// check user role is Student
			else if ($users['user_role']=="Student")
			{
				redirect('external/homepage');
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
        $data['title'] = 'iJEES | Employer Projects (EPs)';
        $data['include_js'] = 'employer_emp_list';

        $e_details = $this->user_e_model->e_details($this->session->userdata('user_id'));
        $data['company_details'] = $this->company_model->c_details($e_details['c_id']);
        $data['employer_projects'] = $this->employer_projects_model->get_emps_from_employer($e_details['e_id']);

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/employer/employer_emp_list_view');
        $this->load->view('internal/templates/footer');
    }

    public function emp_list()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

        $e_details = $this->user_e_model->e_details($this->session->userdata('user_id'));
        $employer_projects = $this->employer_projects_model->get_emps_from_employer($e_details['e_id']);

		$data = array();
		$base_url = base_url();

		foreach($employer_projects as $emp) {
            $edit_link = $base_url."internal/level_2/Employer/Employer_emps/edit_emp/".$emp->emp_id;

            $delete = '<span><button type="button" onclick="delete_emp('.$emp->emp_id.')" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" ><span class="fas fa-trash"></span></button></span>';
			$edit_opt = '<span class = "px-1"><a type="button" href = "'.$edit_link.'"class="btn icon-btn btn-xs btn-primary waves-effect waves-light"><span class="fas fa-pencil-alt"></span></a></span>';
			$view = '<span><button type="button" onclick="view_emp('.$emp->emp_id.')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_emp"><span class="fas fa-eye"></span></button></span>';
			$function = $view.$edit_opt.$delete;

            if ($emp->emp_approval == 0) {
                $status = '<button type="button" style = "cursor: default;" class="btn btn-warning">Pending</button>';
            } else {
                $status = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
            }

			$data[] = array(
				'',
				$emp->emp_title,
				$emp->emp_area,
				$emp->emp_level,
                $emp->emp_submitdate,
                $status,
                $function,
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

    function add_emp()
    {
        $data['title'] = 'iJEES | Add Employer Project (EP)';
        $e_details = $this->user_e_model->e_details($this->session->userdata('user_id'));
        $data['e_details'] = $e_details;
        $data['company_details'] = $this->company_model->c_details($e_details['c_id']); 

		$this->load->view('internal/templates/header',$data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/employer/employer_add_emp_view');
        $this->load->view('internal/templates/footer');  
    }

    function upload_doc($path, $file_input_name) 
    {
        if ($_FILES){
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_input_name)) 
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                The file format must be in ".PDF"</div>');
               // redirect('internal/level_2/Employer/Employer_emps/add_emp');
            } else {
                $doc_data = ($this->upload->data());
                return $doc_data;
            }   
        }
    }

    function submit_added_emp($e_id)
    {
        $emp_document = $this->upload_doc('./assets/uploads/employer_projects', 'emp_document');
        
        $data=
		[
            'e_id'=>$e_id,
            'emp_title'=>htmlspecialchars($this->input->post('emp_title')),
			'emp_area'=>htmlspecialchars($this->input->post('emp_area')),
			'emp_level'=>htmlspecialchars($this->input->post('emp_level')),
			'emp_description'=>htmlspecialchars($this->input->post('emp_description')),
			'emp_document' => $emp_document['file_name'],
            'emp_approval' => 0, // default is 0. will be send to admin for approval.
		];

        $this->employer_projects_model->insert($data);

        $this->session->set_flashdata('insert_message', 1); 
        $this->session->set_flashdata('emp_title', $this->input->post('emp_title')); 

        redirect('internal/level_2/employer/employer_emps');
    }

    function delete_emp()
    {
        $emp_details = $this->employer_projects_model->emp_details($this->input->post('emp_id'));
        unlink('./assets/uploads/employer_projects/'.$emp_details[0]->emp_document);
        $this->employer_projects_model->delete($this->input->post('emp_id'));
    }

    function edit_emp($emp_id)
    {
        
        $data['title'] = 'iJEES | Edit Employer Project';
        $e_details = $this->user_e_model->e_details($this->session->userdata('user_id'));
        $data['e_details'] = $e_details;
        $data['company_details'] = $this->company_model->c_details($e_details['c_id']);
        $data['emp_details'] = $this->employer_projects_model->emp_details($emp_id);
        // var_dump($data['emp_details']);
        // die;

		$this->load->view('internal/templates/header',$data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/employer/employer_edit_emp_view');
        $this->load->view('internal/templates/footer'); 
    }

    function submit_edit_emp($emp_id)
    {
        if($_FILES['emp_document']['name'] != "") {
            $original_details = $this->employer_projects_model->emp_details($emp_id);
            unlink('./assets/uploads/employer_projects/'.$original_details[0]->emp_document);
			$emp_document = $this->upload_doc('./assets/uploads/employer_projects', 'emp_document');
			$data = [
				'emp_document' => $emp_document['file_name'],
			];
			$this->employer_projects_model->update($data, $emp_id);
		}

        $e_details = $this->user_e_model->e_details($this->session->userdata('user_id'));
        $data=
		[
            'e_id'=>$e_details['e_id'],
            'emp_title'=>htmlspecialchars($this->input->post('emp_title')),
			'emp_area'=>htmlspecialchars($this->input->post('emp_area')),
			'emp_level'=>htmlspecialchars($this->input->post('emp_level')),
			'emp_description'=>htmlspecialchars($this->input->post('emp_description')),
		];
      
        $this->employer_projects_model->update($data, $emp_id);

        $this->session->set_flashdata('edit_message', 1); 
        $this->session->set_flashdata('emp_title', $this->input->post('emp_title')); 

        redirect('internal/level_2/employer/employer_emps');
    }

    function view_emp()
    {
        $emp_details = $this->employer_projects_model->emp_details($this->input->post('emp_id'));
        if ($emp_details[0]->emp_approval == 0) {
            $status = '<button type="button" style = "cursor: default;" class="btn btn-warning">Pending</button>';
        } else {
            $status = '<button type="button" style = "cursor: default;" class="btn btn-success">Approved</button>';
        }

        $output ='
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                    <th scope="row">Date Submitted</th>
                    <td>'.$emp_details[0]->emp_submitdate.'</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>'.$status.'</td>
                </tr>
                <tr>
                    <th scope="row">Employer Project Title</th>
                    <td>'.$emp_details[0]->emp_title.'</td>
                </tr>
                <tr>
                    <th scope="row">Field(s)</th>
                    <td>'.$emp_details[0]->emp_area.'</td>
                </tr>
                <tr>
                    <th scope="row">Level</th>
                    <td>'.$emp_details[0]->emp_level.'</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td>'.$emp_details[0]->emp_description.'</td>
                </tr>
                <tr>
                    <th scope="row">Document</th>
                    <td><a href="'.base_url("assets/uploads/employer_projects/").$emp_details[0]->emp_document.'" target="_blank">'.$emp_details[0]->emp_document.'</a></td>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

}
?>