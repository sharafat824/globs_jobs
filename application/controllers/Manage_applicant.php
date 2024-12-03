<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Manage_applicant extends CI_Controller
{
	public function __construct()
	{
		// $this->load does not exist until after you call this
		parent::__construct(); // Construct CI's core so that you can use it

		$this->load->database();
		$this->load->model('Applicant_Model');
		$this->load->model('Candidate_Model');
		$this->load->model('Email_Model');
		$this->config->load('config');
		if (!$this->session->userdata['user_id']) {
			redirect('Welcome');
		}
	}
	public function index()
	{
		// Load Pagination library
		$this->load->library('pagination');

		// Pagination configuration
		$config['base_url'] = base_url('Manage_applicant/index');
		$config['total_rows'] = $this->Applicant_Model->countApplicantDetails();
		$per_page = $this->config->item('per_page');
		$config['use_page_numbers'] = true;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		// Get current page
		$page = ($this->uri->segment(3)) ? (int)$this->uri->segment(3) : 1;

		// Calculate offset
		$offset = ($page - 1) * $per_page;

		// Fetch applicants with limit and offset
		$applicants = $this->Applicant_Model->getapplicantDetails($per_page, $offset);

		//die(json_encode($applicants));
		// Store total rows in a variable
		$total_rows = $config['total_rows'];


		// Load views with applicants and pagination links
		$this->load->view('includes/d-header.php');
		$this->load->view('dashboard-applicants', [
			'applicant' => $applicants,
			'pagination_links' => $this->load->view('pagination_bootstrap', [
				'base_url' => base_url('Manage_applicant/index'),
				'total_pages' => ceil($total_rows / $per_page), // Use ceil to get the total number of pages
				'current_page' => $page
			], true)
		]);
		$this->load->view('includes/d-footer.php');
	}

	public function getApplicantsData()
{
    // Get POST data from DataTable
    $postData = $this->input->post();

    // Extract required parameters
    $limit = isset($postData['length']) ? (int)$postData['length'] : 10;
    $offset = isset($postData['start']) ? (int)$postData['start'] : 0;
    $searchValue = isset($postData['search']['value']) ? $postData['search']['value'] : '';
    $orderColumnIndex = isset($postData['order'][0]['column']) ? (int)$postData['order'][0]['column'] : 0;
    $orderDirection = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';

    // Define the column mapping
    $columns = ['profile_pic', 'first_name', 'category_name', 'cocountry_name', 'phone', 'status', 'total_applied_jobs', 'total_shortlisted_jobs', 'total_assigned_jobs', 'user_source'];
    $orderColumn = $columns[$orderColumnIndex] ?? 'first_name'; // Default to 'first_name'

    // Fetch data from model (consider limiting based on pagination)
    $data = $this->Applicant_Model->fetchApplicants($limit, $offset, $searchValue, $orderColumn, $orderDirection);

    // Count total records (unfiltered)
    $totalRecords = $this->Applicant_Model->countApplicantDetails();

    // Count filtered records (for the search query)
    $filteredRecords = $this->Applicant_Model->countFilteredApplicants($searchValue);
	
    // Prepare response
    $response = [
        "draw" => isset($postData['draw']) ? (int)$postData['draw'] : 1,
        "recordsTotal" => $totalRecords, // Total records (unfiltered)
        "recordsFiltered" => $filteredRecords, // Filtered records (after search)
        "data" => array_map(function ($row) {
            // Prepare profile picture HTML
            $profilePicUrl = base_url('employee_images/' . $row['profile_pic']);
            $defaultPic = base_url('assets/images/dashboard/user1.jpg');
            $profilePicHtml = '<img src="' . (file_exists('employee_images/' . $row['profile_pic']) ? $profilePicUrl : $defaultPic) . '" height="110" width="80" class="rounded-circle" alt="Profile Picture">';

            // Convert status to human-readable value
            switch ($row['status']) {
                case 0:
                    $row['status'] = 'Pending';
                    break;
                case 1:
                    $row['status'] = 'Approved';
                    break;
                case 2:
                    $row['status'] = 'Rejected';
                    break;
                default:
                    $row['status'] = 'Unknown'; // In case status has an unexpected value
            }
		
            // Convert status to human-readable value
            switch ($row['user_source']) {
                case 0:
                    $row['user_source'] = 'JobsGlob';
                    break;
                case 1:
                    $row['user_source'] = 'Aegseagles';
                    break;
                case 2:
                    $row['user_source'] = 'MobileApp';
                    break;
                default:
                    $row['user_source'] = 'Unknown'; // In case status has an unexpected value
            }
			$row['name'] = $row['first_name'].' '. $row['last_name'];

            // Prepare action buttons dynamically
            $encrypted_id = str_replace(array('/'), array('_'), $this->encrypt->encode($row['id']));
            $row['profile_pic'] = $profilePicHtml;  // Add the profile picture HTML to the response
            $row['action'] = '
            <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="' . base_url("Manage_applicant/getapllicant/{$encrypted_id}") . '" title="View Application">
                        <i class="bi bi-eye"></i> View Application
                    </a>';

            // Conditionally display the "Approve Application" button
            if ($row['status'] == 'Pending' || $row['status'] == 'Rejected') {
                $row['action'] .= '
                <a class="dropdown-item" href="' . base_url("Manage_applicant/approvedapplicant/{$encrypted_id}") . '" title="Approve Application">
                    <i class="bi bi-check-lg"></i> Approve Application
                </a>';
            }

            // Conditionally display the "Reject Application" button
            if ($row['status'] == 'Pending') {
                $row['action'] .= '
                <a class="dropdown-item" href="' . base_url("Manage_applicant/rejectapplicant/{$encrypted_id}") . '" title="Reject Application">
                    <i class="bi bi-x-lg"></i> Reject Application
                </a>';
            }

            // Always show the "Delete Application" button
            $row['action'] .= '
            <a class="dropdown-item" href="' . base_url("Manage_applicant/deleteapplicant/{$encrypted_id}") . '" title="Delete Application" onclick="return confirm(\'Are you sure?\');">
                <i class="bi bi-trash"></i> Delete Application
            </a>
            </div>
        </div>
    ';

            return $row;
        }, $data)
    ];

    // Return JSON response
    echo json_encode($response);
}

	public function assignedjobs()
	{


		$applicant = $this->Applicant_Model->getassignedJob();
		// count($applicant);

		$this->load->view('includes/d-header.php');
		$this->load->view('dashboard_assignjobapplicants', ['applicant' => $applicant]);
		$this->load->view('includes/d-footer.php');
	}

	public function getapllicant($uid)
	{

		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['userInfo'] = $this->Applicant_Model->getapplicant($decrypted_id);

		$this->load->view('includes/d-header.php');
		$this->load->view('view_applicant', $data);
		$this->load->view('includes/d-footer.php');
	}


	public function deleteapplicant($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);
		$result = $this->Applicant_Model->deletejob($decrypted_id);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Candidate has been removed from job successfully.');
			return redirect('Manage_applicant');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
			redirect('Manage_applicant');
		}
	}
	public function approvedapplicant($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);
		$status = 1;
		$userInfo = array('status' => $status);
		$result = $this->Applicant_Model->approve($decrypted_id, $userInfo);
		if ($result == true) {
			$email_id = $this->Candidate_Model->getuseremail2($decrypted_id);
			foreach ($email_id as $email) {

				//echo $email->user_email;exit();
				if ($email->user_email != NULL) {
					$mail = $this->Email_Model->send($email->user_email, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
					$notification = $this->Email_Model->sendNotification($email->fcm_token, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
				}

				if ($email->fcm_token != NULL) {
					$notification = $this->Email_Model->sendNotification($email->fcm_token, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
				}
			}
			$this->session->set_flashdata('success', 'Approved successfully.');
			return redirect('Manage_applicant');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
			redirect('Manage_applicant');
		}
	}
	public function approveSingleApplicant($uid)
	{
		$uidNew = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uidNew);
		$status = 1;
		$userInfo = array('status' => $status);
		$result = $this->Applicant_Model->approve($decrypted_id, $userInfo);
		if ($result == true) {
			$email_id = $this->Candidate_Model->getuseremail2($decrypted_id);
			foreach ($email_id as $email) {
				//echo $email->user_email;exit();
				if ($email->user_email != NULL) {
					$mail = $this->Email_Model->send($email->user_email, 'Your Profile Approved.', 'Congratulation!! Your profile has been approved successfully now you can apply for jobs.');
				}
			}
			$this->session->set_flashdata('success', 'Approved successfully.');
			return redirect('Manage_applicant/getapllicant/' . $uid);
		} else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
			redirect('Manage_applicant/getapllicant/' . $uid);
		}
	}
	public function rejectapplicant($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);
		$status = 2;
		$userInfo = array('status' => $status);
		$result = $this->Applicant_Model->approve($decrypted_id, $userInfo);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Approved successfully.');
			return redirect('Manage_applicant');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again.');
			redirect('Manage_applicant');
		}
	}
}
