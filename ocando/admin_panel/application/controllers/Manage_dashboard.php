<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }

    }

    public function index()
    {

        $this->load->view('includes/header.php');
        $this->load->view('includes/left_menu.php');
        $this->load->view('dashboard');
        $this->load->view('includes/footer.php');

    }

}
