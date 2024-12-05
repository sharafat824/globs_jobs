<?php
$CI =& get_instance();
$CI->load->model('Manage_Dashboard_Model');
$CI->load->model('Job_Model');
?>
<div class="breadcrumb-area">
         <h1>Total Jobs</h1>
         <ol class="breadcrumb">
            <li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Home</a></li>
            <li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item">Total Jobs</li>
         </ol>
      </div>
<div class="job-list-area">
    <div class="container">
        <div class="section-title">
             <h2>Total Jobs</h2>
		
        </div>
        <div class="row">
            <?php
            if (count($jobInfo)) :
                foreach ($jobInfo as $row) :
                    $encrypted_id = $this->encrypt->encode($row->id);
                    $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
                    $count_assigned_count = $CI->Manage_Dashboard_Model->getassignedemployeeCount($row->id);
                    $count_applicant_count = $CI->Job_Model->getapplicantDetailsCount($row->id);
                    $count_shortlist_count = $CI->Job_Model->shortlistCount($row->id);
                    ?>
                    <div class="col-lg-4 col-md-6 job-item" 
                        >
                        <div class="single-job-list-box">
                            <div class="job-information">
                                <div class="company-logo">
                                    <a href="#"><img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" alt="image"></a>
                                </div>
                                <h3>
                                    <a href="<?php echo base_url()?>Job/job_details/<?php echo $encrypted_id ?>">
                                        <?php echo htmlentities($row->title) ?>
                                    </a>
                                </h3>
                                <span>
                                    <?php 
                                    if ($row->experience == 1) echo "Fresh"; 
                                    if ($row->experience == 2) echo "One Year Experience"; 
                                    if ($row->experience == 3) echo "Two Years Experience"; 
                                    if ($row->experience == 4) echo "Three Years Experience"; 
                                    ?>
                                </span>
                                <span class="float-right">
                                    <?php if ($row->approve == 1) { ?>
                                        <span class="job-tag-list" style="color:green"><u>Approved</u></span>
                                    <?php } elseif ($row->approve == 0) { ?>
                                        <span class="job-tag-list" style="color:orange"><u>Pending</u></span>
                                    <?php } else { ?>
                                        <span class="job-tag-list" style="color:red"><u>Rejected</u></span>
                                    <?php } ?>
                                </span>
                            </div>
                            <ul class="job-tag-list">
                                <li>
                                    <?php 
                                    if ($row->career == 1) echo "Basic"; 
                                    if ($row->career == 2) echo "Intermediate"; 
                                    if ($row->career == 3) echo "Advance"; 
                                    ?>
                                </li>
                            </ul>
                            <ul class="location-information">
                                <li><i class="ri-map-pin-line"></i><?php echo htmlentities($row->address) ?></li>
                                <li><i class="ri-time-line"></i>
                                    <?php 
                                    if ($row->type == 1) echo "PartTime"; 
                                    if ($row->type == 2) echo "FullTime"; 
                                    if ($row->type == 3) echo "Seasonal"; 
                                    if ($row->type == 4) echo "Temporary"; 
                                    if ($row->type == 5) echo "Leased"; 
                                    ?>
                                </li>
                            </ul>
                            <?php if ($row->approve == 1 && $this->session->userdata('rolecode') == 3) { ?>
                                <div class="job-btn">
                                    <a href="<?php echo base_url()?>Manage_dashboard/getAssignedEmployee/<?php echo $encrypted_id ?>" 
                                       class="default-btn default-btn-0">
                                       Assigned Candidates <?php echo $count_assigned_count; ?>
                                       <i class="flaticon-list-1"></i>
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->userdata('rolecode') == 1 && $row->approve == 1) { ?>
                                <div class="job-btn">
                                    <a href="<?php echo base_url()?>Job/applicant_details/<?php echo $encrypted_id ?>" 
                                       class="default-btn default-btn-0">
                                       View Applicants <?php echo $count_applicant_count; ?>
                                       <i class="flaticon-list-1"></i>
                                    </a>
                                </div>
                                <div class="job-btn">
                                    <a href="<?php echo base_url()?>Job/all_shortlist/<?php echo $encrypted_id ?>" 
                                       class="default-btn default-btn-0">
                                       Shortlist Applicant <?php echo $count_shortlist_count; ?>
                                       <i class="flaticon-list-1"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                endforeach;
            else :
                ?>
                <div class="col-12">
                    <p>No Record found</p>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>

