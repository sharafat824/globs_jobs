<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Manage_Incomplete_Profiles extends CI_Controller
{
    public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
        $this->load->model('Applicant_Model');
        $this->load->model('Email_Model');
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }
    }
    public function index()
    {
        $data = array();
        $data['employees'] = $this->Applicant_Model->getIncompleteEmployeeProfiles();
        $data['employers'] = $this->Applicant_Model->getIncompleteEmployerProfiles();
        $this->load->view('includes/d-header.php');
        $this->load->view('incomplete_profiles', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function send_profile_email($user_email){
        $user_email = str_replace(array('_'), array('/'), $user_email);
        $decrypted_user_email = $this->encrypt->decode($user_email);
        $mail = $this->Email_Model->send($decrypted_user_email, 'InComplete Profile', 'Kindly Complete your profile before your profile gets freezed.');
        $this->session->set_flashdata('success', 'Email sent successfully.');
        return redirect('Manage_Incomplete_Profiles/index');
    }
}