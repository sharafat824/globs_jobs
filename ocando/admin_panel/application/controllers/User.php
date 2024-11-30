<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User/User_model');
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }
    }
    public function index()
    {
        //model
        $data['userInfo'] = $this->User_model->getusersdetails();
        //view
        $this->load->view('includes/header.php');
        $this->load->view('includes/left_menu.php');
        $this->load->view('User/view_user', $data);
        $this->load->view('includes/footer.php');
    }
    public function changePassword($userId)
    {
        $userId = str_replace(array('_'), array('/'), $userId);
        $decrypted_id = $this->encrypt->decode($userId);
        //model
        $data['userInfo'] = $this->User_model->getuserdetail($decrypted_id);
        //view
        $this->load->view('includes/header.php');
        $this->load->view('includes/left_menu.php');
        $this->load->view('User/change_user_password', $data);
        $this->load->view('includes/footer.php');
    }
    public function editPassword()
    {
        //New Pawword Check
        if ($this->input->post('new_password') != $this->input->post('confirm_password')) {
            $this->session->set_flashdata('error', "New Password Doesn't Match with the Confirm Password");
            redirect('User');
        }
        //Old Password Check
        $userId = $this->input->post('u_userid');
        $hased_password = $result_password->password;
        $success_password = password_verify($previous_password, $hased_password);
        $password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
        $userInfo = array('password' => $password, 'update_date' => date('Y-m-d H:i:s'));
        $result = $this->User_model->editUser($userInfo, $userId);

        if ($result == true) {
            $this->session->set_flashdata('success', 'Password Changed successfully');
        } else {
            $this->session->set_flashdata('error', 'Password updation failed');
        }
        redirect('User');

    }
    public function deleteuser($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $this->User_model->deleteuser($decrypted_id);
        $this->session->set_flashdata('success', 'User data deleted');
        redirect('User');
    }

    public function addNew($userId = null)
    {
        $userId = str_replace(array('_'), array('/'), $userId);
        $decrypted_id = $this->encrypt->decode($userId);
        if ($userId == null) {
            $data['userInfo'] = null;
            $this->load->view('includes/header.php');
            $this->load->view('includes/left_menu.php');
            $this->load->view('User/add_user', $data);
            $this->load->view('includes/footer.php');
        } else {

            $data['userInfo'] = $this->User_model->getuserdetail($decrypted_id);
            $this->load->view('includes/header.php');
            $this->load->view('includes/left_menu.php');
            $this->load->view('User/add_user', $data);
            $this->load->view('includes/footer.php');
        }

    }
    public function addNewUser()
    {
        $username = ucwords(strtolower($this->security->xss_clean($this->input->post('username'))));
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

        
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        //EMAIL AND USERNAME CHECK
        $result_user = $this->User_model->checkUser($username);
        if (!empty($result_user->id)) {
            $this->session->set_flashdata('error', 'Username Already Exists');
            redirect('User');
        }

        $userInfo = array('username' => $username, 'password' => $password, 'created_date' => date('Y-m-d'));

        $this->load->model('User_model');
        $result = $this->User_model->addNewUser($userInfo);

        if ($result > 0) {
            $this->session->set_flashdata('success', 'New User created successfully');
        } else {
            $this->session->set_flashdata('error', 'User creation failed');
        }

        redirect('User');

    }
    public function editUser()
    {
        $userId = $this->input->post('u_userid');
        
        $username = $this->security->xss_clean($this->input->post('username'));
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        $userInfo = array();
        $userInfo = array('username' => $username);

        $result = $this->User_model->editUser($userInfo, $userId);

        if ($result == true) {
            $this->session->set_flashdata('success', 'User updated successfully');
        } else {
            $this->session->set_flashdata('error', 'User updation failed');
        }

        redirect('User');

    }
}