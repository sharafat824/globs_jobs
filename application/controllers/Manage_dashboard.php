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
        $this->load->library('pagination');
        $this->load->helper('clear_session');
        set_no_cache_headers();  

    }
    public function Home()
    {   $dateRange = $this->input->get('date_range');
        $this->load->view('includes/d-header.php');
        if($this->session->userdata['rolecode']=='1'){
			
			$data['Assignedjob'] = $this->Manage_Dashboard_Model->Assignedjob($dateRange);
			$data['Shortlistjob'] = $this->Manage_Dashboard_Model->Shortlistjob(null,$dateRange);
			$data['total_job'] = $this->Manage_Dashboard_Model->totaljob($dateRange);
			$data['approved_job'] = $this->Manage_Dashboard_Model->approvedjob(null,$dateRange);
			$data['total_employee'] = $this->Manage_Dashboard_Model->totalemployee($dateRange);
			$data['pending_employee'] = $this->Manage_Dashboard_Model->pendingemployee($dateRange);
			$data['totalemployer'] = $this->Manage_Dashboard_Model->totalemployer($dateRange);
			$data['pendingemployer'] = $this->Manage_Dashboard_Model->pendingemployer($dateRange);
			$data['approvedemployer'] = $this->Manage_Dashboard_Model->approvedemployer($dateRange);
			$data['approved_employee'] = $this->Manage_Dashboard_Model->approvedemployee($dateRange);
			
			$data['jobInfo'] =$this->Candidate_Model->getalljobs();
			$this->load->view('admin-dashboard',$data);
        }
        else if($this->session->userdata['rolecode']=='2'){
			$category_type = $this->Manage_Dashboard_Model->getUserCategory();
			$data['Assignedjob'] = $this->Manage_Dashboard_Model->Assignedjob($dateRange);
			$data['Shortlistjob'] = $this->Manage_Dashboard_Model->Shortlistjob($dateRange);
			$data['appliedjob'] = $this->Manage_Dashboard_Model->appliedjob();
			$data['approved_job'] = $this->Manage_Dashboard_Model->approvedjob($category_type->category_id,$dateRange);
			$data['jobInfo'] = $this->Manage_Dashboard_Model->getapprovedjobs($category_type->category_id,$dateRange);
            $this->load->view('candidates-dashboard',$data);
        }
		else if($this->session->userdata['rolecode']=='3'){
	
            $data['total_job']    = $this->Manage_Dashboard_Model->totaljob($dateRange);
			$data['approved_job'] = $this->Manage_Dashboard_Model->approvedjob(null,$dateRange);
			$data['Assignedjob']  = $this->Manage_Dashboard_Model->Assignedjob($dateRange);
            $data['pendingjob']   = $this->Manage_Dashboard_Model->pendingjob();
			$data['Shortlistjob'] = $this->Manage_Dashboard_Model->Shortlistjob($dateRange);
			$data['jobInfo']      = $this->Candidate_Model->getalljobs();
            $this->load->view('company-dashboard',$data);
        }
           
        $this->load->view('includes/d-footer.php'); 
       
    }
	public function jobs()
    {   
        $status =$this->input->get('status');
        $country = $this->input->get('country');
        $city = $this->input->get('city');
        $search = $this->input->get('search');
        
         // Pagination configuration
         $config['base_url'] = base_url('Manage_dashboard/jobs?status=' . urlencode($status)); // Base URL with status
         $config['total_rows'] = $this->Manage_Dashboard_Model->countJob($status,$country,$city,$search); 
       
         $per_page = $this->config->item('per_page') + 2;
         $config['per_page'] = $per_page; // Set items per page
         $config['use_page_numbers'] = true;
         $config['uri_segment'] = 3; // This segment will contain the page number
         $this->pagination->initialize($config);
     
         // Get current page from the query string
         $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
     
         // Calculate offset based on page
         $offset = ($page - 1) * $per_page;
         $data['jobInfo'] = $this->Manage_Dashboard_Model->gettotaljob($per_page,$offset,$status,$country,$city,$search);
       
        
        $this->load->view('includes/d-header.php');
		$this->load->view('getTotalJob',
        [
            'jobInfo' =>$data['jobInfo'], 
            'status' => $status,
            'pagination_links' => $this->load->view('pagination_employ', [
                'base_url' => base_url('Manage_dashboard/jobs?status=' . urlencode($status)), 
                'total_pages' => ceil($config['total_rows'] / $per_page),
                'current_page' => $page,
            ], true)
        ]
    );
           
        $this->load->view('includes/d-footer.php'); 
       
    }
    public function employee()
    {  
        // Get the 'status' parameter from the URL
        $status = $this->input->get('status');
    
        // Pagination configuration
        $config['base_url'] = base_url('Manage_dashboard/employee?status=' . urlencode($status)); // Base URL with status
        $config['total_rows'] = $this->Manage_Dashboard_Model->countEmploy($status); // Total rows count
        $per_page = $this->config->item('per_page');
        $config['per_page'] = $per_page; // Set items per page
        $config['use_page_numbers'] = true;
        $config['uri_segment'] = 3; // This segment will contain the page number
        $this->pagination->initialize($config);
    
        // Get current page from the query string
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
    
        // Calculate offset based on page
        $offset = ($page - 1) * $per_page;
    
        // Fetch employee data
        $data['jobInfo'] = $this->Manage_Dashboard_Model->gettotalemployee(NULL, $status, $per_page, $offset);
        $data['status'] = $status;
    
        // Load views
        $this->load->view('includes/d-header.php');
        $this->load->view('getTotalEmployee', [
            'jobInfo' => $data['jobInfo'], 
            'status' => $data['status'],
            'pagination_links' => $this->load->view('pagination_employ', [
                'base_url' => base_url('Manage_dashboard/employee?status=' . urlencode($status)), 
                'total_pages' => ceil($config['total_rows'] / $per_page),
                'current_page' => $page,
            ], true)
        ]);
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

    public function getTotalJob()
    {   
        $this->load->view('includes/d-header.php');
		$data['jobInfo'] = $this->Manage_Dashboard_Model->gettotaljob();
		$this->load->view('getTotalJob',$data);
           
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

    public function addCreatedAtColumns() {
      //  $sql_users = "ALTER TABLE users ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP";
        $sql_employee_profile = "ALTER TABLE employee_profile ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP";
        $sql_employer_profile = "ALTER TABLE employer_profile ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP";
        $sql_user_jobs = "ALTER TABLE user_jobs ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP";
        $sql_jobs = "ALTER TABLE jobs ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP";
    
        // Execute each query
      //  $this->db->query($sql_users);
        $this->db->query($sql_jobs);
       $this->db->query($sql_employee_profile);
       $this->db->query($sql_employer_profile);
        $this->db->query($sql_user_jobs);
    }
}