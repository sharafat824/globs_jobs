<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Manage_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }
		$this->load->model('Candidate_Model');
        $this->load->model('Manage_Dashboard_Model');
		$this->load->model('Applicant_Model');
		
    }
    public function Home()
    {   
        $this->load->view('includes/d-header.php');
        if($this->session->userdata['rolecode']=='1'){
			
			$data['Assignedjob'] = $this->Manage_Dashboard_Model->Assignedjob();
			$data['Shortlistjob'] = $this->Manage_Dashboard_Model->Shortlistjob();
			$data['total_job'] = $this->Manage_Dashboard_Model->totaljob();
			$data['approved_job'] = $this->Manage_Dashboard_Model->approvedjob();
			$data['total_employee'] = $this->Manage_Dashboard_Model->totalemployee();
			$data['totalemployer'] = $this->Manage_Dashboard_Model->totalemployer();
			$data['approved_employee'] = $this->Manage_Dashboard_Model->approvedemployee();
			
			$data['jobInfo'] =$this->Candidate_Model->getalljobs();
			$this->load->view('admin-dashboard',$data);
        }
        else if($this->session->userdata['rolecode']=='2'){
			$category_type = $this->Manage_Dashboard_Model->getUserCategory();
			$data['Assignedjob'] = $this->Manage_Dashboard_Model->Assignedjob($category_type->category_id);
			$data['Shortlistjob'] = $this->Manage_Dashboard_Model->Shortlistjob($category_type->category_id);
			$data['appliedjob'] = $this->Manage_Dashboard_Model->appliedjob();
			$data['approved_job'] = $this->Manage_Dashboard_Model->approvedjob($category_type->category_id);
			$data['jobInfo'] = $this->Manage_Dashboard_Model->getapprovedjobs($category_type->category_id);
            $this->load->view('candidates-dashboard',$data);
        }
		else if($this->session->userdata['rolecode']=='3'){
			
			
	
            $data['total_job']    = $this->Manage_Dashboard_Model->totaljob();
			$data['approved_job'] = $this->Manage_Dashboard_Model->approvedjob();
			$data['Assignedjob']  = $this->Manage_Dashboard_Model->Assignedjob();
            $data['pendingjob']   = $this->Manage_Dashboard_Model->pendingjob();
			$data['Shortlistjob'] = $this->Manage_Dashboard_Model->Shortlistjob();
			$data['jobInfo']      = $this->Candidate_Model->getalljobs();
            $this->load->view('company-dashboard',$data);
        }
           
        $this->load->view('includes/d-footer.php'); 
       
    }
	public function getTotalJob()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->gettotaljob();
		$this->load->view('getTotalJob',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getTotalEmployee()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->gettotalemployee(NULL);
		$this->load->view('getTotalEmployee',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getApprovedEmployee()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->gettotalemployee(1);
		
		$this->load->view('getApprovedEmployee',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getShortListedEmployee()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->getshortlistedemployee();
		$this->load->view('getShortListedEmployee',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getAssignedEmployee($j_id = "")
    {  
       
        $jid = str_replace(array('_'), array('/'), $j_id);
        $job_id = $this->encrypt->decode($jid);
       
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->getassignedemployee($job_id);
	
		$this->load->view('getAssignedEmployee',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getApprovedJobs()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->getapprovedjobs();
		$this->load->view('getApprovedJob',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getPendingJobs()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->getpendingjobs();
		$this->load->view('getPendingJob',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getAvailableJobs()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->getapprovedjobs();
        
		$this->load->view('getAvailableJob',$data);
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getShortListedJobs()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->getShortlistjob();
		$this->load->view('getShortListedJob',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function getAssignedJobs()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->getAssignedjob();
		$this->load->view('getAssignedJob',$data);
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    
    
}