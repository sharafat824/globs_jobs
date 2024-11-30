<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(5);
class Manage_applicant extends CI_Controller {
 public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
        $this->load->model('Applicant_Model');
		$this->load->model('Candidate_Model');
		$this->load->model('Email_Model');
        if(!$this->session->userdata['user_id'])
        {
                redirect('Welcome');
        }
    }
	public function index()
	{
		
		
	        	$applicant=$this->Applicant_Model->getapplicantDetails();
            
                $this->load->view('includes/d-header.php');
                $this->load->view('dashboard-applicants',['applicant'=>$applicant]);
                $this->load->view('includes/d-footer.php'); 
	}
		public function assignedjobs()
	{
		
		
	        	$applicant = $this->Applicant_Model->getassignedJob();
	        	// count($applicant);
           
                $this->load->view('includes/d-header.php');
                $this->load->view('dashboard_assignjobapplicants',['applicant'=>$applicant]);
                $this->load->view('includes/d-footer.php'); 
	}
	
	public function getapllicant($uid)
		{       
		  
                $uid=str_replace(array('_'), array('/'), $uid);
                $decrypted_id = $this->encrypt->decode($uid);
			
		        $data['userInfo'] = $this->Applicant_Model->getapplicant($decrypted_id);
                
                $this->load->view('includes/d-header.php');
                $this->load->view('view_applicant',$data);
                $this->load->view('includes/d-footer.php'); 
                
		}
		
	
	public function deleteapplicant($uid)
		{
                $uid=str_replace(array('_'), array('/'), $uid);
                $decrypted_id = $this->encrypt->decode($uid);
		$result=$this->Applicant_Model->deletejob($decrypted_id);
		if($result==true)
		{
		$this->session->set_flashdata('success','Candidate has been removed from job successfully.');
		return redirect('Manage_applicant');
		}else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
		redirect('Manage_applicant');
		

		}
		
		}
	public function approvedapplicant($uid)
		{
                $uid=str_replace(array('_'), array('/'), $uid);
                $decrypted_id = $this->encrypt->decode($uid);
				$status=1;
				$userInfo = array('status'=> $status);
		$result=$this->Applicant_Model->approve($decrypted_id,$userInfo);
		if($result==true)
		{
			$email_id = $this->Candidate_Model->getuseremail2($decrypted_id);
			foreach ($email_id as $email) {
				
				//echo $email->user_email;exit();
				if($email->user_email!=NULL){
					$mail = $this->Email_Model->send($email->user_email, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
					$notification = $this->Email_Model->sendNotification($email->fcm_token, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
				}

				if($email->fcm_token!=NULL){
					$notification = $this->Email_Model->sendNotification($email->fcm_token, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
				}
			}
		$this->session->set_flashdata('success','Approved successfully.');
		return redirect('Manage_applicant');
		}else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
		redirect('Manage_applicant');
		

		}
		
		}
		public function approveSingleApplicant($uid)
		{
                $uidNew=str_replace(array('_'), array('/'), $uid);
                $decrypted_id = $this->encrypt->decode($uidNew);
				$status=1;
				$userInfo = array('status'=> $status);
				$result=$this->Applicant_Model->approve($decrypted_id,$userInfo);
				if($result==true)
				{
					$email_id = $this->Candidate_Model->getuseremail2($decrypted_id);
					foreach ($email_id as $email) {
						//echo $email->user_email;exit();
						if($email->user_email!=NULL){
							$mail = $this->Email_Model->send($email->user_email, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
						}
					}
				$this->session->set_flashdata('success','Approved successfully.');
				return redirect('Manage_applicant/getapllicant/'.$uid);
				}else {
					$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
				redirect('Manage_applicant/getapllicant/'.$uid);
		

		}
		
		}
	public function rejectapplicant($uid)
		{
                $uid=str_replace(array('_'), array('/'), $uid);
                $decrypted_id = $this->encrypt->decode($uid);
				$status=2;
				$userInfo = array('status'=> $status);
		$result=$this->Applicant_Model->approve($decrypted_id,$userInfo);
		if($result==true)
		{
		$this->session->set_flashdata('success','Approved successfully.');
		return redirect('Manage_applicant');
		}else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
		redirect('Manage_applicant');
		

		}
		
		}
	
}
