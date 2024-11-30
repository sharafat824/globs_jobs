<?php
$CI =& get_instance();
$CI->load->model('Manage_Dashboard_Model');
$CI->load->model('Job_Model');
?>
<div class="">
   
   
   
   <div class="job-list-area">
         <div class="container">
            <div class="section-title">
               <h2>Approved Jobs</h2>
               
            </div>
            <div class="row">
			
				<?php
				if (count($jobInfo)) :
					$cnt = 1;
					foreach ($jobInfo as $row) :
						$encrypted_id = $this->encrypt->encode($row->id);
						$encrypted_id=str_replace(array('/'), array('_'), $encrypted_id);
						$count_assigned_count = 0;
						$count_assigned_count = $CI->Manage_Dashboard_Model->getassignedemployeeCount($row->id);
						$count_applicant_count = 0;
						$count_applicant_count = $CI->Job_Model->getapplicantDetailsCount($row->id);
						$count_shortlist_count = 0;
						$count_shortlist_count = $CI->Job_Model->shortlistCount($row->id);
						?>   
						<tr>
						
               <div class="col-lg-4 col-md-6">
                  <div class="single-job-list-box">
                     <div class="job-information">
                        <div class="company-logo">
                           <a href=""><img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" alt="image"></a>
                        </div>
                        <h3>
                           <a href="<?php echo base_url()?>Job/job_details/<?php echo $encrypted_id ?>"><td><?php echo htmlentities($row->title) ?></td></a>
                        </h3>
                        <span><td><?php 
						if($row->experience==1) {
							echo "Fresh"; 
					   }
					   if($row->experience==2){
						   echo "OneYear Experience";
					   }
					   if($row->experience==3){
						  echo "TwoYear Experience";
					   }
					   if($row->experience==4){
						   echo "ThreeYear Experience";
						}
						?></td></span>
                        
                        
                     </div>
                     <ul class="job-tag-list">	
                        <td><li><?php if($row->career==1) {
							
							 echo "Basic"; 
						}
						if($row->career==2){
							echo "Intermediate";
						}
						if($row->career==3){
						   echo "Advance";
						}
						?></li></td>
						
                     </ul>
                     <ul class="location-information">
                        <li><i class="ri-map-pin-line"></i><?php echo htmlentities($row->address) ?></td></li>
                        <li><i class="ri-time-line"></i> 
						<td><?php if($row->type==1) {
							
							 echo "PartTime"; 
						}
						if($row->type==2){
							echo "FullTime";
						}
						if($row->type==3){
							echo "Seasonal";
						}if($row->type==4){
							echo "Temporary";
						}if($row->type==5){
							echo "Leased";
						}
						
						?></td></li>
                     </ul>
					 
                     <!--<div class="job-btn">-->
                     <!--   <a href="<?php echo base_url()?>Job/applicant_details/<?php echo $encrypted_id ?>" class="default-btn">View Applicant<i class="flaticon-list-1"></i></a>-->
                     <!--</div>-->
                     
                     <?php if ($this->session->userdata('rolecode') == 3) { ?>
                     <div class="job-btn">
                        <a href="<?php echo base_url()?>Manage_dashboard/getAssignedEmployee/<?php echo $encrypted_id ?>" class="default-btn">Assigned Candidates  <?php echo $count_assigned_count; ?><i class="flaticon-list-1"></i></a>
                     </div>
                     <?php } ?>
                     
					 <?php if ($this->session->userdata('rolecode') == 1) { ?>
					 <div class="job-btn">
                        <a href="<?php echo base_url()?>Job/all_shortlist/<?php echo $encrypted_id ?>" class="default-btn">Shortlist Applicant <?php echo $count_shortlist_count; ?><i class="flaticon-list-1"></i></a>
                     </div>
					 <?php } ?>
                  </div>
               </div>
               
               <tr>
			 <?php
						$cnt++;
					endforeach;
				else :
					?>

					<tr>
						<td colspan="6">No Record found</td>
					</tr>
				<?php
				endif;
				?>   
               
               
               
               
            </div>
         </div>
      </div>
   
  </div> 