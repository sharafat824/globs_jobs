<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
	public function __construct()
	{
		// $this->load does not exist until after you call this
		parent::__construct(); // Construct CI's core so that you can use it

		$this->load->database();
		$this->load->model('Newlaunch/Project_Model');
		$this->load->model('Newlaunch/Email1_Model');
		$this->load->model('Newlaunch/ProjectPagination_Model');
		$this->load->library('Excel');
		if (!$this->session->userdata['user_id']) {
			redirect('Welcome');
		}
	}

	public function PDF($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->getDetailsForm($decrypted_id);
		$this->load->library('Pdf');
		$this->load->view('Newlaunch/view_file', $data);
	}
	public function index()
	{

		$data['detailInfo'] = $this->Project_Model->getDetails();
		$data['region'] = $this->Project_Model->getRegion();
		$data['city'] = $this->Project_Model->getCity();
		$data['area'] = $this->Project_Model->getArea();
		$data['agency'] = $this->Project_Model->getAgency();
		$data['requirments'] = $this->Project_Model->getRequirments();
		$data['user'] = $this->Project_Model->getUser();
		// print_r($data);exit;
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/view_project', $data);
		$this->load->view('includes/footer.php');
	}

	public function ProjectTicketStatus($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->ProjectPagination_Model->getDetailsTicketStatus($decrypted_id);
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/project_ticket_status', $data);
		$this->load->view('includes/footer.php');
	}

	function getProject()
	{

		$data = $row = array();

		// Fetch member's records

		$ProjectData = $this->ProjectPagination_Model->getRows($_POST);
		$i = $_POST['start'];
		$launch_array = array();
		foreach ($ProjectData as $request) {

			$encrypted_id = $this->encrypt->encode($request->id);
			$encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);

			//$agency_id123=$this->Project_Model->uplodedesign($request->id);

			$comment = "";
			$i++;
			if ($request->flag == 1 && $this->session->userdata['rolecode'] == "CIIC") {
				$comment = "<a class='btn btn-primary btn-sm' href='Project/NewlaunchDetails/{$encrypted_id}'>Edit Project</a>";
			}
			if ($request->flag == 2 && $request->kv_status == 1 && $this->session->userdata['rolecode'] == "CIIC") {
				$comment = "<a class='btn btn-primary btn-sm' href='Project/viewDetails/{$encrypted_id}'>View Detail</a>";
			}
			if ($request->flag == 7 && ($this->session->userdata['rolecode'] == "Category")) {

				$revise = "<a class='btn btn-primary btn-sm' href='Project/getresubmit/{$encrypted_id}' style='margin-left:4px;'>Re-Submit</a>";
				$comment = "<a class='btn btn-primary btn-sm' href='Project/getproceed/{$encrypted_id}'>Proceed</a>" . $revise;
			}
			if ($request->flag == 8) {
				$comment = "<a class='btn btn-primary btn-sm' href='Project/viewDetails/{$encrypted_id}'>View Detail</a>";
			}
			if ($request->flag == 1 && ($this->session->userdata['rolecode'] == "Brand" || $this->session->userdata['rolecode'] == "Category" || $this->session->userdata['rolecode'] == "VT")) {
				$comment = "<a class='btn btn-primary btn-sm' href='Project/NewlaunchDetails/{$encrypted_id}'>View Details</a>";
			}
			if ($request->flag != 1  && $request->flag == 2  &&  $this->session->userdata['rolecode'] == "VT") {
				$comment = "<a class='btn btn-primary btn-sm' href='Project/SendtoAgency/{$encrypted_id}'>Send To Agency</a>&nbsp;<a class='btn btn-primary btn-sm' href='Project/viewDetails/{$encrypted_id}'> View Detail</a>";
			}
			if ($request->flag != 1  && $request->flag != 2 && $this->session->userdata['rolecode'] == "VT") {
				$comment = "<a class='btn btn-primary btn-sm' href='Project/viewDetails/{$encrypted_id}'> View Detail</a>";
			}
			if ($this->session->userdata['rolecode'] == "AgencyPortal") {
				$count_design = 0;
				$count_design = $this->ProjectPagination_Model->check_upload($this->session->userdata['agency_id'], $request->id);
				if ($count_design > 0) {
					$comment = "";
				} else {
					$comment = "<a class='btn btn-primary btn-sm' href='Project/uploadedesign/{$encrypted_id}'>Upload Design</a>";
				}
			}
			if ($request->flag == 4 && ($this->session->userdata['rolecode'] == "Category" || $this->session->userdata['rolecode'] == "Channel")) {
				$comment = "<a class='btn btn-primary btn-sm' href='Project/view_design/{$encrypted_id}'>View Design</a>";
			}

			if ($request->flag == 1) {
				$status = "<b style='color:orange;'>CiiC Analysis In Process</b>";
			}
			if ($request->flag == 7) {
				$status = "<b style='color:red;'>Results shared with Category</b>";
			}
			if ($request->flag == 8) {
				$status = "<b style='color:red;'>Project Concluded</b>";
			}
			if ($request->flag == 2) {
				$status = "<b style='color:orange;'>Visibility Designs Awaited</b>";
			}
			if ($request->flag == 3) {
				$status = "<b style='color:orange;'>Designs Submissions Awaited</b>";
			}
			if ($request->flag == 4) {
				$status = "<b style='color:orange;'>Design Selection Awaited</b>";
			}


			if ($request->status_name == '' && $request->project_type == 0) {
				$kv_status = 'In process';
			} else {
				$kv_status = $request->status_name;
			}
			//if($request->project_type==1) { 
			//$project= 'Special Project';
			//} 
			//else{ 
			//$project='New Launch';
			//} 

			$data[] = array(
				$i,
				anchor("Newlaunch/Project/ProjectTicketStatus/{$encrypted_id}", $status, ''),
				$comment,
				"<b>" . $request->code . "</b>",
				$request->launch_name,
				date("d-m-Y", strtotime($request->created_date)),
				date("d-m-Y", strtotime($request->timeline)),
				$request->rolecode,
				$kv_status


			);
			//		   }

		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ProjectPagination_Model->countAll(),
			"recordsFiltered" => $this->ProjectPagination_Model->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}
	public function createProject()
	{
		//$data['shopInfo'] =$this->Project_Model->getShop();
		$data['typeInfo'] = $this->Project_Model->gettype1();

		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/create_project', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function specialProject()
	{
		//$data['shopInfo'] =$this->Project_Model->getShop();
		$data['categoryInfo'] = $this->Project_Model->getcategory();
		$data['brandInfo'] = $this->Project_Model->getbrand();
		$data['channelInfo'] = $this->Project_Model->getchannel();
		$data['region'] = $this->Project_Model->getRegion();

		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/special_project', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function SendtoAgency($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->getDetailsForm($decrypted_id);
		$data['agencyInfo'] = $this->Project_Model->getagency();
		$data['gtInfo'] = $this->Project_Model->gtagency();
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/sendagency', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function NewlaunchDetails($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->getDetailsForm($decrypted_id);
		$data['statusInfo'] = $this->Project_Model->getstatus();
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/view_launch_details', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function viewDetails($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->ViewDetails($decrypted_id);
		//$data['statusInfo'] =$this->Project_Model->getstatus();
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/view_details', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}

	public function getproceed($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->ViewDetails($decrypted_id);
		$data['categoryInfo'] = $this->Project_Model->getcategory();
		$data['brandInfo'] = $this->Project_Model->getbrand();
		$data['channelInfo'] = $this->Project_Model->getchannel();
		$data['region'] = $this->Project_Model->getRegion();
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/proceed', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function getresubmit($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->ViewDetails($decrypted_id);
		//$data['statusInfo'] =$this->Project_Model->getstatus();
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/resubmit', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}

	public function uploadedesign($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->getDetailsForm($decrypted_id);
		$data['tollInfo'] = $this->Project_Model->gettoll();
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/add_design', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function view_design($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->view_design($decrypted_id);
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/view_design', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}

	public function select_design($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->select_design($decrypted_id);
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/select_design', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function Revise($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $this->Project_Model->select_design($decrypted_id);
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/revise', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function History($uid)
	{
		$uid = str_replace(array('_'), array('/'), $uid);
		$decrypted_id = $this->encrypt->decode($uid);

		$data['details'] = $decrypted_id;
		$this->load->view('includes/header.php');
		$this->load->view('includes/left_menu.php');
		$this->load->view('Newlaunch/revise_history', $data);
		$this->load->view('includes/footer.php', $data['requestInfo']);
	}
	public function add_design()
	{
		$flag = 4;

		$launch_id = $this->input->post('launch_id');
		$agency = $this->session->userdata['agency_id'];
		$aremarks = $this->input->post('aremarks');
		//$toll1 = $this->input->post('toll1');
		//print_r($toll1);exit();

		$location = 'Design_images/';
		$width      = '';
		$height     = '';
		$quality    = 50;

		if (!empty($_POST['toll1']) && !empty($_FILES['design1_1']["name"])) {

			for ($i = 1; $i <= 30; $i++) {
				//print_r($_POST['toll'.$i]);exit();
				//if(!empty($_POST['toll'.$i])){

				for ($j = 1; $j <= 5; $j++) {

					$max_ticket_id = $this->Project_Model->getMaxTicketID1();

					$ticket = 1000000 + $max_ticket_id->id + 1;
					//print_r($ticket);exit();
					$ticket_number = "Des-" . $ticket;

					if (!empty($_FILES['design' . $j . "_" . $i]["name"]) && !empty($_POST['toll' . $i])) {
						$temp_name2 = $_FILES['design' . $j . "_" . $i]["tmp_name"];
						$new_image_name2 = uniqid() . str_replace(' ', '', $_FILES['design' . $j . "_" . $i]["name"]);
						$target_file2 = $location . $new_image_name2;
						$this->Project_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
						$toll1 = $_POST['toll' . $i];

						$userInfo = array('design_code' => $ticket_number, 'design' => $new_image_name2, 'launch_id' => $launch_id, 'toll_id' => $toll1, 'agency_id' => $agency, 'add_design_date' => date('Y-m-d H:i:s'));
						$result = $this->Project_Model->updatedesign($userInfo);
					}
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Please Select Minimum One Tool And Design');
			redirect('Newlaunch/project');
		}


		$userInfo = array('flag' => $flag, 'ag_remarks' => $aremarks);
		$update = $this->Project_Model->editNewlaunch($userInfo, $launch_id);

		if ($update) {

			$project_code = $this->Project_Model->getcode($launch_id);
			$rolecode = 'Category';

			$email_id = $this->Project_Model->getuseremail($rolecode);
			foreach ($email_id as $email) {
				//echo $email->email;
				$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ' . $project_code . '. Click on the link to see the details.');
			}
			$this->session->set_flashdata('success', 'Design uploaded Successfully');
			redirect('Newlaunch/project');
		}
	}
	public function updaeagency()
	{
		$flag = 3;
		$launch_id = $this->input->post('launch_id');
		$agency = implode(",", $this->input->post('mt[]'));
		$gt_agency = implode(",", $this->input->post('gt[]'));
		$remarks = $this->input->post('remarks');
		//print_r($agency);exit;
		$attachment = '';



		$details = $this->Project_Model->getDetailsForm($launch_id);

		//print_r($details->launch_name);exit();
		$this->load->library('Pdf');
		$CI = &get_instance();


		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetTitle('Project Management');
		$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 6, 255), array(0, 64, 128));
		$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// ---------------------------------------------------------
		// set default font subsetting mode
		$pdf->setFont('times', '', 12, '', true);
		$pdf->AddPage();
		$created_date_time = date("d-m-Y ", strtotime($details->created_date));
		$launch_timeline = date("d-m-Y ", strtotime($details->timeline));
		$remarks_date = date("d-m-Y", strtotime($details->q_date));

		$breaf_remarks = '';
		$remaek_data = '';
		$kv_data = '';
		$massage = '';
		$massage1 = '';
		if ($details->project_type != 1) {
			$remaek_data = '<tr><td style="background-color:#9ebdda;font-size:13px;"><b>Brief Remarks:</b></td>
	<td style="background-color:#9ebdda;font-size:13px;">' . $details->remarks . '</td></tr>';
		}
		if ($details->project_type != 1) {

			$kv_data = '<tr>
				<td width="20%" style="background-color:#9ebdda;font-size:13px;"><b>KV Status:</b></td>
				<td style="background-color:#9ebdda;font-size:12px;">' . $details->status_name . '</td>
				<td style="background-color:#9ebdda;font-size:13px;"><b>Score:</b></td>
				<td style="background-color:#9ebdda;font-size:13px;">' . $details->score . '</td>
			</tr>';
		}
		if ($details->project_type == 1) {
			$imageDetails = $CI->Project_Model->surveyImages($details->launch_id);
			if (count($imageDetails) > 0) {
				$massage = "<h3>Attach Pictures</h3>";
				//$massage1="<h3>Tested KV's</h3>";
			}
		} else {
			$imageDetails = $CI->Project_Model->surveyImages($details->launch_id);
			$massage = "<h3>KV's</h3>";
		}

		if ($details->project_type != 1) {

			$imageDetails = $CI->Project_Model->attestedkv($details->launch_id);
			if (count($imageDetails) > 0) {

				$massage1 = "<h3>Tested KV's</h3>";
			} else {

				$massage1 = "";
			}
		}

		if ($details->project_type == 1) {

			$category = '';
			$brand = '';
			$channel = '';
			$geo = '';
			$category_name1val = "";
			$brand_name1val = "";
			$channel_name1val = "";
			$category = explode(',', $details->category);
			$category_name1 = '';
			foreach ($category as $b) :
				$category_name1 = $CI->Project_Model->get_category($b);
				$category_name1val .= $category_name1->name . ',';

			endforeach;
			$category = '<tr>
			<td style="background-color:#9ebdda;font-size:13px;"><b>Category:</b></td>
			<td style="background-color:#9ebdda;font-size:13px;">' . $category_name1val . '</td>
	        </tr>';

			$brand = explode(',', $details->brand);
			$brand_name1 = '';
			foreach ($brand as $b) :
				$brand_name1 = $CI->Project_Model->get_brand($b);
				$brand_name1val .= $brand_name1->brand . ',';

			endforeach;
			$brand = '<tr>
			<td style="background-color:#9ebdda;font-size:13px;"><b>Brand:</b></td>
			<td style="background-color:#9ebdda;font-size:13px;">' . $brand_name1val . '</td>
	        </tr>';

			$channel = explode(',', $details->channel);
			$channel_name1 = '';
			foreach ($channel as $b) :
				$channel_name1 = $CI->Project_Model->get_channel($b);
				$channel_name1val .= $channel_name1->name . ',';

			endforeach;
			$channel = '<tr>
			<td style="background-color:#9ebdda;font-size:13px;"><b>Channel:</b></td>
			<td style="background-color:#9ebdda;font-size:13px;">' . $channel_name1val . '</td>
	        </tr>';

			$geo = explode(',', $details->geo);
			$region_name1val = '';
			foreach ($geo as $b) :
				$region_name1 = $CI->Project_Model->get_geo($b);
				$region_name1val .= $region_name1->region_name . ',';

			endforeach;
			$geo = '<tr>
			<td style="background-color:#9ebdda;font-size:13px;"><b>Geo:</b></td>
			<td style="background-color:#9ebdda;font-size:13px;">' . $region_name1val . '</td>
	        </tr>';

			$breaf_remarks = '<tr>
			<td style="background-color:#9ebdda;font-size:13px;"><b>Date:</b></td>
			<td style="background-color:#9ebdda;font-size:13px;">' . $remarks_date . '</td>
	        </tr>
			<tr>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;"><b>What is the insight behind this activity?</b></td>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;">' . $details->question1 . '</td>
	        </tr>
			<tr>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;"><b>Who are we trying to influence and what do we need them to do as a result of this communication?</b></td>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;">' . $details->question2 . '</td>
	        </tr>
			<tr>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;"><b>How do we expect communications to work towards achieving this?</b></td>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;">' . $details->question3 . '</td>
	        </tr>
			<tr>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;"><b>What are we trying to convey?</b></td>
			<td colspan="2" style="background-color:#9ebdda;font-size:13px;">' . $details->question4 . '</td>
	        </tr>
			<tr>
			<td width="20%"style="background-color:#9ebdda;font-size:13px;"><b>Mandatories</b></td>
			<td style="background-color:#9ebdda;font-size:13px;">' . $details->mandatories . '</td>
	        </tr>';
		}
		$html = <<<EOD
        <div><h4 style="text-align:center;"><b>Project Code# :</b>$details->code</h4></div>
        
        <table width="100%" border="1">
                <tbody>
                        <tr>
                                <td width="20%" style="background-color:#9ebdda;font-size:13px;"><b>Launch Name:</b></td>
                                <td style="background-color:#9ebdda;font-size:12px;">$details->launch_name</td>
                                <td style="background-color:#9ebdda;font-size:13px;"><b>Created Date:</b></td>
                                <td style="background-color:#9ebdda;font-size:13px;">$created_date_time</td>
                        </tr>
                        <tr>
                                <td style="background-color:#9ebdda;font-size:13px;"><b>Launch Timeline:</b></td>
                                <td style="background-color:#9ebdda;font-size:13px;">$launch_timeline</td>
                                
                        </tr>
                        $remaek_data
						$kv_data
						$category
						$brand
                        $breaf_remarks
						$channel
						$geo
                </tbody>
        </table>
        
        <h3>$massage</h3>
       
EOD;

		$imageDetails = $CI->Project_Model->surveyImages($details->launch_id);
		foreach ($imageDetails as $repair_image) :
			$html .= <<<EOD
        <img src="Design_images/$repair_image->kv_image" width="120" height="70" />   
EOD;
		endforeach;
		$html .= <<<EOD

        
        
        <h3>$massage1</h3>
EOD;

		$imageDetails = $CI->Project_Model->attestedkv($details->launch_id);
		foreach ($imageDetails as $repair_image) :
			$html .= <<<EOD
        <img src="Design_images/$repair_image->kv_image" width="120" height="70" />   
EOD;
		endforeach;



		$pdf_name = rand() . uniqid();

		$pdf->writeHTML($html);
		//$pdf->Output('Design.pdf', 'I');


		//$pdf->Output('pdf/'.$pdf_name.'.pdf', 'F');
		$pdf->Output(dirname(__FILE__) . '/pdf/' . $pdf_name . '.pdf', 'F');

		$attachment = dirname(__FILE__) . '/pdf/' . $pdf_name . '.pdf';
		//print_r($pdf_name);exit();
		if ($gt_agency != '') {
			$gtagency = (explode(",", $gt_agency));
			foreach ($gtagency as $gt) {
				$email_id = $this->Project_Model->getemail($gt);
				$mail = $this->Email1_Model->send_attachment($email_id, 'dssdsdsdsdd', $attachment);
				//$mail=$this->Email_Model->send($email_id,'dssdsdsdsdd');


			}
			unlink($attachment);
		}

		$userInfo = array('agency_id' => $agency, 'visibility_remarks' => $remarks, 'flag' => $flag, 'assign_agency_date' => date('Y-m-d H:i:s'));
		$update = $this->Project_Model->updaeagency($userInfo, $launch_id);

		if ($update) {

			$project_code = $this->Project_Model->getcode($launch_id);
			$mtagency = (explode(",", $agency));
			foreach ($mtagency as $agency_id) {
				$email_id = $this->Project_Model->agencyuseremail($agency_id);
				foreach ($email_id as $email) {
					//echo $email->email;
					$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ' . $project_code . '. Click on the link to see the details.');
				}
			}
			$this->session->set_flashdata('success', 'Project Assign To Agency Successfully');
			redirect('Newlaunch/project');
		}
	}
	public function add_shop()
	{
		if(!empty($this->input->post('finalize_design'))){
			$finalize_design = 1;
		}
		else{
			$finalize_design = 0;
		}
		
		//$flag = 5;
		$design_id = $this->input->post('design_id');
		$launch_id = $this->input->post('launch_id');
		$quantity = $this->input->post('quantity');
		$agency_id = $this->input->post('agency_id');
        
		if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != '') {
			$path = $_FILES["file"]["tmp_name"];
			//FORMAT CHECK

			$valid = false;
			$types = array('Excel2007', 'Excel5');
			foreach ($types as $type) {
				$reader = PHPExcel_IOFactory::createReader($type);
				if ($reader->canRead($path)) {
					$valid = true;
					break;
				}
			}

			if ($valid == false) {
				$this->session->set_flashdata('error', 'Invalid Format. Please Upload using xlsx format');
				redirect('Newlaunch/Design');
			}
			//FORMAT CHECK END      

			$object = PHPExcel_IOFactory::load($path);
			foreach ($object->getWorksheetIterator() as $worksheet) {

				$s_code = $worksheet->getCellByColumnAndRow(0, 1)->getValue();


				if (
					$s_code != "LE POP CODE"
				) {
					$this->session->set_flashdata('error', 'Incorrect Headings.');
					redirect('Newlaunch/Design');
				}

				if (!empty($s_code)) {
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for ($row = 2; $row <= $highestRow; $row++) {
						$shop_code = $worksheet->getCellByColumnAndRow(0, $row)->getValue();

						if (!empty($shop_code)) {

							$shop_code_check = $this->Project_Model->code_check($shop_code);

							//print_r($shop_code_check->id);exit();

							if (!empty($shop_code_check->id)) {
								$shop_id[] = $shop_code_check->id;
							} else {
								$this->session->set_flashdata('error', 'Incorrect Shop Codes In Uploaded Sheet');
								redirect('Newlaunch/Project');
							}
						}
					}
				}
			}
			$post_imag = uniqid() . time() . rand() . $_FILES["file"]["name"];
			move_uploaded_file($path, 'approval_attachment/' . $post_imag);

			$shop_list = implode(',', $shop_id);
			
			$userInfo = array('quantity' => $quantity, 'shop_list' => $shop_list, 'shop_attachments' => $post_imag, 'flag' => 1, 'selected_design' => 1, 'approval_date' => date('Y-m-d H:i:s'), 'uploadeshop_date' => date('Y-m-d H:i:s'));
			$update = $this->Project_Model->updateshop($userInfo, $design_id);

			$email_id = $this->Project_Model->agencyuseremail($agency_id);
			foreach ($email_id as $email) {
				//echo $email->email;
				$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ‘Project KV’. Click on the link to see the details.');
			}
		} else {

			$userInfo = array('quantity' => $quantity, 'flag' => 12, 'selected_design' => 1, 'approval_date' => date('Y-m-d H:i:s'));
			$update = $this->Project_Model->updateshop($userInfo, $design_id);

		
		}
        	$finalizeDesign = array('finalize_design'=>$finalize_design);
			$finalizeDesignUpdate = $this->Project_Model->finalizeDesign($finalizeDesign, $launch_id);
			
		if ($update) {

			$deesign_code = $this->Project_Model->getdesigncode($design_id);

			$rolecode = 'Channel';

			$email_id = $this->Project_Model->getuseremail($rolecode);
			foreach ($email_id as $email) {
				//echo $email->email;
				$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ' . $deesign_code . '. Click on the link to see the details.');
			}
			$this->session->set_flashdata('success', 'Design Selected Successfully');
			redirect('Newlaunch/project');
		}
	}
	public function revise_design()
	{

		$design_id = $this->input->post('design_id');
		$remarks = $this->input->post('remarks');
		$revisecount1 = $this->input->post('revisecount');
		$revisecount = $revisecount1 + 1;
		//print_r($revisecount);exit();

		$userInfo = array('revise_remarks' => $remarks, 'revise_count' => $revisecount, 'uploade_again' => 1, 'revision_date' => date('Y-m-d'));
		$update = $this->Project_Model->updateshop($userInfo, $design_id);

		if ($update) {
			$this->session->set_flashdata('success', 'Design Sent for revision to Agency');
			redirect('Newlaunch/project');
		}
	}
	public function Proceedproject()
	{

		$launch_id = $this->input->post('launch_id');
		$category = implode(",", $this->input->post('category[]'));
		$brand = implode(",", $this->input->post('brand[]'));
		$q_date = $this->input->post('q_date');
		$q1 = $this->input->post('q1');
		$q2 = $this->input->post('q2');
		$q3 = $this->input->post('q3');
		$q4 = $this->input->post('q4');
		$mandatories = $this->input->post('mandatories');
		$channel = implode(",", $this->input->post('channel[]'));
		$geo = implode(",", $this->input->post('geo[]'));

		$questionInfo = array('project_id' => $launch_id, 'category' => $category, 'brand' => $brand, 'q_date' => $q_date, 'question1' => $q1, 'question2' => $q2, 'question3' => $q3, 'question4' => $q4, 'mandatories' => $mandatories, 'channel' => $channel, 'geo' => $geo);
		$result = $this->Project_Model->updatequestion($questionInfo);

		$userInfo = array('flag' => 2);
		$update = $this->Project_Model->editNewlaunch($userInfo, $launch_id);

		if ($update) {

			$project_code = $this->Project_Model->getcode($launch_id);

			$rolecode = 'VT';

			$email_id = $this->Project_Model->getuseremail($rolecode);
			foreach ($email_id as $email) {
				//echo $email->email;
				$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ' . $project_code . '. Click on the link to see the details.');
			}
			$this->session->set_flashdata('success', 'Project Updated Successfully');
			redirect('Newlaunch/project');
		}
	}
	public function Special_project()
	{
		$max_ticket_id = $this->Project_Model->getMaxTicketID();

		$la_name = $this->input->post('la_name');
		$l_date = $this->input->post('l_date');
		$user_id = $this->session->userdata['user_id'];

		$ticket = 1000000 + $max_ticket_id->id + 1;
		//print_r($ticket);exit();
		$ticket_number = "NL-" . $ticket;
		$ticket_id = $this->Project_Model->specialTicket($ticket_number, $la_name, $l_date, $user_id);

		$location = 'Design_images/';
		$width      = '';
		$height     = '';
		$quality    = 50;

		$images_all = count($_FILES['image1']['name']);
		for ($i = 0; $i <= $images_all; $i++) {
			if (!empty($_FILES['image1']["name"][$i])) {
				$temp_name2 = $_FILES['image1']["tmp_name"][$i];
				$new_image_name2 = uniqid() . str_replace(' ', '', $_FILES['image1']["name"][$i]);
				$target_file2 = $location . $new_image_name2;
				$this->Project_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
				$userInfo = array('kv_image' => $new_image_name2, 'new_launch_id' => $ticket_id);
				$result = $this->Project_Model->updatekv($userInfo);
			}
		}
		//$launch_id = $this->input->post('ticket_id');
		$category = implode(",", $this->input->post('category[]'));
		//$category = $this->input->post('category');
		$brand = implode(",", $this->input->post('brand[]'));
		$q_date = $this->input->post('q_date');
		$q1 = $this->input->post('q1');
		$q2 = $this->input->post('q2');
		$q3 = $this->input->post('q3');
		$q4 = $this->input->post('q4');
		$mandatories = $this->input->post('mandatories');
		$channel = implode(",", $this->input->post('channel[]'));
		$geo = implode(",", $this->input->post('geo[]'));

		$questionInfo = array('project_id' => $ticket_id, 'category' => $category, 'brand' => $brand, 'q_date' => $q_date, 'question1' => $q1, 'question2' => $q2, 'question3' => $q3, 'question4' => $q4, 'mandatories' => $mandatories, 'channel' => $channel, 'geo' => $geo);
		$result = $this->Project_Model->updatequestion($questionInfo);

		$userInfo = array('flag' => 2, 'project_type' => 1);
		$update = $this->Project_Model->editNewlaunch($userInfo, $ticket_id);

		if ($update) {
			$rolecode = 'VT';

			$email_id = $this->Project_Model->getuseremail($rolecode);
			foreach ($email_id as $email) {
				//echo $email->email;
				$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ' . $ticket_number . '. Click on the link to see the details.');
			}
			$this->session->set_flashdata('success', 'Project Updated Successfully');
			redirect('Newlaunch/project');
		}
	}
	public function resubmit()
	{

		$launch_id = $this->input->post('launch_id');


		$update1 = $this->Project_Model->deletecity($launch_id);


		$location = 'Design_images/';
		$width      = '';
		$height     = '';
		$quality    = 50;

		$images_all = count($_FILES['image2']['name']);
		for ($i = 0; $i <= $images_all; $i++) {
			if (!empty($_FILES['image2']["name"][$i])) {
				$temp_name2 = $_FILES['image2']["tmp_name"][$i];
				$new_image_name2 = uniqid() . str_replace(' ', '', $_FILES['image2']["name"][$i]);
				$target_file2 = $location . $new_image_name2;
				$this->Project_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
				$userInfo = array('kv_image' => $new_image_name2, 'new_launch_id' => $launch_id);
				$result = $this->Project_Model->updatekv($userInfo);
			}
		}
		$userInfo = array('flag' => 1);
		$update = $this->Project_Model->editNewlaunch($userInfo, $launch_id);


		if ($update) {
			$this->session->set_flashdata('success', 'Project Updated Successfully');
			redirect('Newlaunch/project');
		}
	}
	public function editproject()
	{
		$rolecode = $this->input->post('rolecode1');
		//print_r($rolecode);exit();
		if ($rolecode == "Brand") {
			$flag = 8;
		} else {
			$flag = 7;
		}


		$launch_id = $this->input->post('launch_id');
		$score = $this->input->post('score');
		$status = $this->input->post('status');
		//$project_code=$this->Project_Model->getcode($launch_id);
		//print_r($project_code);exit(); 
		$location = 'Design_images/';
		$width      = '';
		$height     = '';
		$quality    = 50;

		$images_all = count($_FILES['image2']['name']);
		for ($i = 0; $i <= $images_all; $i++) {
			if (!empty($_FILES['image2']["name"][$i])) {
				$temp_name2 = $_FILES['image2']["tmp_name"][$i];
				$new_image_name2 = uniqid() . str_replace(' ', '', $_FILES['image2']["name"][$i]);
				$target_file2 = $location . $new_image_name2;
				$this->Project_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
				$userInfo = array('kv_image' => $new_image_name2, 'new_launch_id' => $launch_id, 'flag' => 1);
				$result = $this->Project_Model->updatekv($userInfo);
			}
		}

		$userInfo = array('score' => $score, 'kv_status' => $status, 'flag' => $flag, 'project_edit_date' => date('Y-m-d H:i:s'));
		$update = $this->Project_Model->editNewlaunch($userInfo, $launch_id);

		if ($update) {

			$project_code = $this->Project_Model->getcode($launch_id);
			$rolecode = 'Category';

			$email_id = $this->Project_Model->getuseremail($rolecode);
			foreach ($email_id as $email) {
				//echo $email->email;
				$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ' . $project_code . '. Click on the link to see the details.');
			}
			$this->session->set_flashdata('success', 'Project Updated Successfully');
			redirect('Newlaunch/project');
		}
	}
	public function fetch_shop_details()
	{
		$shop_details =  $_REQUEST['shop_details'];
		if (!empty($shop_details)) {
			echo $this->Project_Model->fetch_shop_details($shop_details);
		}
	}
	public function creation()
	{
		$max_ticket_id = $this->Project_Model->getMaxTicketID();
		$flag = 1;
		$la_name = $this->input->post('la_name');
		$l_date = $this->input->post('l_date');
		$remarks = $this->input->post('remarks');
		$user_id = $this->session->userdata['user_id'];


		$ticket = 1000000 + $max_ticket_id->id + 1;
		//print_r($ticket);exit();
		$ticket_number = "NL-" . $ticket;
		$ticket_id = $this->Project_Model->createTicket($ticket_number, $flag, $la_name, $remarks, $l_date, $user_id);

		$location = 'Design_images/';
		$width      = '';
		$height     = '';
		$quality    = 50;

		$images_all = count($_FILES['image1']['name']);
		for ($i = 0; $i <= $images_all; $i++) {
			if (!empty($_FILES['image1']["name"][$i])) {
				$temp_name2 = $_FILES['image1']["tmp_name"][$i];
				$new_image_name2 = uniqid() . str_replace(' ', '', $_FILES['image1']["name"][$i]);
				$target_file2 = $location . $new_image_name2;
				$this->Project_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
				$userInfo = array('kv_image' => $new_image_name2, 'new_launch_id' => $ticket_id);
				$result = $this->Project_Model->updatekv($userInfo);
			}
		}

		if ($result == true) {
			$rolecode = 'CIIC';

			$email_id = $this->Project_Model->getuseremail($rolecode);
			foreach ($email_id as $email) {
				//echo $email->email;
				$mail = $this->Email1_Model->send($email->email, 'An action is required from your end regarding ' . $ticket_number . '. Click on the link to see the details.');
			}
			$this->session->set_flashdata('success', 'Project Created successfully.');
			return redirect('Newlaunch/project');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
			redirect('Newlaunch/project');
			//exit();
		}
	}
	//Fetch Area from City
	public function fetch_area()
	{
		$city_id =  $_REQUEST['city'];
		if (!empty($city_id)) {
			echo $this->Project_Model->fetch_area($city_id);
		}
	}
	//Fetch Area from City
	public function fetch_city()
	{
		$region_id =  $_REQUEST['region'];
		if (!empty($region_id)) {
			echo $this->Project_Model->fetch_city($region_id);
		}
	}
}
