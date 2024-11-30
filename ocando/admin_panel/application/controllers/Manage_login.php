<?php

defined('BASEPATH') OR exit('No direct script access allowed');
Class Manage_login extends CI_Controller {


public function index(){
        
	$emailid=$this->input->post('emailid');
	$password=$this->input->post('password');
	$this->load->model('Manage_login_model');
        $result_password=$this->Manage_login_model->loginaccess($emailid);
        $hased_password = $result_password->password;
        $success_password = password_verify($password,$hased_password);
        if($success_password){
            $check_password=$hased_password;
        }
        else{
            $check_password="";
        }
        
	$result=$this->Manage_login_model->login($emailid,$check_password);
	//print_r($result);exit();
	if($result>0)
	{	
		$this->session->set_userdata('username',$result->username);	
		$this->session->set_userdata('user_id',$result->id);
        
		return redirect('Manage_dashboard');
	
	} else{
	
		$this->session->set_flashdata('error', 'Invalid details. Please try again with valid details');
		redirect('Welcome');

	}	
	}

public function logout(){

$this->session->unset_userdata('username');
$this->session->unset_userdata('user_id');
$this->session->sess_destroy();
//print_r($_SESSION);exit;
return redirect('Welcome');
}

}