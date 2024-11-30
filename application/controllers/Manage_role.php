<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(5);
class Manage_role extends CI_Controller {
 public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
        $this->load->model('Manage_Role_Model');
                
        if(!$this->session->userdata['user_id'])
        {
                redirect('Welcome');
        }
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$role=$this->Manage_Role_Model->getroledetails();
		//$distributer='';
		$this->load->view('includes/d-header.php');
		$this->load->view('manage_role',['roledetails'=>$role]);
		$this->load->view('includes/d-footer.php');
		
	}
	
	public function addrole($uid=NULL)
	{
             
            if($uid == null)
            {
                $data['userInfo'] = NULL;
                $this->load->view('getroledetail',$data);
            }
            else{
                $data['userInfo'] = $this->Manage_Role_Model->getroledetail($uid);
                $this->load->view('getroledetail',$data);
            }
                
	}
        
        public function addRoleRight($uid=NULL)
	{
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('add_role_right');
                $this->load->view('includes/footer.php');
        }
        public function updateRights(){
		
		$module=$this->input->post('module');
                
		$data = array(
                    'mod_modulegroupcode' =>'ADMIN',
                    'mod_modulegroupname' =>'Admin',
                    'mod_modulecode' =>$module,
                    'mod_modulename' =>$module,
                    'mod_modulegrouporder' =>'1',
                    'mod_moduleorder' =>'1',
                    'mod_modulepagename' =>$module.'.php',
                    'mod_add' =>'0',
                    'mod_edit' =>'0',
                    'mod_view' =>'0',
                    'mod_delete' =>'0'
		);
//                print_r($data);exit;
		$result=$this->Manage_Role_Model->add_RoleRight($data);
		if($result==true)
		{
		$this->session->set_flashdata('success','Role Right Added successfull.');
		return redirect('manage_role');
		}else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
		redirect('manage_role');
		

		}
        
    }
	
	public function updaterole(){
		
		$role_rolecode=$this->input->post('role_rolecode');
		$role_rolename=$this->input->post('role_rolename');
		$description=$this->input->post('description');
		
		$result=$this->Manage_Role_Model->add_role($role_rolecode,$role_rolename,$description);
		//print_r($result);exit();
		if($result==true)
		{
		$this->session->set_flashdata('success','Role Added successfull.');
		return redirect('manage_role');
		}else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
		redirect('manage_role');
		

		}
        
    }
	
	
	
	public function getcategorydetail($uid)
		{
		$data['userInfo'] = $this->Manage_Role_Model->getroledetail($uid);
		$this->load->view('getroledetail',$data);
		}
		
	
	public function deletecategory($uid)
		{
		$result=$this->Manage_Role_Model->deletecategory($uid);
		if($result==true)
		{
		$this->session->set_flashdata('success','Role Deleted successfull.');
		return redirect('manage_role');
		}else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
		redirect('manage_role');
		

		}
		
		}
        public function editRoleRights($rolecode)
	{       
                
		$data['roleInfo']=$this->Manage_Role_Model->getModuleDetails();
                $data['rolecode']= $rolecode;
                
                $this->load->view('includes/d-header.php');
                $this->load->view('role_right',$data);
                $this->load->view('includes/d-footer.php');
		
		
	}
        public function saveRights()
	{       
                
                $role_rolecode=$this->input->post('rolecode');
                $result=$this->Manage_Role_Model->deleteRoleRights($role_rolecode);
                
                foreach ($this->input->post('mod_modulecode') as $assign_app_num => $assign_app) :
                
                $add_is = 'no';$update_is = 'no';$view_is = 'no';$delete_is = 'no';
                
                if($this->input->post('add')[$assign_app_num]!=''){
                    $add_is = 'yes';
                }
                if($this->input->post('edit')[$assign_app_num]!=''){
                    $update_is = 'yes';
                }
                if($this->input->post('view')[$assign_app_num]!=''){
                    $view_is = 'yes';
                }
                if($this->input->post('delete')[$assign_app_num]!=''){
                    $delete_is = 'yes';
                }
                
//                echo $role_rolecode; echo $assign_app; echo $add_is; echo $update_is; echo $delete_is; echo $view_is;echo "</br>";
                $result1=$this->Manage_Role_Model->add_right($role_rolecode,$assign_app,$add_is,$update_is,$delete_is,$view_is);
                
                endforeach;
                
		$this->session->set_flashdata('success','Role Rights Updated successfully.');
		return redirect('manage_role');
		
		
		
	}
	
}
