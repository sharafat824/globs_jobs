<?php
error_reporting(5);
defined('BASEPATH') OR exit('No direct script access allowed');
//if(!isset($_SESSION)){session_start();}
Class Manage_login extends CI_Controller {

    public function index(){
        if($this->input->get('email') && $this->input->get('verification_code')){
            $this->load->model('Manage_Login_Model');
            $email = $this->input->get('email');
            $verification_code = $this->input->get('verification_code');
            $result = $this->Manage_Login_Model->verifyEmail($email, $verification_code );
            if($result){
                $this->session->set_flashdata('success', 'Email Verified Successfully');
                redirect('Welcome');
            }else{
                $this->session->set_flashdata('error', 'Verification Link Expired');
                redirect('Welcome');
            }
        }
    
        $page = $this->input->get('page', TRUE);
        $data['page'] = $page;
        $this->load->view('includes/header.php');
        $this->load->view('login', $data);   
        $this->load->view('includes/footer.php');  
	}

    // start login function
	
    public function login(){

        
     $captcha_response = trim($this->input->post('g-recaptcha-response'));

		// if($captcha_response = '')
		// {
            $secretKey ='6LefTjslAAAAAJnlk8AvMZbyiWV-fgr3K64ulVIB';
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urlencode($secretKey).'&response='.urlencode($captcha_response);
            $response = file_get_contents($url);
            $responseKeys = json_decode($response, true);
            // if($responseKeys["success"]) {
                $emailid=$this->input->post('emailid');
                $password=$this->input->post('password');
                $this->load->model('Manage_Login_Model');
                $this->load->model('Manage_Dashboard_Model');
                    $result_password=$this->Manage_Login_Model->loginaccess($emailid);
                    $hased_password = $result_password->password;
                    $success_password = password_verify($password,$hased_password);
                    if($success_password){
                        $check_password=$hased_password;
                    }
                    else{
                        $check_password="";
                    }
                $result=$this->Manage_Login_Model->login($emailid,$check_password);
                if($result>0)
                {

                    if($result->user_role == 3){
                        $user_profile = $this->Manage_Login_Model->get_user_profile($result->id);
                        $this->session->set_userdata('user_logo',$user_profile->company_logo);        
                    }
                    
                    $this->session->set_userdata('user_id',$result->id);        
                    $this->session->set_userdata('rolecode',$result->user_role);
                    if($result->user_role == 2){
                        $categoryID = $this->Manage_Dashboard_Model->getCategory($result->id);
                        if(!empty($categoryID)){
                            $this->session->set_userdata('category_id',$categoryID->category_id);
                        }
                    }

                  //  $commonModules=$this->Manage_Login_Model->commonModules();
                    //die('ddd');
                    $allModules=$this->Manage_Login_Model->allModules();
                    $userRights=$this->Manage_Login_Model->userRights($result->rolecode);

                    $this->session->set_userdata('email',$result->user_email);
                    $all_data = $this->set_rights($allModules, $userRights, $commonModules);
                    $this->session->set_userdata('access',$all_data);
                    $this->session->set_flashdata('success', 'Login Successfully');
                    return redirect('Manage_dashboard/Home');
                    
                
                }else{
                    
                    $this->session->set_flashdata('error', 'Invalid details. Please try again with valid details');
                    $this->session->set_flashdata('error_identifier', true);
                    redirect('Manage_login?page=2');
                }
            // }else{
            //         $this->session->set_flashdata('error', 'Invalid Recaptch. Please try again with valid details');
            //         redirect('Welcome');
            // }
		// }else{
		//     $this->session->set_flashdata('error', 'Empty Recaptch. Please Check the captcha box');
        //     redirect('Welcome');
		// }

	}

    // end function  login
	
	public function logout(){
    
			
		unset($_SESSION["access"]);
		session_destroy();
		$this->session->sess_destroy();
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('rolecode');
		$this->session->unset_userdata('email');

		return redirect('Welcome');
    }

    public function register(){
        $this->load->model('Manage_Login_Model');
        $this->load->model('Manage_Dashboard_Model');
        $this->load->model('Email_Model');
        $emailid=$this->input->post('emailid');
        $result_password=$this->Manage_Login_Model->loginaccess($emailid);
        if($result_password){
            $this->session->set_flashdata('error', 'Email already Exists. Try using a different Email');
            redirect('Welcome');
        }
        $password=$this->input->post('password');
        $confirm_password=$this->input->post('confirm_password');
        $btnradio=$this->input->post('btnradio');
        $this->load->model('Manage_Login_Model');
        $verification_code = rand();
        if($password==$confirm_password){
            $password1 = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $result=$this->Manage_Login_Model->register($emailid,$password1,$btnradio,$verification_code);
        }else{
            $this->session->set_flashdata('error', 'Password Is Not Mached');
            redirect('Welcome');     
        }

        if($result>0){
            $result_password=$this->Manage_Login_Model->loginaccess($emailid);
            $hased_password = $result_password->password;
            $success_password = password_verify($password,$hased_password);
            if($success_password){
                $check_password=$hased_password;
            }else{
                $check_password="";
            }
            $result=$this->Manage_Login_Model->login($emailid,$check_password);
            if($result>0){
                $mail = $this->Email_Model->send($result->user_email, $emailid.'Registered Successfully', 'Verification Link Has been mailed to you!! <a href="'.base_url()."Manage_login?page=2&email=".$emailid."&verification_code=".$verification_code."".'">click here</a>');
                $this->session->set_flashdata('success', 'Register Successfully. Check Your email for verification!!');
                return redirect('/');
            }else{
                $this->session->set_flashdata('error', 'Invalid details. Please try again with valid details');
                redirect('Welcome');
            }
        }else{
        
            $this->session->set_flashdata('error', 'Invalid details. Please try again with valid details');
            redirect('Welcome');

        }	
	}

public function LoginLogView()
	{   
                $this->load->model('Manage_Login_Model');
		$logdetails = $this->Manage_Login_Model->getlogdetails();
		//$distributer='';
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
		$this->load->view('view_login_log',['logDetails'=>$logdetails]);
                $this->load->view('includes/footer.php');
		
	}
    public function forgot_password()
	{   
            $this->load->view('forgot_password');
	}
    public function email_forgot_password()
	{   
            $emailid=$this->input->post('emailid');
            
            $this->load->model('Manage_Login_Model');
            $result_user = $this->Manage_Login_Model->checkUser($emailid);
            if($result_user){
                // $encrypted_id = $this->encrypt->encode($result_user->id);
                // $encrypted_id=str_replace(array('/'), array('_'), $encrypted_id);
                $apiKey = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                $data= array(
                    'passwordChangeApiKey'=>$apiKey
                );
                $update_password = $this->Manage_Login_Model->updateUser($emailid,$data);
            //EMAIL
            $encrypted_key = str_replace(array('/'), array('_'), $this->encrypt->encode($apiKey));
            $link = base_url()."Manage_login/changePassword/".$encrypted_key;
            
            if($update_password){
                $this->load->model('Email_Model');
                $mail=$this->Email_Model->send($emailid,"Password Reset","Reset Password Request Verification. <br> to change your Password Visit: <b>$link</b> ");
                if($mail){
                    $this->session->set_flashdata('success', 'Verification Email Sent');
                    redirect('Welcome');
                }
                else{
                    $this->session->set_flashdata('error', 'Email Not Sent! Please try again');
                    redirect('Welcome');
                }
            }
            }
            else{
            $this->session->set_flashdata('error', 'Incorrect Email! Email does not Exist');
            redirect('Manage_login/forgot_password');
            }
            
	}
        public function changePassword($apiKey = NULL)
	{   
            $decrypted_key = $this->encrypt->decode(str_replace(array('_'), array('/'), $apiKey));
            $this->load->model('Manage_Login_Model');
            $result = $this->Manage_Login_Model->checkApiKey($decrypted_key);
            
            if($result){
                $data['apiKey'] = $decrypted_key;
                $this->load->view('change_password',$data);
            }
            else{
            $this->session->set_flashdata('error', 'Incorrect Verification Link!');
            redirect('Welcome');
            }
            
	}
	
	   
    public function resetPassword()
	{   
            $apiKey = $this->input->post('apiKey');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            
            if($password !== $confirm_password){
                $encrypted_key = str_replace(array('/'), array('_'), $this->encrypt->encode($apiKey));
                redirect("Manage_login/changePassword/".$encrypted_key);
            }
            
            $this->load->model('Manage_Login_Model');
            $password1 = password_hash($password, PASSWORD_BCRYPT);
            
            $data= array(
                'passwordChangeApiKey'=>"",
                'password' => $password1

            );
            $result = $this->Manage_Login_Model->checkApiKey2($apiKey);
            
            $update_password = $this->Manage_Login_Model->updateUser($result->user_email,$data);
            
            if($update_password){
                    $this->session->set_flashdata('success', 'Password Changes Successfully');
                    redirect('Welcome');
            }
            else{
                $this->session->set_flashdata('error', 'Password not Changes! Please try again');
                redirect('Welcome');
            }
            
            
	}
public function set_rights($menus, $menuRights, $topmenu) {
    $data = array();

    foreach ($menus as $menu) {

        $row = array();
        foreach($menuRights as $menu_rights) {
            if ($menu_rights->rr_modulecode == $menu->mod_modulecode) {
                if ($this->authorize($menu_rights->rr_create) || $this->authorize($menu_rights->rr_edit) ||
                       $this->authorize($menu_rights->rr_delete) || $this->authorize($menu_rights->rr_view)
                ) {

                    $row["menu"] = $menu->mod_modulegroupcode;
                    $row["menu_name"] = $menu->mod_modulename;
                    $row["page_name"] = $menu->mod_modulepagename;
                    $row["create"] = $menu_rights->rr_create;
                    $row["edit"] = $menu_rights->rr_edit;
                    $row["delete"] = $menu_rights->rr_delete;
                    $row["view"] = $menu_rights->rr_view;

                    $data[$menu->mod_modulegroupcode][$menu_rights->rr_modulecode] = $row;
                    $data[$menu->mod_modulegroupcode]["top_menu_name"] = $menu->mod_modulegroupname;
                }
            }
        }
    }
    
		return $data;
	}
	
	public function authorize($module) {
		return $module == "yes" ? TRUE : FALSE;
	}

}