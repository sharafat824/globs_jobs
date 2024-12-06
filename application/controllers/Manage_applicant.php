<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(5);
class Manage_applicant extends CI_Controller
{
	public function __construct()
	{
		// $this->load does not exist until after you call this
		parent::__construct(); // Construct CI's core so that you can use it

		$this->load->model('Category_Model');
		$this->load->database();
		$this->load->model('Applicant_Model');
		$this->load->model('Candidate_Model');
		$this->load->model('Email_Model');
		$this->load->model('User/User_model');
		$this->config->load('config');
		$this->load->library('pagination');
		if (!$this->session->userdata['user_id']) {
			redirect('Welcome');
		}
	}
	public function index()
	{
		$categories = $this->Category_Model->getcategories();
		$countries = $this->getCountries();

		// Load views with applicants and pagination links
		$this->load->view('includes/d-header.php');
		$this->load->view('dashboard-applicants', [
			'categories' => $categories,
			'countries' => $countries,
		]);
		$this->load->view('includes/d-footer.php');
	}

	public function getCountries()
	{
		// Select id and country name from the countries table
		$this->db->select('id, country_name');
		$this->db->from('country');
		$this->db->order_by('country_name', 'ASC'); // Optional: Order by name for better user experience

		// Execute the query and fetch the results
		$query = $this->db->get();

		// Return the result as an array
		return $query->result_array();
	}


