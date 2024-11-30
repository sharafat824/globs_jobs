<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Job extends CI_Controller
{
    public function __construct()
    {
        // $this->load does not exist until after you call this b
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
        $this->load->model('Job_Model');
        $this->load->model('Candidate_Model');
        $this->load->model('Email_Model');
        $this->load->model('Company_Model');
        $this->load->model('Manage_Dashboard_Model');
        // Check if the user is not logged in and the current method is not 'job_details'
        if (!$this->session->userdata['user_id'] && $this->router->fetch_method() !== 'job_details') {
            redirect('Welcome');
        }
    }
    public function index()
    {

        $data['userInfo'] = null;
        $data['jobInfo'] = $this->Job_Model->getalljobs();
        $this->load->view('includes/d-header.php');
        $this->load->view('job-listing', $data);
        $this->load->view('includes/d-footer.php');
    }
    public function add_job()
    {

        $data['userInfo'] = null;
        $data['countryInfo'] = $this->Candidate_Model->getcountry();
        $data['catInfo'] = $this->Job_Model->getjobcategory();
        $data['cityInfo'] = $this->Company_Model->getcity();
        $this->load->view('includes/d-header.php');
        $this->load->view('post-job', $data);
        $this->load->view('includes/d-footer.php');
    }
    public function all_jobs()
    {

        $data['userInfo'] = null;
        $data['jobInfo'] = $this->Candidate_Model->getallapprovedjobs();
        $this->load->view('includes/header.php');
        $this->load->view('job-listing', $data);
        $this->load->view('includes/footer.php');
    }
    public function approved_jobs($company_id='')
    {

        $data['userInfo'] = null;
        if($company_id==''){
            $data['jobInfo'] = $this->Job_Model->getapprovedjobs();
        }else{
            $data['jobInfo'] = $this->Job_Model->getapprovedjobs($company_id);
        }
        $this->load->view('includes/d-header.php');
        $this->load->view('approved_jobs', $data);
        $this->load->view('includes/d-footer.php');
    }
    public function pending_jobs()
    {

        $data['userInfo'] = null;
        $data['jobInfo'] =$this->Candidate_Model->getalljobs();
        $this->load->view('includes/d-header.php');
        $this->load->view('pending_job', $data);
        $this->load->view('includes/d-footer.php');
    }
    public function job_details($uid)
    {
        if (!$this->session->userdata['user_id']) {
            redirect('Manage_login?page=2');
        }
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $data['jobInfo'] = $this->Job_Model->getjobs($decrypted_id);
        $this->load->view('includes/d-header.php');
        $this->load->view('job-details', $data);
        $this->load->view('includes/d-footer.php');
    }

    // delete job by admin
    public function delete_job($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $data['jobInfo'] = $this->Job_Model->deleteJob($decrypted_id);
        $this->session->set_flashdata('error', 'Job has been deleted successfully');
        redirect('Job/approved_jobs');
    }

    public function applicant_details($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

        $data['jobInfo'] = $this->Job_Model->getapplicantDetails($decrypted_id);
        $this->load->view('includes/d-header.php');
        $this->load->view('applicant_shortlist', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function all_shortlist($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

        $data['jobInfo'] = $this->Job_Model->shortlist($decrypted_id);
        $this->load->view('includes/d-header.php');
        $this->load->view('applicant_shortlist', $data);
        $this->load->view('includes/d-footer.php');
    }

    public function approvedjob($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $approve = 1;
        $userInfo = array('approve' => $approve);
        $result = $this->Job_Model->approve($decrypted_id, $userInfo);
        if ($result == true) {
            //echo $decrypted_id;exit();
            $job_data = $this->Job_Model->getJobDetails($decrypted_id);
            $user_data = $this->Job_Model->getVerifiedEmployees($job_data->category);
            foreach($user_data as $user_row){
                $total_distance = $this->get_distance($job_data->job_lat, $job_data->job_long,$user_row->employee_lat, $user_row->employee_long);
                if($total_distance<15){
                    $mail = $this->Email_Model->send($user_row->user_email, 'Job Near You', 'Another Job Just Near you just opened.');
                }

                if($user_row->fcm_token!=NULL){
					$notification = $this->Email_Model->sendNotification($user_row->fcm_token,  'Job Near You', 'Another Job Just Near you just opened.');
				}

            }
                    
            $email_id = $this->Candidate_Model->getuseremail_approve($decrypted_id);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Job Approved', 'A Job has been Approved.');
                    
                }

                if($email->fcm_token!=NULL){
					$notification = $this->Email_Model->sendNotification($email->fcm_token,  'Job Approved', 'A Job has been Approved.');
				}
            }
            $this->session->set_flashdata('success', 'Approved successfully.');
            redirect('Job/pending_jobs');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Job/pending_jobs');

        }

    }

    public function update_job()
    {

        $title = $this->input->post('title');
        $apply_date = $this->input->post('apply-date');
        $description = $this->input->post('description');
        $category = $this->input->post('category');
        $career = $this->input->post('career');
        $positions = $this->input->post('positions');
        $country = $this->input->post('country');
        $city = $this->input->post('city');
        $experience = $this->input->post('experience');
        $address = $this->input->post('address');
        $type = $this->input->post('type');
        $job_lat = $this->input->post('job_lat');
        $job_long = $this->input->post('job_long');
        $job_price = $this->input->post('job_price');


        $result = $this->Job_Model->add_Job($title, $description, $category, $career, $positions, $country, $experience, $address,$apply_date, $type,$city, $job_lat, $job_long, $job_price);

        if ($result == true) {
            $rolecode = 1;
            $email_id = $this->Candidate_Model->getuseremail($rolecode);
            foreach ($email_id as $email) {
                //echo $email->user_email."233"."<br/>";
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Job Approval', 'A job has been posted and waiting for approval.');
                }

                if($email->fcm_token!=NULL){
					$notification = $this->Email_Model->sendNotification($email->fcm_token,  'Job Approval', 'A job has been posted and waiting for approval.');
				}
            }
            $company_id = $this->session->userdata['user_id'];
            $email_id = $this->Candidate_Model->getuseremail_id($company_id);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $mail = $this->Email_Model->send($email->user_email, 'Job Posted', 'A Job has been Posted Successfully.');
                }

                if($email->fcm_token!=NULL){
					$notification = $this->Email_Model->sendNotification($email->fcm_token,  'Job Posted', 'A Job has been Posted Successfully.');
				}
            }
            $this->session->set_flashdata('success', 'Job Added successfully.');
            return redirect('Manage_dashboard/getTotalJob');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Manage_dashboard/getTotalJob');

        }

    }

    public function editJob()
    {

        $cat_id = $this->input->post('Job_id');
        $name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
        $userInfo = array('name' => $name);
        $result = $this->Job_Model->edit_Job($userInfo, $cat_id);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Job Updated successfully.');
            return redirect('Job');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
            redirect('Job');

        }

    }
    public function apply_job($uid)
    {

        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        //$userInfo = array('name'=> $name);
        $result1 = $this->Job_Model->getApplyjobDetails($decrypted_id);
        if ($result1) {
            $this->session->set_flashdata('error', 'Already Applied.');
            redirect('Manage_dashboard/Home');
        } else {
            $result = $this->Job_Model->apply_job($decrypted_id);
            if ($result == true) {
                $rolecode = 1;
                $email_id = $this->Candidate_Model->getuseremail($rolecode);
                foreach ($email_id as $email) {
                    //echo $email->user_email."233"."<br/>";
                    if ($email->user_email != null) {
                        $mail = $this->Email_Model->send($email->user_email, 'Job Apply', $this->session->userdata['email'].' Candidate has applied for this job.');
                    }

                    if($email->fcm_token!=NULL){
                        $notification = $this->Email_Model->sendNotification($email->fcm_token,  'Job Apply', $this->session->userdata['email'].' Candidate has applied for this job.');
                    }
                }
                
                $email_id = $this->Candidate_Model->getuseremail_id($this->session->userdata['user_id']);
                foreach ($email_id as $email) {
                    if ($email->user_email != null) {
                        $job_detail = $this->Job_Model->getJobDetails($decrypted_id);
                        $mail = $this->Email_Model->send($email->user_email, 'Job Apply', 'You have applied for Job '.$job_detail->title.' You  will be notified on shortlisting.');
                        
                        if($email->fcm_token!=NULL){
                            $notification = $this->Email_Model->sendNotification($email->fcm_token,   'Job Apply', 'You have applied for Job '.$job_detail->title.' You  will be notified on shortlisting.');
                        }
                    }
                    
                }
                $this->session->set_flashdata('success', 'Apply Job successfully.');
                return redirect('Manage_dashboard/Home');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
                redirect('Manage_dashboard/Home');

            }
        }

    }

    public function getJobdetail($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $data['userInfo'] = $this->Job_Model->getJob($decrypted_id);

        $this->load->view('includes/header.php');
        $this->load->view('includes/left_menu.php');
        $this->load->view('add_Job', $data);
        $this->load->view('includes/footer.php');

    }

    public function deleteJob($uid)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
        $result = $this->Job_Model->deletecity($decrypted_id);
        if ($result == true) {
            $this->session->set_flashdata('success', 'Job Deleted successfully.');
            return redirect('Job');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Job');

        }

    }
    public function shortlistapplicant($uid, $uid1)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

        $uid1 = str_replace(array('_'), array('/'), $uid1);
        $decrypted_id1 = $this->encrypt->decode($uid1);

        $short_list = 1;
        $userInfo = array('short_list' => $short_list);

        $result = $this->Job_Model->approveapllicant($decrypted_id, $decrypted_id1, $userInfo);
        if ($result == true) {
            $email_id = $this->Candidate_Model->getuseremail_id($decrypted_id);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $job_detail = $this->Job_Model->getJobDetails($decrypted_id1);
                    $mail = $this->Email_Model->send($email->user_email, 'Shortlisted', 'Congratulations!! You have been shortlisted for the job of '.$job_detail->title.'.');
                    
                    if($email->fcm_token!=NULL){
                        $notification = $this->Email_Model->sendNotification($email->fcm_token,   'Shortlisted', 'Congratulations!! You have been shortlisted for the job of '.$job_detail->title.'.');
                    }
                
                }

                
            }
            
            $this->session->set_flashdata('success', 'Approved successfully.');
            return redirect('Job/approved_jobs');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Job/approved_jobs');

        }

    }

    public function assignapplicant($uid, $uid1)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

        $uid1 = str_replace(array('_'), array('/'), $uid1);
        $decrypted_id1 = $this->encrypt->decode($uid1);

        $short_list = 11;
        $userInfo = array('short_list' => $short_list);

        $result = $this->Job_Model->approveapllicant($decrypted_id, $decrypted_id1, $userInfo);
        if ($result == true) {
            $email_id = $this->Candidate_Model->getuseremail_id($decrypted_id);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $job_detail = $this->Job_Model->getJobDetails($decrypted_id1);
                    $mail = $this->Email_Model->send($email->user_email, 'Assigned Job', 'Congratulations!! You have been assign for the job of '.$job_detail->title.'.');
                }

                if($email->fcm_token!=NULL){
                    $notification = $this->Email_Model->sendNotification($email->fcm_token,   'Assigned Job', 'Congratulations!! You have been assign for the job of '.$job_detail->title.'.');
                }
            }
            $email_id = $this->Candidate_Model->getuseremail_approve($decrypted_id1);
            foreach ($email_id as $email) {
                if ($email->user_email != null) {
                    $job_detail = $this->Job_Model->getJobDetails($decrypted_id1);
                    $mail = $this->Email_Model->send($email->user_email, 'Assigned Job', 'Congratulations!! An Candidate has been assign for the job of '.$job_detail->title.'.');
                
                    if($email->fcm_token!=NULL){
                        $notification = $this->Email_Model->sendNotification($email->fcm_token,   'Assigned Job', 'Congratulations!! An Candidate has been assign for the job of '.$job_detail->title.'.');
                    }
                }
            }
            $this->session->set_flashdata('success', 'Assign successfully.');
            return redirect('Job/approved_jobs');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Job/approved_jobs');

        }

    }

    public function rejectapplicant($uid, $uid1)
    {
        $uid = str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

        $uid1 = str_replace(array('_'), array('/'), $uid1);
        $decrypted_id1 = $this->encrypt->decode($uid1);

        $short_list = 2;
        $userInfo = array('short_list' => $short_list);
        $result = $this->Job_Model->approveapllicant($decrypted_id, $decrypted_id1, $userInfo);
        if ($result == true) {
            $this->session->set_flashdata('success', 'successfully.');
            return redirect('Job/approved_jobs');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            redirect('Job/approved_jobs');

        }

    }

    public function get_distance($lat1, $lon1, $lat2, $lon2) {
        $R = 6371; // Earth's mean radius in km
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
    
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
    
        $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    
        $distance = $R * $c;
        return $distance; // in km
    }
    

}
