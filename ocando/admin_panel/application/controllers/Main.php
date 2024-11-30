<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); // Construct CI's core so that you can use it
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }
    }
    public function index()
    {
        redirect('Manage_dashboard');
    }
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% Category MODULE START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    public function Category()
    {
        $data['details'] = $this->Common_model->getDetails('category',1);
        $this->load->view('includes/header.php');
        $this->load->view('includes/left_menu.php');
        $this->load->view('view_category',$data);
        $this->load->view('includes/footer.php');
    }
    public function addCategory()
    {
        $data['modules'] = $this->Common_model->getDetails('modules',NULL);
        $this->load->view('includes/header.php');
        $this->load->view('includes/left_menu.php');
        $this->load->view('add_category',$data);
        $this->load->view('includes/footer.php');
    }
    public function addCategoryDB()
    {
        $name = $this->input->post('name');
        $module = $this->input->post('module');
        
        $data = array(
            'name'=>$name,
            'module'=>$module
        );

        $result = $this->Common_model->addDetails($data,'category');
        if ($result == true) {
            $this->session->set_flashdata('success', 'Category Added successfully.');
            return redirect('Main/Category');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Main/Category');

        }

    }
    public function deleteCategory($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

        $result = $this->Common_model->deleteDetailsByID($decrypted_id,'category');

        if ($result == true) {
            $this->session->set_flashdata('success', 'Category Deleted successfully.');
            return redirect('Main/Category');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Main/Category');

        }

    }
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% Category MODULE END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% BusinessType MODULE START %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        public function BusinessType()
        {
            $data['details'] = $this->Common_model->getDetails('business_type',1);
            $this->load->view('includes/header.php');
            $this->load->view('includes/left_menu.php');
            $this->load->view('view_business_type',$data);
            $this->load->view('includes/footer.php');
        }
        public function addBusinessType()
        {
            $data['modules'] = $this->Common_model->getDetails('modules',NULL);
            $this->load->view('includes/header.php');
            $this->load->view('includes/left_menu.php');
            $this->load->view('add_business_type',$data);
            $this->load->view('includes/footer.php');
        }
        public function addBusinessTypeDB()
        {
            $name = $this->input->post('name');
            $module = $this->input->post('module');
            
            $data = array(
                'name'=>$name,
                'module'=>$module
            );
    
            $result = $this->Common_model->addDetails($data,'business_type');
            if ($result == true) {
                $this->session->set_flashdata('success', 'Business Type Added successfully.');
                return redirect('Main/BusinessType');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
                redirect('Main/BusinessType');
    
            }
    
        }
        public function deleteBusinessType($uid)
        {
            $uid = str_replace(array('_'), array('/'), $uid);
            $decrypted_id = $this->encrypt->decode($uid);
    
            $result = $this->Common_model->deleteDetailsByID($decrypted_id,'business_type');
    
            if ($result == true) {
                $this->session->set_flashdata('success', 'Business Type Deleted successfully.');
                return redirect('Main/BusinessType');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                redirect('Main/Business Type');
    
            }
    
        }
        //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% BusinessType MODULE END %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
}