<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Candidate extends CI_Controller
{
    public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
        $this->load->model('Candidate_Model');
        $this->load->model('Applicant_Model');
        $this->load->model('Category_Model');
        $this->load->model('Job_Model');
        $this->load->model('Email_Model');
        if (!$this->session->userdata['user_id']) {
            redirect('Welcome');
        }
    }
    public function index()
    {

        $data['userInfo'] = null;
        $this->load->view('includes/d-header.php');
        $data['jobInfo'] = $this->Candidate_Model->getalljobs();
        $this->load->view('candidates-dashboard', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function allCandidate()
    {

        $data['userInfo'] = null;
        $this->load->view('includes/d-header.php');
        $applicant = $this->Applicant_Model->getapplicantDetails();
        $this->load->view('dashboard-applicants', ['applicant' => $applicant]);
        $this->load->view('includes/d-footer.php');
    }

    public function applied_jobs()
    {

        $data['userInfo'] = null;
        $this->load->view('includes/d-header.php');
        $data['jobInfo'] = $this->Candidate_Model->applied_jobs();
        $this->load->view('applied_jobs', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function addCandidate()
    {

        $data['userInfo'] = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        $data['catInfo'] = $this->Job_Model->getjobcategory();
        $data['cityInfo'] = [];
        $data['countryInfo'] = [];
        $empty_data = 0;
        $all_fields = 32;
        foreach ($data['userInfo'] as $key => $value) {
            if ($value != '' && $value != NULL) {
                $empty_data = $empty_data + 1;
            }
        }
        $profile_completnes = round($empty_data / $all_fields * 100);
        $data['profile_completnes'] = $profile_completnes;
        $data['enable_button'] = "personal";
        $data['job_category'] = $this->Category_Model->getcategories();
        $this->load->view('includes/d-header.php');
        $this->load->view('candidates-profile', $data);
        $this->load->view('includes/d-footer.php');
    }
    public function addInfoVisa()
    {

        $data['userInfo'] = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        $empty_data = 0;
        $all_fields = 32;
        foreach ($data['userInfo'] as $key => $value) {
            if ($value != '' && $value != NULL) {
                $empty_data = $empty_data + 1;
            }
        }
        $profile_completnes = round($empty_data / $all_fields * 100);
        $data['profile_completnes'] = $profile_completnes;

        $data['enable_button'] = "visa";
        $this->load->view('includes/d-header.php');
        $this->load->view('candidates_profile_visa_info', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function addInfoEmergency()
    {

        $data['userInfo'] = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        // print_r($data['userInfo']);exit;
        $empty_data = 0;
        $all_fields = 32;
        foreach ($data['userInfo'] as $key => $value) {
            if ($value != '' && $value != NULL) {
                $empty_data = $empty_data + 1;
            }
        }
        $profile_completnes = round($empty_data / $all_fields * 100);
        $data['profile_completnes'] = $profile_completnes;
        $data['enable_button'] = "emergency";
        $this->load->view('includes/d-header.php');
        $this->load->view('candidates_profile_emergency_info', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function addInfoBadge()
    {

        $data['userInfo'] = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        $data['enable_button'] = "badge";
        $empty_data = 0;
        $all_fields = 32;
        foreach ($data['userInfo'] as $key => $value) {
            if ($value != '' && $value != NULL) {
                $empty_data = $empty_data + 1;
            }
        }
        $profile_completnes = round($empty_data / $all_fields * 100);
        $data['profile_completnes'] = $profile_completnes;
        $this->load->view('includes/d-header.php');
        $this->load->view('candidates_profile_badge_info', $data);
        $this->load->view('includes/d-footer.php');
    }

    // basic info
    public function addingCandidateBasic()
    {
        $category = $this->input->post('category');
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $gender = $this->input->post('gender');
        $birth_date = $this->input->post('birth_date');
        $address = $this->input->post('address');
        $town = $this->input->post('town');
        $country = $this->input->post('country');
        $post_code = $this->input->post('post_code');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $birth_city = $this->input->post('birth_city');
        $nationality = $this->input->post('nationality');
        $insurance_no = $this->input->post('insurance_no');

        $employee_lat = $this->input->post('employee_lat');
        $employee_long = $this->input->post('employee_long');
        $new_image_name4 = '';

        $config['upload_path']          = './employee_images/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|PDF|DOCX|docx|mp4|mp3|rtf|jpeg|JPEG|JPG|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        $imageResult = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        // profile pic
        if (!empty($_FILES['file11']["name"])) {
            if (! $this->upload->do_upload('file11')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with Profile Pic. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name11 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name11 = $imageResult->profile_pic;
        }

        // resume file 
        if (!empty($_FILES['file_resume']["name"])) {
            if (! $this->upload->do_upload('file_resume')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with resume file. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_resume = $data['upload_data']['file_name'];
            }
        } else {
            $file_resume = $imageResult->file_resume;
        }

        // portfolio video
        if (!empty($_FILES['file_portfolio_video']["name"])) {
            if (! $this->upload->do_upload('file_portfolio_video')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with portfolio video. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_portfolio_video = $data['upload_data']['file_name'];
            }
        } else {
            $file_portfolio_video = $imageResult->file_portfolio_video;
        }

        $data = array(
            'user_id' => $this->session->userdata['user_id'],
            'category_id' => $category,
            'profile_pic' => $new_image_name11,
            'first_name' => $f_name,
            'last_name' => $l_name,
            'birth_date' => $birth_date,
            'gender' => $gender,
            'address' => $address,
            'town' => $town,
            'country' => $country,
            'email' => $email,
            'phone' => $phone,
            'birth_city' => $birth_city,
            'nationality' => $nationality,
            'insurance_no' => $insurance_no,
            'post_code' => $post_code,
            'file_resume' => $file_resume,
            'file_portfolio_video' => $file_portfolio_video,
            'employee_lat' => $employee_lat,
            'employee_long' => $employee_long,
        );

        $result = $this->Candidate_Model->add_Candidate($data);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Personal Info updated successfully.');
            return redirect('Candidate/addCandidate');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addCandidate');
        }
    }




    public function clearFlashError()
    {
        $this->session->unset_userdata('error');
        echo json_encode(['status' => 'success']);
    }

    // visa information

    public function addingCandidateVisaInfo()
    {

        $utr_number = $this->input->post('utr_number');
        $visa = $this->input->post('visa');
        $licence = $this->input->post('licence');

        $config['upload_path']          = './employee_images/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|PDF|DOCX|docx|mp4|mp3|rtf|jpeg|JPEG|JPG|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        if (!empty($_FILES['file1']["name"])) {
            if (! $this->upload->do_upload('file1')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with passport pic. Please try again with valid format.');
                redirect('Candidate/addInfoVisa');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name1 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name1 = $imageResult->passport_pic;
        }
        // utility pic
        if (!empty($_FILES['file2']["name"])) {
            if (! $this->upload->do_upload('file2')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with utility bill pic. Please try again with valid format.');
                redirect('Candidate/addInfoVisa');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name2 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name2 = $imageResult->utilitybill_pic;
        }
        // resident pic
        if (!empty($_FILES['file3']["name"])) {
            if (! $this->upload->do_upload('file3')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with resident pic. Please try again with valid format.');
                redirect('Candidate/addInfoVisa');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name3 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name3 = $imageResult->resident_pic;
        }

        $data = array(
            'user_id' => $this->session->userdata['user_id'],
            'utr_number' => $utr_number,
            'visa_required' => $visa,
            'uk_driving_licence' => $licence,
            'passport_pic' => $new_image_name1,
            'utilitybill_pic' => $new_image_name2,
            'resident_pic' => $new_image_name3,
        );

        $result = $this->Candidate_Model->add_Candidate($data);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Visa Info updated successfully.');
            return redirect('Candidate/addInfoVisa');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addInfoVisa');
        }
    }

    // emergency info
    public function addingCandidateEmergencyInfo()
    {
        $e_name = $this->input->post('e_name');
        $e_relation = $this->input->post('e_relation');
        $e_phone = $this->input->post('e_phone');

        $data = array(
            'user_id' => $this->session->userdata['user_id'],
            'e_contact_name' => $e_name,
            'e_contact_relation' => $e_relation,
            'e_contact_phone' => $e_phone,
        );

        $result = $this->Candidate_Model->add_Candidate($data);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Emergency Info updated successfully.');
            return redirect('Candidate/addInfoEmergency');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addInfoEmergency');
        }
    }


    public function addingCandidateBadgeInfo()
    {
        $badge_type = $this->input->post('badge_type');
        $badge_number = $this->input->post('badge_number');
        $expiry_date = $this->input->post('expiry_date');
        $sort_code = $this->input->post('sort_code');
        $account_number = $this->input->post('account_number');
        $account_name = $this->input->post('account_name');
        $birth_date = $this->input->post('birth_date');
        $expiry_date = $this->input->post('expiry_date');

        $config['upload_path']          = './employee_images/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|PDF|DOCX|docx|mp4|mp3|rtf|jpeg|JPEG|JPG|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        // badge pic
        if (!empty($_FILES['file4']["name"])) {
            if (! $this->upload->do_upload('file4')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with badge pic. Please try again with valid format.');
                redirect('Candidate/addInfoBadge');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name4 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name4 = $imageResult->badge_pic;
        }

        $data = array(
            'user_id' => $this->session->userdata['user_id'],
            'badge_number' => $badge_number,
            'badge_type' => $badge_type,
            'bank_sort_code' => $sort_code,
            'account_number' => $account_number,
            'badge_pic' => $new_image_name4,
            'birth_date' => $birth_date,
            'badge_expiry' => date('Y-m-d', strtotime($expiry_date)),
        );

        $result = $this->Candidate_Model->add_Candidate($data);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Badge Info updated successfully.');
            return redirect('Candidate/addInfoBadge');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addInfoBadge');
        }
    }

    public function updateCandidateBasicInfo()
    {
        $category = $this->input->post('category');
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $gender = $this->input->post('gender');
        $birth_date = $this->input->post('birth_date');
        $address = $this->input->post('address');
        $town = $this->input->post('town');
        $country = $this->input->post('country');
        $post_code = $this->input->post('post_code');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $birth_city = $this->input->post('birth_city');
        $nationality = $this->input->post('nationality');
        $insurance_no = $this->input->post('insurance_no');

        $employee_lat = $this->input->post('employee_lat');
        $employee_long = $this->input->post('employee_long');

        $new_image_name4 = '';


        $config['upload_path']          = './employee_images/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|PDF|DOCX|docx|mp4|mp3|rtf|jpeg|JPEG|JPG|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        $imageResult = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        // profile pic
        if (!empty($_FILES['file11']["name"])) {
            if (! $this->upload->do_upload('file11')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with profile pic. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name11 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name11 = $imageResult->profile_pic;
        }


        if (!empty($_FILES['file_resume']["name"])) {
            if (! $this->upload->do_upload('file_resume')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with resume file. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_resume = $data['upload_data']['file_name'];
            }
        } else {
            $file_resume = $imageResult->file_resume;
        }

        if (!empty($_FILES['file_portfolio_video']["name"])) {
            if (! $this->upload->do_upload('file_portfolio_video')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with portfolio video. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_portfolio_video = $data['upload_data']['file_name'];
            }
        } else {
            $file_portfolio_video = $imageResult->file_portfolio_video;
        }
        $data = array(
            'category_id' => $category,
            'profile_pic' => $new_image_name11,
            'first_name' => $f_name,
            'last_name' => $l_name,
            'birth_date' => $birth_date,
            'gender' => $gender,
            'address' => $address,
            'town' => $town,
            'country' => $country,
            'post_code' => $post_code,
            'email' => $email,
            'phone' => $phone,
            'birth_city' => $birth_city,
            'nationality' => $nationality,
            'insurance_no' => $insurance_no,
            'file_resume' => $file_resume,
            'employee_lat' => $employee_lat,
            'employee_long' => $employee_long,
            'file_portfolio_video' => $file_portfolio_video
        );

        $result = $this->Candidate_Model->update_Candidate($data);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Personal Info updated successfully.');
            return redirect('Candidate/addCandidate');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addCandidate');
        }
    }

    public function updateCandidateVisaInfo()
    {
        $utr_number = $this->input->post('utr_number');
        $visa = $this->input->post('visa');
        $licence = $this->input->post('licence');

        $config['upload_path']          = './employee_images/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|PDF|DOCX|docx|mp4|mp3|rtf|jpeg|JPEG|JPG|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        $imageResult = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        // passport pic
        if (!empty($_FILES['file1']["name"])) {
            if (! $this->upload->do_upload('file1')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with passport pic. Please try again with valid format.');
                redirect('Candidate/addInfoVisa');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name1 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name1 = $imageResult->passport_pic;
        }
        // utility pic
        if (!empty($_FILES['file2']["name"])) {
            if (! $this->upload->do_upload('file2')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with utility bill pic. Please try again with valid format.');
                redirect('Candidate/addInfoVisa');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name2 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name2 = $imageResult->utilitybill_pic;
        }
        // resident pic
        if (!empty($_FILES['file3']["name"])) {
            if (! $this->upload->do_upload('file3')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with resident pic. Please try again with valid format.');
                redirect('Candidate/addInfoVisa');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name3 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name3 = $imageResult->resident_pic;
        }

        $data = array(
            'utr_number' => $utr_number,
            'visa_required' => $visa,
            'uk_driving_licence' => $licence,
            'passport_pic' => $new_image_name1,
            'utilitybill_pic' => $new_image_name2,
            'resident_pic' => $new_image_name3,
        );
        $result = $this->Candidate_Model->update_Candidate($data);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }

            $this->session->set_flashdata('success', 'Visa Info updated successfully.');
            return redirect('Candidate/addInfoVisa');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addInfoVisa');
        }
    }

    public function updateCandidateEmergencyInfo()
    {
        $e_name = $this->input->post('e_name');
        $e_relation = $this->input->post('e_relation');
        $e_phone = $this->input->post('e_phone');
        $data = array(
            'e_contact_name' => $e_name,
            'e_contact_relation' => $e_relation,
            'e_contact_phone' => $e_phone,
        );
        $result = $this->Candidate_Model->update_Candidate($data);
        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Emergency Info updated successfully.');
            return redirect('Candidate/addInfoEmergency');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addInfoEmergency');
        }
    }

    public function updateCandidateBadgeInfo()
    {
        $badge_type = $this->input->post('badge_type');
        $badge_number = $this->input->post('badge_number');
        $expiry_date = $this->input->post('expiry_date');
        $sort_code = $this->input->post('sort_code');
        $account_number = $this->input->post('account_number');
        $account_name = $this->input->post('account_name');
        $birth_date = $this->input->post('birth_date');
        $expiry_date = $this->input->post('expiry_date');

        $config['upload_path']          = './employee_images/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|PDF|DOCX|docx|mp4|mp3|rtf|jpeg|JPEG|JPG|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        $imageResult = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        // badge pic
        if (!empty($_FILES['file4']["name"])) {
            if (! $this->upload->do_upload('file4')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with badge pic. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name4 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name4 = $imageResult->badge_pic;
        }

        $data = array(
            'badge_type' => $badge_type,
            'badge_number' => $badge_number,
            'bank_sort_code' => $sort_code,
            'badge_pic' => $new_image_name4,
            'birth_date' => $birth_date,
            'badge_expiry' => date('Y-m-d', strtotime($expiry_date)),
        );

        $result = $this->Candidate_Model->update_Candidate($data);
        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Badge Info updated successfully.');
            return redirect('Candidate/addInfoBadge');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addInfoBadge');
        }
    }

    public function editCandidate()
    {

        $cat_id = $this->input->post('Candidate_id');
        $name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
        $userInfo = array('name' => $name);
        $result = $this->Candidate_Model->edit_Candidate($userInfo, $cat_id);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Candidate Updated successfully.');
            return redirect('Candidate');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate');
        }
    }

    public function getCandidatedetail($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $data['userInfo'] = $this->Candidate_Model->getCandidate($decrypted_id);

        $this->load->view('includes/header.php');
        $this->load->view('includes/left_menu.php');
        $this->load->view('add_Candidate', $data);
        $this->load->view('includes/footer.php');
    }

    public function deleteCandidate($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $result = $this->Candidate_Model->deletecity($decrypted_id);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Candidate Deleted successfully.');
            return redirect('Candidate');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Candidate');
        }
    }
    public function fetch_city()
    {
        $region_id = $_REQUEST['region'];
        if (!empty($region_id)) {
            echo $this->Candidate_Model->fetch_city($region_id);
        }
    }

    public function fetch_county()
    {
        echo $this->Candidate_Model->fetch_country();
    }

    public function create_employ_user()
    {
        $data['categories'] = $this->Category_Model->getcategories();
        $this->load->view('includes/d-header.php');
        $this->load->view('create_user_employ.php', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function StoreCandidateAdmin()
    {
        $category = $this->input->post('category');
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $gender = $this->input->post('gender');
        $birth_date = $this->input->post('birth_date');
        $address = $this->input->post('address');
        $town = $this->input->post('town');
        $country = $this->input->post('country');
        $post_code = $this->input->post('post_code');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $birth_city = $this->input->post('birth_city');
        $nationality = $this->input->post('nationality');
        $insurance_no = $this->input->post('insurance_no');

        $employee_lat = $this->input->post('employee_lat');
        $employee_long = $this->input->post('employee_long');
        $new_image_name4 = '';

        $config['upload_path']          = './employee_images/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|PDF|DOCX|docx|mp4|mp3|rtf|jpeg|JPEG|JPG|PNG';
        $config['max_size']             = 10000;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;

        $this->load->library('upload', $config);

        $imageResult = $this->Candidate_Model->getUserInfo($this->session->userdata['user_id']);
        // profile pic
        if (!empty($_FILES['file11']["name"])) {
            if (! $this->upload->do_upload('file11')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with Profile Pic. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $new_image_name11 = $data['upload_data']['file_name'];
            }
        } else {
            $new_image_name11 = $imageResult->profile_pic;
        }

        // resume file 
        if (!empty($_FILES['file_resume']["name"])) {
            if (! $this->upload->do_upload('file_resume')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with resume file. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_resume = $data['upload_data']['file_name'];
            }
        } else {
            $file_resume = $imageResult->file_resume;
        }

        // portfolio video
        if (!empty($_FILES['file_portfolio_video']["name"])) {
            if (! $this->upload->do_upload('file_portfolio_video')) {
                $file_error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $file_error . 'Something went wrong with portfolio video. Please try again with valid format.');
                redirect('Candidate/addCandidate');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_portfolio_video = $data['upload_data']['file_name'];
            }
        } else {
            $file_portfolio_video = $imageResult->file_portfolio_video;
        }

        $user_data = [
            'user_name' => $this->input->post('user_name'),
            'user_email' => $this->input->post('user_email'),
            'user_role' => 2,
            'password' => password_hash($this->input->post('user_password'), PASSWORD_BCRYPT),
            'verified_at' => date('Y-m-d'), 
        ];
    
            $userId = $this->User_Model->addNewUser($user_data);

        $data = array(
            'user_id' => $userId,
            'category_id' => $category,
            'profile_pic' => $new_image_name11,
            'first_name' => $f_name,
            'last_name' => $l_name,
            'birth_date' => $birth_date,
            'gender' => $gender,
            'address' => $address,
            'town' => $town,
            'country' => $country,
            'email' => $email,
            'phone' => $phone,
            'birth_city' => $birth_city,
            'nationality' => $nationality,
            'insurance_no' => $insurance_no,
            'post_code' => $post_code,
            'file_resume' => $file_resume,
            'file_portfolio_video' => $file_portfolio_video,
            'employee_lat' => $employee_lat,
            'employee_long' => $employee_long,
        );


        $result = $this->Candidate_Model->add_Candidate($data,$userId);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }

                if ($email->fcm_token != NULL) {
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Employee Updated his Profile', 'An Employee Complete his Profile Please Approve It.');
                }
            }
            $this->session->set_flashdata('success', 'Personal Info updated successfully.');
            return redirect('Candidate/addCandidate');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Candidate/addCandidate');
        }
    }
}
