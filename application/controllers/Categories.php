<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Categories extends CI_Controller
{
    public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
        $this->load->model('Category_Model');
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }
    }

    public function index(){
        // categories-list
        $data = array();
        $data['categories'] = $this->Category_Model->getcategories();
        $this->load->view('includes/d-header.php');
        $this->load->view('categories-list', $data);
        $this->load->view('includes/d-footer.php');
    }
    public function add_category(){
        // categories-list
        $data = array();
        $data['categories'] = $this->Category_Model->getcategories();
        $this->load->view('includes/d-header.php');
        $this->load->view('add-category', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function  addcategory(){
        $name = $this->input->post('category_name');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
      
       $result = $this->Category_Model->add_category($name, $title, $description);

       if ($result == true) {
          
           $this->session->set_flashdata('success', 'Category added Successfully.');
           return redirect('Categories');
       } else {
           $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
           redirect('Categories/add_category');

       }
        
    }
    public function  getcategory($uid){
       $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $data['userInfo'] = $this->Category_Model->getcategory($decrypted_id);
        
        $this->load->view('includes/d-header.php');
        $this->load->view('edit-category', $data);
        $this->load->view('includes/d-footer.php');

    }
    public function updatecategory()
    {

        $name = $this->input->post('category_name');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $id = $this->input->post('id');
        $result = $this->Category_Model->update_category($name, $id, $title, $description);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Category Updated Successfully.');
            return redirect('Categories');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Categories');

        }

    }
    public function deletecategory($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $result = $this->Category_Model->deletecategory($decrypted_id);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Deleted successfully.');
            return redirect('Categories');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Categories');

        }

    }
}

?>