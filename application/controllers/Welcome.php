<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(5);
class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
		$this->load->model('Candidate_Model');
        $this->load->model('Email_Model');  
		$this->load->model('Category_Model');
		$this->load->helper('clear_session');
        set_no_cache_headers();  
		
    }
    
    public function sendNotification()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = [
            'Authorization: key=AAAAjZwxhJY:APA91bF2hFnSm8DfdcDtmGuMAPxLt463z3uMHw5_mIY7UBuRJS557rH7rUlD3ePYj_-Giy8y-GjXoGCbFKedq8SAJIQ7z77wBus0wYzOxS5arJFvP53CZ745RCsh8O18BnK4LNt_coZb',
            'Content-Type: application/json',
        ];

        $notification = [
            'title' => "this is test",
            'body' => "this is good",
            'sound' => 'default',
        ];

        $data = [
            'to' => 'fanauGusTiuQUbn9VlvhAh:APA91bEB580n5ieWCJdYWvTCUOAhMIPFSNFqQ39uKKZGpWlrCUFgFwEItWprRLNQ-_HbRxCWweU7_dxUNftPPWc1qovmjtBnQIpLfHrz8mIa_xNWsQi5EYFZQus5F0d7DFab7irD6y8J',
            'notification' => $notification,
            'priority' => 'high',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);
        
        print_r($result);exit();
        // return $result;
    }
    
    
	public function index()
	{	
		$data['categories'] =$this->Category_Model->getcategories();
		$data['title'] = "UK Job Opportunities in Banking, Finance, IT, and more | Jobs Glob";
		$data['meta_desc'] = 'Find your ideal job on Jobs Glob, a platform for UK and global employment. Explore opportunities in Banking, Finance, Graphic Designer, Architecture, and advance your career.';
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php', $data);
		$data['jobInfo'] =$this->Candidate_Model->getallapprovedjobs();
		$this->load->view('home',$data); 
		$this->load->view('includes/footer.php');
	}
	public function contact()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		//$data['jobInfo'] =$this->Candidate_Model->getallapprovedjobs();
		$this->load->view('contact'); 
		$this->load->view('includes/footer.php');
	}
	public function about()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		//$data['jobInfo'] =$this->Candidate_Model->getallapprovedjobs();
		$this->load->view('about'); 
		$this->load->view('includes/footer.php');
	}
	public function vission()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		//$data['jobInfo'] =$this->Candidate_Model->getallapprovedjobs();
		$this->load->view('vission'); 
		$this->load->view('includes/footer.php');
	}
	public function mission()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		//$data['jobInfo'] =$this->Candidate_Model->getallapprovedjobs();
		$this->load->view('mission'); 
		$this->load->view('includes/footer.php');
	}
	public function all_jobs($id='')
    {

        $data['jobInfo'] = $this->Candidate_Model->getallapprovedjobs($id);
        $category_info = $this->Candidate_Model->get_cat_title_description($id);
		if($category_info!=NULL){
			$data['title'] = $category_info->title;
			$data['meta_desc'] = $category_info->description;
		}else{
			$data['title'] = '';
			$data['meta_desc'] = '';
		}
	
        $this->load->view('includes/home-header.php', $data);
        $this->load->view('job-listing', $data);
        $this->load->view('includes/footer.php');
    }
	
}
