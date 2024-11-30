<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(5);
class Blog extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
		$this->load->model('');
        
		
    }
	public function index($link=NULL)
	{	
		// echo $link;exit;
		if($link == 1){
			$data['image'] = base_url()."assets/images/author.jpg";
			$data['author'] = "Lily Watson";
			$data['title'] = "Points To Be Considered Before Accepting A New Job Offer!";
			$data['blog_image'] = base_url()."assets/images/blog-details.jpg";
			$data['date'] = "26th February";
		}
		elseif($link == 2){
			$data['image'] = base_url()."assets/images/applicants/applicants-2.jpg";
			$data['author'] = "Camelia Renesa";
			$data['title'] = "JobsGlob Will Help You To Hire In Month By Following Tips";
			$data['blog_image'] = base_url()."assets/images/blog/blog-1.jpg";
			$data['date'] = "24th February";
		}
		elseif($link == 3){
			$data['image'] = base_url()."assets/images/applicants/applicants-4.jpg";
			$data['author'] = "Jennifer Rose";
			$data['title'] = "Whatever You Do, Make Sure It Will Make You Happy";
			$data['blog_image'] = base_url()."assets/images/blog/blog-2.jpg";
			$data['date'] = "25th February";
		}
		elseif($link == 4){
			$data['image'] = base_url()."assets/images/applicants/applicants-7.jpg";
			$data['author'] = "Jaffar Ghazali";
			$data['title'] = "How To Perform Well In A Group Discussion?";
			$data['blog_image'] = base_url()."assets/images/blog/blog-4.jpg";
			$data['date'] = "27th February";
		}
		elseif($link == 5){
			$data['image'] = base_url()."assets/images/applicants/applicants-3.jpg";
			$data['author'] = "James Luther";
			$data['title'] = "3 Common Hiring Mistakes & How To Avoid Them";
			$data['blog_image'] = base_url()."assets/images/blog/blog-5.jpg";
			$data['date'] = "25th February";
		}
		elseif($link == 6){
			$data['image'] = base_url()."assets/images/applicants/applicants-5.jpg";
			$data['author'] = "Thomas Shelby";
			$data['title'] = "General Working Rules For An Ideal Employer";
			$data['blog_image'] = base_url()."assets/images/blog/blog-6.jpg";
			$data['date'] = "21th February";
		}
		elseif($link == 7){
			$data['image'] = base_url()."assets/images/applicants/applicants-6.jpg";
			$data['author'] = "Alfred Henry";
			$data['title'] = "Important Things To Look For In A Great Resume";
			$data['blog_image'] = base_url()."assets/images/blog/blog-7.jpg";
			$data['date'] = "20th February";
		}
		elseif($link == 8){
			$data['image'] = base_url()."assets/images/applicants/applicants-1.jpg";
			$data['author'] = "Bob Austin";
			$data['title'] = "Work Hard, Have Fun, And Make Your History";
			$data['blog_image'] = base_url()."assets/images/blog/blog-8.jpg";
			$data['date'] = "11th February";
		}
		
		

		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		$this->load->view('blog',$data); 
		$this->load->view('includes/footer.php');
	}
	
}
