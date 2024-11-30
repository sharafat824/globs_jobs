<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends CI_Controller {
 public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->database();
        $this->load->model('Newlaunch/Project_Model');
        $this->load->model('Newlaunch/DesignPagination_Model');
        if(!$this->session->userdata['user_id'])
        {
                redirect('Welcome');
        }
    }

	public function index()
	{
        
                $data['detailInfo'] =$this->Project_Model->getDetails();
                
                // print_r($data);exit;
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/approve_design',$data);
                $this->load->view('includes/footer.php');
	}
	public function add_quetations($uid,$uid1)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
		$uid1=str_replace(array('_'), array('/'), $uid1);
        $design_id = $this->encrypt->decode($uid1);

                $data['details'] =$this->Project_Model->getDetailsForm1($decrypted_id,$design_id);
				//$data['statusInfo'] =$this->Project_Model->getstatus();
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/add_quetations',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	public function approval($uid,$uid1,$approval)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
		$uid1=str_replace(array('_'), array('/'), $uid1);
        $design_id = $this->encrypt->decode($uid1);
		

                $data['details'] =$this->Project_Model->getDetailsForm2($decrypted_id,$design_id);
				$data['approval'] =$approval;
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/approval',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	public function attach_po($uid,$uid1)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
		$uid1=str_replace(array('_'), array('/'), $uid1);
        $design_id = $this->encrypt->decode($uid1);
		

                $data['details'] =$this->Project_Model->getDetailsForm2($decrypted_id,$design_id);
				//$data['approval'] =$approval;
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/attach_po',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	public function add_timeline($uid,$uid1)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
		$uid1=str_replace(array('_'), array('/'), $uid1);
        $design_id = $this->encrypt->decode($uid1);
		

                $data['details'] =$this->Project_Model->getDetailsForm2($decrypted_id,$design_id);
				//$data['approval'] =$approval;
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/add_timeline',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	
	public function add_rc($uid,$uid1)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
		$uid1=str_replace(array('_'), array('/'), $uid1);
        $design_id = $this->encrypt->decode($uid1);
		

                $data['details'] =$this->Project_Model->getDetailsForm2($decrypted_id,$design_id);
				//$data['approval'] =$approval;
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/add_rc',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	public function designupdated()
    {
		$flag = 4;
                
				$design_id = $this->input->post('design_id');
				$old_design = $this->input->post('old_design');
				$remarks = $this->input->post('remarks');
				
				
				
        $location = 'Design_images/';  
            $width      = '';
            $height     = '';
            $quality    = 50;
			
			
				if(!empty($_FILES['design']["name"])){
					$temp_name2 = $_FILES['design']["tmp_name"];
					$new_image_name2 = uniqid().str_replace(' ', '', $_FILES['design']["name"]);
					$target_file2 =$location.$new_image_name2;
					$this->Project_Model->compress_image($temp_name2, $target_file2, $width, $height, $quality);
					//exit();
					$userInfo = array('revise_design'=> $old_design,'revise_remarks'=>$remarks,'design_id'=>$design_id,'created_date'=>date('Y-m-d'));
                    $update = $this->Project_Model->revise_history($userInfo);
					
					$userInfo = array('Design'=> $new_image_name2,'uploade_again'=> 0);
                    $update = $this->Project_Model->updateshop($userInfo,$design_id);
				}
			if($update){
            $this->session->set_flashdata('success', 'Design Updated Successfully');
            redirect('Newlaunch/Design');
        }
	}
	public function uploadeagain($uid)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

                $data['details'] =$this->Project_Model->select_design($decrypted_id);
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/uploade_again',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	public function updatedesign()
    {
		$flag = 2;
                $design_id = $this->input->post('design_id');
				$quetations = $this->input->post('quetations');
				//print_r($agency);exit;
				$post_tmp_img = $_FILES["attachments"]["tmp_name"];
				$post_imag = uniqid().time().rand().$_FILES["attachments"]["name"];
				move_uploaded_file($post_tmp_img,'approval_attachment/'.$post_imag);
        
        $userInfo = array('qu_attachments'=> $post_imag,'quetations'=> $quetations,'flag'=> $flag,'add_quotation_date'=> date('Y-m-d'));
        $update = $this->Project_Model->updateshop($userInfo,$design_id);
        
        if($update){
            $this->session->set_flashdata('success', 'Quotation Added Successfully');
            redirect('Newlaunch/Design');
        }
        
    }
	public function Add_po()
    {
		$flag = 4;
                $design_id = $this->input->post('design_id');
				$po_number = $this->input->post('po_number');
				
		$post_tmp_img = $_FILES["attachments"]["tmp_name"];
        $post_imag = uniqid().time().rand().$_FILES["attachments"]["name"];
        move_uploaded_file($post_tmp_img,'approval_attachment/'.$post_imag);
        
        $userInfo = array('po_attachments'=> $post_imag,'po_number'=> $po_number,'flag'=> $flag,'add_po_date'=> date('Y-m-d'));
        $update = $this->Project_Model->updateshop($userInfo,$design_id);
        
        if($update){
            $this->session->set_flashdata('success', 'Po Attached Successfully');
            redirect('Newlaunch/Design');
        }
        
    }
	public function updatetimeline()
    {
		$flag = 5;
                $design_id = $this->input->post('design_id');
				$ptime = $this->input->post('ptime');
				$etime = $this->input->post('etime');
				
				
        
        $userInfo = array('production_timeline'=> date('Y-m-d' , strtotime($ptime)),'execution_timeline'=> date('Y-m-d' , strtotime($etime)),'flag'=> $flag,'add_timline_date'=> date('Y-m-d'));
        $update = $this->Project_Model->updateshop($userInfo,$design_id);
        
        if($update){
            $this->session->set_flashdata('success', 'Timeline Added Successfully');
            redirect('Newlaunch/Design');
        }
        
    }
	public function updaterc()
    {
		$flag = 6;
                $design_id = $this->input->post('design_id');
				$rc = $this->input->post('rc');
				
				
				
        
        $userInfo = array('rc'=> $rc,'flag'=> $flag,'add_rc_date'=> date('Y-m-d'));
        $update = $this->Project_Model->updateshop($userInfo,$design_id);
        
        if($update){
            $this->session->set_flashdata('success', 'RC Added Successfully');
            redirect('Newlaunch/Design');
        }
        
    }
	public function viewDetails($uid,$uid1)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);
		$uid1=str_replace(array('_'), array('/'), $uid1);
        $decrypted_id1 = $this->encrypt->decode($uid1);

                $data['details'] =$this->Project_Model->ViewDetailsdesign($decrypted_id,$decrypted_id1);
				//$data['statusInfo'] =$this->Project_Model->getstatus();
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/view_details',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	public function History($uid)
	{       
        $uid=str_replace(array('_'), array('/'), $uid);
        $decrypted_id = $this->encrypt->decode($uid);

                $data['details'] =$decrypted_id;
                $this->load->view('includes/header.php');
                $this->load->view('includes/left_menu.php');
                $this->load->view('Newlaunch/quotation_history',$data);
                $this->load->view('includes/footer.php',$data['requestInfo']);
            
                
    }
	public function updateapproval()
    {
		$flag = 3;
                $design_id = $this->input->post('design_id');
				$approval = $this->input->post('approval');
				$remarks = $this->input->post('remarks');
				$reject_count = $this->input->post('reject_count');
				$quetations = $this->input->post('quetations');
				$qu_attachments = $this->input->post('qu_attachments');
				//print_r($agency);exit;
        if($approval==2){
        $userInfo = array('bt_remarks'=> $quetations,'approval'=> $approval,'reject_count'=>$reject_count+1,'flag'=>1,'reject_date'=> date('Y-m-d'));
        $update = $this->Project_Model->updateshop($userInfo,$design_id);
		$userInfo = array('remarks'=> $remarks,'qu_attachments'=> $qu_attachments,'revise_quotation'=> $quetations,'design_id'=> $design_id,'revise_date'=> date('Y-m-d'));
        $update = $this->Project_Model->updaterevision($userInfo);
		}
		else{
			$userInfo = array('approval'=> $approval,'flag'=>$flag,'approval_date'=> date('Y-m-d'));
        $update = $this->Project_Model->updateshop($userInfo,$design_id);
		}
        
        if($update){
            $this->session->set_flashdata('success', 'updated Successfully');
            redirect('Newlaunch/Design');
        }
        
    }
	function getDesign(){
        
        $data = $row = array();
        
        // Fetch member's records

        $ProjectData = $this->DesignPagination_Model->getRows($_POST);
        $i = $_POST['start'];
		
        foreach($ProjectData as $request){

            $encrypted_id = $this->encrypt->encode($request->id);
            $encrypted_id=str_replace(array('/'), array('_'), $encrypted_id);
			$encrypted1_id = $this->encrypt->encode($request->design_id);
			$design_id=str_replace(array('/'), array('_'), $encrypted1_id);
			$approve=1;
			$reject=2;
            
            $i++;
			
			//if($request->flag == 4 && $this->session->userdata['rolecode'] == "CIIC"){
				//$comment = "<a href='Project/view_design/{$encrypted_id}' style='color:blue;'><u>View Design</u></a>";
			//}
			if($request->flag == 4 &&  $request->dflag == 0 &&  $request->uploade_again == 1 && $this->session->userdata['rolecode'] == "AgencyPortal"){
				$comment = "<a href='Design/uploadeagain/{$design_id}' style='color:blue;'><u>Revise Design</u></a>";
			}
			elseif($request->flag == 4 &&  $request->dflag == 1 &&  $request->uploade_again == 0 && $this->session->userdata['rolecode'] == "AgencyPortal"){
				$comment = "<a href='Design/add_quetations/{$encrypted_id}/{$design_id}' style='color:blue;'><u>Add Quotation</u></a>";
			}
			elseif($request->flag == 4 && $this->session->userdata['rolecode'] == "BT"){
				$history='';
				$revise='';
				if($request->reject_count>0){
				$history="<a href='Design/History/{$design_id}' style='color:blue;'><u>/History</u></a>";
				}
				if($request->reject_count<4){
				$revise="<a href='Design/approval/{$encrypted_id}/{$design_id}/{$reject}' style='color:blue;'><u>/Revise</u></a>";
				}
				$comment = "<a href='Design/approval/{$encrypted_id}/{$design_id}/{$approve}' style='color:blue;'><u>Approve</u></a>".$revise.$history;
				
			}
			elseif($request->flag == 4 && $request->dflag == 3 && $this->session->userdata['rolecode'] == "VT"){
				$comment = "<a href='Design/attach_po/{$encrypted_id}/{$design_id}' style='color:blue;'><u>Attach PO</u></a>";
				
			}
			elseif($request->approval == 1 && $request->dflag == 4 && $this->session->userdata['rolecode'] == "VT"){
				$comment = "<a href='Design/viewDetails/{$encrypted_id}/{$design_id}' style='color:blue;'><u>View Detail</u></a>";
				
			}
			elseif($request->flag == 4 && $request->dflag == 4 && $request->approval == 1 && $this->session->userdata['rolecode'] == "AgencyPortal"){
				$comment = "<a href='Design/add_timeline/{$encrypted_id}/{$design_id}' style='color:blue;'><u>Add Timeline</u></a>";
				
			}
			elseif($request->dflag == 6 && $request->approval == 1 && $this->session->userdata['rolecode'] == "VT"){
				$comment = "<a href='Design/viewDetails/{$encrypted_id}/{$design_id}' style='color:blue;'><u>View Detail</u></a>";
				
			}
			elseif($request->dflag == 5 && $request->approval == 1 && $this->session->userdata['rolecode'] == "VT"){
				$comment = "<a href='Design/add_rc/{$encrypted_id}/{$design_id}' style='color:blue;'><u>Add RC</u></a>";
				
			}
			
			if($request->dflag==0){
			    $status="<b style='color:orange;'>Send For Revision</b>";
			}
			if($request->dflag==1){
			    $status="<b style='color:orange;'>Quotation Pending</b>";
			}
			if($request->dflag==2){
			    $status="<b style='color:orange;'>Quotation Approval Pending</b>";
			}
			if($request->dflag==3){
			    $status="<b style='color:orange;'>Pending PO</b>";
			}
			if($request->dflag==4){
			    $status="<b style='color:orange;'>Pending TimeLine</b>";
			}
			if($request->dflag==5){
			    $status="<b style='color:red;'>Execution Pending(by Agency)</b>";
			}
			
            $data[] = array(
                            $i, 
							$status,
                            "<b>".$request->code."</b>",
                            $request->launch_name,
                            date("d-m-Y", strtotime($request->created_date)),
                            date("d-m-Y", strtotime($request->timeline)),
                            wordwrap($request->remarks,40,"<br>\n"),
                            $request->name,
                            $request->status_name,
                            $comment
                        ); 
            
           }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->DesignPagination_Model->countAll(),
            "recordsFiltered" => $this->DesignPagination_Model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }
	
}
