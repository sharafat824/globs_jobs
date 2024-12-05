<?php
//echo('hello');exit();
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Company extends CI_Controller
{
    public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Company_Model');
        $this->load->model('User/User_Model');
        $this->load->model('Candidate_Model');
        $this->load->model('Email_Model');
       
         $this->load->library('pagination');
        $this->config->load('config');
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }
    }
    public function index()
    {

        $data['userInfo'] = null;
        $this->load->view('includes/d-header.php');

        $this->load->view('company-dashboard', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function allcompany()
    {
    
        // Pagination configuration
        $config['base_url'] = base_url('Company/allcompany'); // Base URL
        $config['total_rows'] = $this->Company_Model->countApplicantDetails(); // Total rows count
        $per_page = $this->config->item('per_page'); 
        $config['use_page_numbers'] = true;
        $config['uri_segment'] = 3; // This segment will contain the page number
        $this->pagination->initialize($config);
    
        // Get current page
        $page = ($this->uri->segment(3)) ? (int)$this->uri->segment(3) : 1;
    
        // Calculate offset based on page
        $offset = ($page - 1) * $per_page;
 
    
        // Get company details with pagination
        $company = $this->Company_Model->getcompanyDetails($per_page, $offset);
    
        // Debugging the result set
        // echo "<pre>"; print_r($company); echo "</pre>";
    
        // Pass the data to the view, including pagination
        $this->load->view('includes/d-header.php');
        $this->load->view('all_company', [
            'company' => $company,
            'pagination_links' => $this->load->view('pagination_bootstrap', [
                'base_url' => base_url('Company/allcompany'),
                'total_pages' => ceil($config['total_rows'] / $per_page),
                'current_page' => $page,
            ], true)
        ]);
        $this->load->view('includes/d-footer.php');
    }
    
    public function jobs() {

        $companyId = $this->input->get('id');

        // Get jobs for the specific company using the provided ID
       $jobs =$this->Company_Model->getCompanyJobs($companyId);
    
      var_dump(json_encode($jobs));
      die('sss');   
    }
    
    

    public function getcompanydetail($uid)
    {
        // $uid = str_replace(array('_'), array('/'), $uid);
        // $decrypted_id = $this->encrypt->decode($uid);
        $data['userInfo'] = $this->Company_Model->getcompanydetail($uid);

        $this->load->view('includes/d-header.php');
        $this->load->view('view_company', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function addcompany()
    {

        $data['userInfo'] = $this->Company_Model->getcompanyDetailRow();
        $data['cityInfo'] = $this->Company_Model->getcity();
        $data['countryInfo'] = $this->Company_Model->getcountry();
        $this->load->view('includes/d-header.php');
        $this->load->view('company-profile', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function CreateCompanyAdmin()  {
        $this->load->view('includes/d-header.php');
        $this->load->view('create_company');
        $this->load->view('includes/d-footer.php');
    }

    public function StoreUserAndCompany()  {

        // Set validation rules for company data
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('registration_number', 'Registration Number', 'required');
        $this->form_validation->set_rules('email', 'Company Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('website', 'Website', 'required|valid_url');
        $this->form_validation->set_rules('team_size', 'Team Size', 'required');
        $this->form_validation->set_rules('about_company', 'About Company', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('file11', 'File', 'callback_file_check');         
   
       // Set validation rules for user data
       $this->form_validation->set_rules('user_name', 'User Name', 'required|min_length[3]');
       $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|callback_check_email');
       $this->form_validation->set_rules('user_password', 'Password', 'required|min_length[6]');
   
       // Check if validation passes
       if ($this->form_validation->run() == FALSE) {
           // Validation failed, load the view with errors
           $data['errors'] = validation_errors();
           $this->load->view('includes/d-header.php');
           $this->load->view('create_company',$data);
           $this->load->view('includes/d-footer.php');           
           return;
       }
   
       $user_data = [
        'user_name' => $this->input->post('user_name'),
        'user_email' => $this->input->post('user_email'),
        'user_role' => 3,
        'password' => password_hash($this->input->post('user_password'), PASSWORD_BCRYPT),
        'verified_at' => date('Y-m-d'), // Set the current timestamp for verification
    ];
       // Create User and check if successful
       $userId = $this->User_Model->addNewUser($user_data);
       if ($userId) {
               $new_image_name11 = '';
               if (!empty($_FILES['file11']["name"])) {
                   $temp_name2 = $_FILES['file11']["tmp_name"];
                   $new_image_name11 = uniqid() . str_replace(' ', '', $_FILES['file11']["name"]);
                   // Define your upload location
                   $location = './employee_images/'; // Adjust this path as necessary
                   $target_file2 = $location . $new_image_name11;
                   move_uploaded_file($temp_name2, $target_file2); // Move the uploaded file to target locationdddddd
               }
       
        $company_data = [
            'name' => $this->input->post('company_name'),
            'registration_number' => $this->input->post('registration_number'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'website' => $this->input->post('website'),
            'about' => $this->input->post('about_company'),
            'country' => $this->input->post('country'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address'),
            'company_logo' => $new_image_name11,
            'company_lat' => (float)$this->input->post('latitude'), 
            'company_long' => (float)$this->input->post('longitude'),
            'user_id' => $userId
        ];

        // Add Company
        if ($this->Company_Model->add_company(...array_values($company_data))) {
            redirect('Company/allcompany'); // Redirect on success
        } else {
            // Handle error when creating company...
        }
   }
}
   
   // Callback function for email validation
   public function check_email($email) {
       if ($this->User_Model->email_exists($email)) {
           $this->form_validation->set_message('check_email', 'The {field} field must contain a unique value.');
           return FALSE;
       } else {
           return TRUE;
       }
   }
    function editCompanyAdmin($uid)
    {
        // $uid = str_replace(array('_'), array('/'), $uid);
        // $decrypted_id = $this->encrypt->decode($uid);
        $data['userInfo'] = $this->Company_Model->getcompanydetail($uid);

        $this->load->view('includes/d-header.php');
        $this->load->view('edit_company', $data);
        $this->load->view('includes/d-footer.php');
    }

    function UpdateCompanyAdmin()  {

        $name = $this->input->post('company_name');
        $registration_number = $this->input->post('registration_number');
        $email = $this->input->post('email');
        $companyId = $this->input->post('company_id');
        $phone = $this->input->post('phone');
        $website = $this->input->post('website');
        $about = $this->input->post('about');
        $country = $this->input->post('country');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $company_lat = $this->input->post('company_lat');
        $company_long = $this->input->post('company_long');
        $location = 'employee_images/';
        $width = '';
        $height = '';
        $quality = 50;
        $imageResult = $this->Company_Model->getcompanyDetailRow();

        if (empty($country)) {
           $country =  $this->input->post('previous_country');
        }
        if (empty($city)) {
           $city =  $this->input->post('previous_city');
        }
      
        if (!empty($_FILES['file11']["name"])) {
            $temp_name2 = $_FILES['file11']["tmp_name"];
            $new_image_name11 = uniqid() . str_replace(' ', '', $_FILES['file11']["name"]);
            $target_file2 = $location . $new_image_name11;
            $this->Company_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
        } else {
            $new_image_name11 = $imageResult->company_logo;
        }

        $result = $this->Company_Model->update_company($name, $registration_number, $email, $phone, $website, $about, $country, $city, $address, $new_image_name11, $company_lat, $company_long,true,$companyId);

        if ($result == true) {    
            $this->session->set_flashdata('success', 'Company Profile Updated Successfully.');
            return redirect('Company/allCompany');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Company/editCompanyAdmin');
        }
        
    }

    public function file_check($str) {
        if (empty($_FILES['file11']['name'])) {
            return TRUE; // File is not required; allow empty uploads if not set as required.
        }
    
        // Get the file extension
        $file_extension = pathinfo($_FILES['file11']['name'], PATHINFO_EXTENSION);
        
        // Allowed extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
    
        if (!in_array(strtolower($file_extension), $allowed_extensions)) {
            // Set an error message for invalid file type
            $this->form_validation->set_message('file_check', "The {field} field must be a JPG or PNG image.");
            return FALSE; // Validation failed
        }
    
        return TRUE; // Validation passed
    }

    public function updatecompany()
    {

        $name = $this->input->post('name');
        $registration_number = $this->input->post('registration_number');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $website = $this->input->post('website');
        $about = $this->input->post('about');
        $country = $this->input->post('country');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $company_lat = $this->input->post('company_lat');
        $company_long = $this->input->post('company_long');
        $location = 'employee_images/';
        $width = '';
        $height = '';
        $quality = 50;
        $imageResult = $this->Company_Model->getcompanyDetailRow();
        if (!empty($_FILES['file11']["name"])) {
            $temp_name2 = $_FILES['file11']["tmp_name"];
            $new_image_name11 = uniqid() . str_replace(' ', '', $_FILES['file11']["name"]);
            $target_file2 = $location . $new_image_name11;
            $this->Company_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
        } else {
            $new_image_name11 = $imageResult->company_logo;
        }

        $result = $this->Company_Model->update_company($name, $registration_number, $email, $phone, $website, $about, $country, $city, $address, $new_image_name11, $company_lat, $company_long);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Company Profile Updated', 'An Company Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Company Profile Updated', 'An Company Complete his Profile Please Approve It.');
                }
            }

            $this->session->set_flashdata('success', 'Company Profile Updated Successfully.');
            return redirect('Company/addcompany');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Company/addcompany');
        }
    }
    public function addingcompany()
    {

        $name = $this->input->post('name');
        $registration_number = $this->input->post('registration_number');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $website = $this->input->post('website');
        $about = $this->input->post('about');
        $country = $this->input->post('country');
        $city = $this->input->post('city');
        $address = $this->input->post('address');
        $company_lat = $this->input->post('company_lat');
        $company_long = $this->input->post('company_long');

        $location = 'employee_images/';
        $width = '';
        $height = '';
        $quality = 50;
        $imageResult = $this->Company_Model->getcompanyDetailRow();
        if (!empty($_FILES['file11']["name"])) {
            $temp_name2 = $_FILES['file11']["tmp_name"];
            $new_image_name11 = uniqid() . str_replace(' ', '', $_FILES['file11']["name"]);
            $target_file2 = $location . $new_image_name11;
            $this->Company_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
        } else {
            $new_image_name11 = $imageResult->company_logo;
        }

        $result = $this->Company_Model->add_company($name, $registration_number, $email, $phone, $website, $about, $country, $city, $address, $new_image_name11, $company_lat, $company_long);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Company Profile Updated', 'An Company Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Company Profile Updated', 'An Company Complete his Profile Please Approve It.');
                }
            }

            $this->session->set_flashdata('success', 'Company Profile Updated Successfully.');
            return redirect('Company/addcompany');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Company/addcompany');
        }
    }

    public function deletecompany($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $result = $this->Company_Model->deletecity($decrypted_id);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Deleted successfully.');
            return redirect('Company/allcompany');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Company/allcompany');
        }
    }
    public function approvedcompany($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $status = 1;
        $userInfo = array('status' => $status);
        $result = $this->Company_Model->approve($decrypted_id, $userInfo);
        if ($result == true) {
            $email_id = $this->Candidate_Model->getuseremail3($decrypted_id);
            foreach ($email_id as $email) {
                //echo $email->user_email;exit();
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Profile Approved', 'Company Profile Approved.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Profile Approved', 'Company Profile Approved.');
                }
            }
            $this->session->set_flashdata('success', 'Approved successfully.');
            return redirect('Company/allcompany');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Company/allcompany');
        }
    }
    public function rejectcompany($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $status = 2;
        $userInfo = array('status' => $status);
        $result = $this->Company_Model->approve($decrypted_id, $userInfo);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Reject successfully.');
            return redirect('Company/allcompany');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Company/allcompany');
        }
    }
    function fetch_city($region_id)
    {
        $this->db->where('region_id', $region_id);
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get('city');
        $output = '<option value="">Select Town/City</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->city_name . '</option>';
        }
        return $output;
    }
}