	public function getApplicantsData()
	{
		// Get POST data from DataTable
		$postData = $this->input->post();

		// Extract required parameters
		$limit = isset($postData['length']) ? (int)$postData['length'] : 10;
		$offset = isset($postData['start']) ? (int)$postData['start'] : 0;
		$searchValue = isset($postData['search']) ? $postData['search'] : '';
		$orderColumnIndex = isset($postData['order'][0]['column']) ? (int)$postData['order'][0]['column'] : 0;
		$orderDirection = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';

		// Define the column mapping
		$columns = ['profile_pic', 'first_name', 'category_name', 'cocountry_name', 'phone', 'status', 'job',  'user_source'];
		$orderColumn = $columns[$orderColumnIndex] ?? 'first_name'; // Default to 'first_name'
		$categoryFilter = $postData['category'] ?? null;
		$countryFilter = $postData['country'] ?? null;
		$townFilter = $postData['town'] ?? null;

		// Fetch data with filters
		$data = $this->Applicant_Model->fetchApplicants($limit, $offset, $searchValue, $orderColumn, $orderDirection, $categoryFilter, $countryFilter, $townFilter);

		// Count total and filtered records
		$totalRecords = $this->Applicant_Model->countApplicantDetails();
		$filteredRecords = $this->Applicant_Model->countFilteredApplicants($searchValue, $categoryFilter, $countryFilter, $townFilter);

		// Prepare response
		$response = [
			"draw" => isset($postData['draw']) ? (int)$postData['draw'] : 1,
			"recordsTotal" => $totalRecords, // Total records (unfiltered)
			"recordsFiltered" => $filteredRecords, // Filtered records (after search)
			"data" => array_map(function ($row) {
				// Prepare profile picture HTML
				$profilePicUrl = base_url('employee_images/' . $row['profile_pic']);
				$defaultPic = base_url('assets/images/dashboard/user1.jpg');
				$profilePicHtml = '<div class="image"><img src="' . (file_exists('employee_images/' . $row['profile_pic']) ? $profilePicUrl : $defaultPic) . '"   alt="Profile Picture" class="rounded-circle avatar"></div>';

				// Convert status to human-readable value
				switch ($row['status']) {
					case 0:
						$row['status'] = '<span class="badge bg-warning">Pending</span>';
						break;
					case 1:
						$row['status'] = '<span class="badge bg-success">Approved</span>';
						break;
					case 2:
						$row['status'] = '<span class="badge bg-danger">Rejected</span>';
						break;
					default:
						$row['status'] = 'Unknown'; // In case status has an unexpected value
				}

				$row['job'] = '
				<div >
				<div class="d-flex justify-content-start p-2">
					<span class="text-dark d-flex align-items-center me-2 mb-2">
						<i class="fas fa-clipboard-list me-1"></i>
						App: <span class="ms-1 text-secondary">(' . $row['total_applied_jobs'] . ')</span>
					</span>
					<span class=" text-dark d-flex align-items-center me-2 mb-2">
						<i class="fas fa-check-circle me-1"></i>
						Short: <span class="ms-1 text-info">(' . $row['total_shortlisted_jobs'] . ')</span>
					</span>
					</div>
					<span class=" text-dark d-flex justify-content-center align-items-center mb-2">
						<i class="fas fa-user-check me-1"></i>
						Assign: <span class="ms-1 text-success">(' . $row['total_assigned_jobs'] . ')</span>
					</span>
				</div>';


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

				$plainStatus = strip_tags($row['status']);
				// Prepare action buttons dynamically
				$encrypted_id = str_replace(array('/'), array('_'), $this->encrypt->encode($row['id']));
				$row['profile_pic'] = $profilePicHtml;  // Add the profile picture HTML to the response
				$row['name'] = $row['name'] . ' ' . '<br>' . '<span class="text-info">' . $row['email'] . '</span>';
				$row['action'] = '
            <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical text-muted"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item option-btn d-flex align-items-center gap-2 mb-1 w-100" href="' . base_url("Manage_applicant/getapllicant/{$encrypted_id}") . '" title="View ">
                        <i class="bi bi-eye"></i> View 
                    </a>
					<a class="dropdown-item option-btn d-flex align-items-center gap-2 mb-1 w-100" href="' . base_url("Manage_applicant/editApllicant/{$encrypted_id}") . '" title="View ">
                        <i class="bi bi-pencil"></i> Edit 
                    </a>
					';

				// Conditionally display the "Approve Application" button
				if ($plainStatus  == 'Pending' || $plainStatus  == 'Rejected') {
					$row['action'] .= '
                <a class="dropdown-item option-btn d-flex align-items-center gap-2 mb-1 w-100" href="' . base_url("Manage_applicant/approvedapplicant/{$encrypted_id}") . '" title="Approve ">
                    <i class="bi bi-check-lg"></i> Approve 
                </a>';
				}

				// Conditionally display the "Reject Application" button
				if ($plainStatus  == 'Pending') {
					$row['action'] .= '
                <a class="dropdown-item option-btn d-flex align-items-center gap-2 mb-1 w-100" href="' . base_url("Manage_applicant/rejectapplicant/{$encrypted_id}") . '" title="Reject ">
                    <i class="bi bi-x-lg"></i> Reject 
                </a>';
				}

				// Always show the "Delete Application" button
				$row['action'] .= '
            <a class="dropdown-item option-btn d-flex align-items-center gap-2 mb-1 w-100" href="' . base_url("Manage_applicant/deleteapplicant/{$encrypted_id}") . '" title="Delete " onclick="return confirm(\'Are you sure?\');">
                <i class="bi bi-trash"></i> Delete 
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

		$config['base_url'] = base_url('Manage_Applicant/assignedjobs'); // Base URL
		$config['total_rows'] = $this->Applicant_Model->countApplicantDetails(); // Total rows count
		$per_page = $this->config->item('per_page');
		$config['use_page_numbers'] = true;
		$config['uri_segment'] = 3; // This segment will contain the page number
		$this->pagination->initialize($config);

		// Get current page
		$page = ($this->uri->segment(3)) ? (int)$this->uri->segment(3) : 1;

		// Calculate offset based on page
		$offset = ($page - 1) * $per_page;




		$applicant = $this->Applicant_Model->getassignedJob($per_page, $offset);
		// count($applicant);

		$this->load->view('includes/d-header.php');
		$this->load->view(
			'dashboard_assignjobapplicants',
			[
				'applicant' => $applicant,
				'pagination_links' => $this->load->view('pagination_bootstrap', [
					'base_url' => base_url('Manage_Applicant/assignedjobs'),
					'total_pages' => ceil($config['total_rows'] / $per_page),
					'current_page' => $page,
				], true)
			]
		);
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

	public function editApllicant($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['userInfo'] = $this->Applicant_Model->getapplicant($decrypted_id);

		$this->load->view('includes/d-header.php');
		$this->load->view('edit_applicant', $data);
		$this->load->view('includes/d-footer.php');
	}
	// public function updateApllicant($uui)
	// {
	// 	$uid = str_replace(array('_'), array('/'), $uid);
	// 	$decrypted_id = $this->encrypt->decode($uid);
	// 	$date['userInfo'] = $this->applicant_Model->editApllicant($decrypted_id);
	// }

	// new 
	public function updateApllicant()
	{
		$uid =$this->input->get('id');
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		// Load required helpers and models
		$this->load->helper(['form', 'url']);
		$this->load->library('form_validation');
	
		// Set form validation rules
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('birth_date', 'Birth Date', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('e_contact_name', 'Emergency Contact Name', 'trim|required');
		$this->form_validation->set_rules('e_contact_relation', 'Relationship', 'trim|required');
		$this->form_validation->set_rules('e_contact_phone', 'Emergency Contact Phone', 'trim|required');
	
		if ($this->form_validation->run() === FALSE) {
			// Validation failed, reload the edit form with errors
			$this->session->set_flashdata('error', validation_errors());
			redirect('user/edit_form'); // Replace with your form view path
		} else {
			// Collect input data
			$data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'gender' => $this->input->post('gender'),
				'birth_date' => $this->input->post('birth_date'),
				'address' => $this->input->post('address'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'e_contact_name' => $this->input->post('e_contact_name'),
				'e_contact_relation' => $this->input->post('e_contact_relation'),
				'e_contact_phone' => $this->input->post('e_contact_phone'),
			];
		
			if ($decrypted_id && $this->User_model->update_employee($decrypted_id, $data)) {
				// Update successful
				$this->session->set_flashdata('success', 'User information updated successfully.');
				redirect('Manage_applicant'); // Redirect to profile or desired page
			} else {
				// Update failed
				$this->session->set_flashdata('error', 'Failed to update user information. Please try again.');
				redirect('user/edit_form'); // Reload edit form
			}
		}
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
