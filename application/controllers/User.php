<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
function __construct(){
    parent::__construct();
    $this->load->model('User/User_Model');
    if(!$this->session->userdata['user_id'])
    {
            redirect('Welcome');
    }
}
	public function index()
	{
            //model
            $data['userInfo'] = $this->User_Model->getusersdetails();
            //view
            $this->load->view('includes/d-header.php');
            $this->load->view('User/view_user',$data);
            $this->load->view('includes/d-footer.php');
	}
        public function changePassword($userId)
	{
            $userId=str_replace(array('_'), array('/'), $userId);
            $decrypted_id = $this->encrypt->decode($userId);
            //model
                $data['userInfo'] = $this->User_Model->getuserdetail($decrypted_id);
            //view    
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('User/change_user_password',$data);
                $this->load->view('includes/footer.php');
	}
        public function editPassword()
    {           
                //New Pawword Check
                if($this->input->post('new_password')!=$this->input->post('confirm_password')){
                    $this->session->set_flashdata('error', "New Password Doesn't Match with the Confirm Password");
                    redirect('User');
                }
                //Old Password Check
                $userId = $this->input->post('u_userid');
                $previous_password = $this->input->post('previous_password');
                $result_password=$this->User_Model->loginaccess($userId);
                $hased_password = $result_password->password;
                $success_password = password_verify($previous_password,$hased_password);
                if($success_password){
                    
                    $password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
                    $userInfo = array('password'=> $password,'update_date'=>date('Y-m-d H:i:s'));
                    $result = $this->User_Model->editUser($userInfo, $userId);

                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Password Changed successfully');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Password updation failed');
                    }
                    redirect('User');
                    
                }
                else{
                    $this->session->set_flashdata('error', "Wrong Old Password Entered");
                    redirect('User');
                }
    }
        public function deleteuser($uid)
        {
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $this->User_Model->deleteuser($decrypted_id);
        $this->session->set_flashdata('success', 'User data deleted');
        redirect('User');
        }
        
        public function addNew($userId = NULL)
        {    
            $userId=str_replace(array('_'), array('/'), $userId);
            $decrypted_id = $this->encrypt->decode($userId);
            if($userId == null)
            {
                $data['userInfo'] = NULL;
                $this->load->view('includes/d-header.php');
                $this->load->view('User/add_user',$data);
                $this->load->view('includes/d-footer.php');
            }
            else{
                
                $data['userInfo'] = $this->User_Model->getuserdetail($decrypted_id); 
                $this->load->view('includes/d-header.php');
                $this->load->view('User/add_user',$data);
                $this->load->view('includes/d-footer.php');
            }
                
        }
        public function addNewUser()
        {
                $user_name = ucwords(strtolower($this->security->xss_clean($this->input->post('user_name'))));
                $user_email = ucwords(strtolower($this->security->xss_clean($this->input->post('user_email'))));
                $password = password_hash($this->input->post('user_password'), PASSWORD_BCRYPT);
               
                $username = filter_var($user_name, FILTER_SANITIZE_STRING);
                $email = filter_var($user_email, FILTER_SANITIZE_STRING);
                $password = filter_var($password, FILTER_SANITIZE_STRING);
                //EMAIL AND USERNAME CHECK
                $result_email = $this->User_Model->checkEmail($email);
                if(!empty($result_email->id))
                {
                    $this->session->set_flashdata('error', 'Email Already Exists');
                    redirect('User');
                }
                
                $userInfo = array('user_name'=>$username,'user_email'=>$email,'password'=>$password, 'user_role'=>1,'verified_at' => date('Y-m-d'),'rolecode'=>'ADMIN');
                
                $this->load->model('User_Model');
                $result = $this->User_Model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('User');
        
    }
    public function editUser()
    {           
                
                //IMAGE
                if(!empty($_FILES["userfile"]["name"])){
                $new_image_name = uniqid().time().rand().'.'.pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);
                $config['upload_path'] = 'user_image/'; 
                $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                $config['file_name'] = $new_image_name;
                $config['max_size']  = '0';
                $config['max_width']  = '0';
                $config['max_height']  = '0';
                $config['$min_width'] = '0';
                $config['min_height'] = '0';
                $this->load->library('upload', $config);
                $upload = $this->upload->do_upload('userfile');
                //IMAGE END
                }
                $userId = $this->input->post('u_userid');
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
//                $username = ucwords(strtolower($this->security->xss_clean($this->input->post('username'))));
//                $email = strtolower($this->security->xss_clean($this->input->post('email')));
//                $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $city_id = $this->input->post('city');
                $region_id = $this->input->post('region');
                $role = $this->input->post('role');
                
                $name = filter_var($name, FILTER_SANITIZE_STRING);
                $username = filter_var($username, FILTER_SANITIZE_STRING);
                $email = filter_var($email, FILTER_SANITIZE_STRING);
                
                $userInfo = array();
                if(!empty($_FILES["userfile"]["name"])){
                $userInfo = array('user_image'=>$new_image_name,'full_name'=> $name,'update_date'=>date('Y-m-d H:i:s'),'city_id'=>$city_id,'region_id'=>$region_id,'rolecode'=>$role);
                }
                else{
                $userInfo = array('full_name'=> $name,'update_date'=>date('Y-m-d H:i:s'),'city_id'=>$city_id,'region_id'=>$region_id,'rolecode'=>$role);
                }
                $result = $this->User_Model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('User');
            
        
    }
    //Fetch Area from City
    public function fetch_city()
    {
       $region_id =  $_REQUEST['region'];
        if(!empty($region_id))
        {
         echo $this->User_Model->fetch_city($region_id);
        }
    }
}
