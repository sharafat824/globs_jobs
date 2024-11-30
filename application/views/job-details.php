<?php
if (isset($jobInfo) != NULL) {
	
$title = $jobInfo->title;
$address = $jobInfo->address;
$experience = $jobInfo->experience;
$career = $jobInfo->career;
$type = $jobInfo->type;
$description = $jobInfo->description;
$category_name = $jobInfo->category_name;
$country_name = $jobInfo->country_name;
$city_name = $jobInfo->city_name;
$approve_status = $jobInfo->approve;
$job_id = $jobInfo->id;
$encrypted_id = $this->encrypt->encode($jobInfo->id);
$encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);


} 
?>


		<div class="breadcrumb-area">
<h1>Job Details </h1>
<ol class="breadcrumb">
<li class="item"><a href="dashboard.html">Home</a></li>
<li class="item"><a href="dashboard.html">Dashboard</a></li>
<li class="item">Job Details </li>
</ol>
</div>


			<div class="job-details-area ptb-100">
			<div class="container">
			<div class="row">
			<div class="col-lg-8 col-md-12">
			<div class="job-details-desc">
			<h3>Address</h3>
			<ul class="list">
			<li><?php echo '************'.substr($address, -8); ?></li>
			</ul>



			<div class="job-details-content">
			<h3>About Job</h3>
			<ul class="list">
			<li><?php echo $description; ?></li>
			</ul>
			</div>

			</div>

			</div>
			<div class="col-lg-4 col-md-12">
			<div class="job-details-sticky">
			<div class="job-details-information">
			<div class="information-box">
			<!--<div class="company-logo">
			<img src="assets/images/job/job-1.png" alt="image">
			</div>-->
			<h3><?php echo $title; ?></h3>
			 
			</div>
			<ul class="information-list-box">
			<li>
			<div class="d-flex justify-content-between align-items-center">
			<span><i class="flaticon-layers"></i> Experience</span>
			<?php if($experience==1) {
										 echo "Fresh"; 
									}
									if($experience==2){
										echo "OneYear Experience";
									}
									if($experience==3){
									   echo "TwoYear Experience";
									}
									if($experience==4){
										echo "ThreeYear Experience";
									 }
									?>
			</div>
			</li>
			<li>
			<div class="d-flex justify-content-between align-items-center">
			<span><i class="flaticon-volume"></i> Career Level</span>
			<?php if($career==1) {
										
										 echo "Basic"; 
									}
									if($career==2){
										echo "Intermediate";
									}
									if($career==3){
									   echo "Advance";
									}
									?>
			</div>
			</li>
			<li>
			<div class="d-flex justify-content-between align-items-center">
			<span><i class="ri-time-line"></i> Time</span>
			<?php if($type==1) {
										
										 echo "PartTime"; 
									}
									elseif($type==2){
										echo "FullTime";
									}
									if($type==3){
										echo "Seasonal";
									}if($type==4){
										echo "Temporary";
									}if($type==5){
										echo "Leased";
									}
									
									?>
			</div>
			</li>
			<li>
			<div class="d-flex justify-content-between align-items-center">
			<span><i class="flaticon-location"></i> Country</span>
			<?php echo $country_name; ?>
			</div>
			<div class="d-flex justify-content-between align-items-center">
			<span><i class="flaticon-location"></i> City</span>
			<?php echo $city_name; ?>
			</div>
			</li>
			<li>
			<div class="d-flex justify-content-between align-items-center">
			<span><i class="flaticon-volume"></i> Category</span>
			<?php echo $category_name; ?>
			</div>
			<div class="d-flex justify-content-between align-items-center">

			<?php if ($this->session->userdata['rolecode'] == 2) {?>
				
                            <?php 
									$CI =& get_instance();
									$count = $CI->Manage_Dashboard_Model->getuserjobs($job_id);
                                    $statusDetails = $CI->Manage_Dashboard_Model->getStatus();
                                    if($statusDetails->status == 1 ){
										
									if($count->count < 1){
								?>
										<div class="job-btn mt-5">
											<div class="job-list-optional">
												<a href="<?php echo base_url(); ?>Job/apply_job/<?php echo $encrypted_id; ?>"
													class="default-btn"> Apply Jobs <i class="flaticon-list-1"></i></a>
												<div class="save-text">

												</div>
											</div>
										</div>
										<?php }else{?>
											<?php if ($count->short_list == 11) {
													echo '<div class="job-btn mt-5 default-btn">Assigned</div>';
												}if ($count->short_list == 1) {
													echo '<div class="job-btn mt-5 default-btn">Short Listed</div>';
												}
											?></li>
										<?php } ?>
								<?php } ?>
							<?php } ?>

			<?php if ($this->session->userdata('rolecode') == 1 && $approve_status==0) { ?>
				<div class="job-btn mt-5">
					<a href="<?php echo base_url() ?>Job/approvedjob/<?php echo $encrypted_id ?>" class="default-btn">Approve Job <i class="flaticon-list-1"></i></a>
				</div>
			<?php } ?> 
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>


