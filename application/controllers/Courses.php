<?php
//echo('hello');exit();
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Courses extends CI_Controller
{
    public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
    }

    public function cargoCourseView(){
        $this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		$this->load->view('cargo_course'); 
		$this->load->view('includes/footer.php');
    }

    // 

    public function cleaningCourseView(){
        $this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		$this->load->view('cleaning_course'); 
		$this->load->view('includes/footer.php');
    }

    // 

    public function securityCourseView(){
        $this->load->helper('html');
		$this->load->helper('url');
		$this->load->view('includes/home-header.php');
		$this->load->view('security_course'); 
		$this->load->view('includes/footer.php');
    }
}