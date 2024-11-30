<div class="">
    <div class="breadcrumb-area">
        <h1>Welcome!</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="dashboard.html">Home</a></li>
            <li class="item">Dashboard</li>
        </ol>
    </div>
    <div class="dashboard-fun-fact-area">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/getAvailableJobs">
                        <div class="icon-box">
                            <i class="ri-briefcase-line"></i>
                        </div>
                        <span class="sub-title">Available Job</span>
                        <h3><?php echo $approved_job; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url() ?>Candidate/applied_jobs">
                        <div class="icon-box">
                            <i class="ri-file-list-line"></i>
                        </div>
                        <span class="sub-title">Applied Jobs</span>
                        <h3><?php echo $appliedjob; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/getShortListedJobs">
                        <div class="icon-box">
                            <i class="ri-chat-2-line"></i>
                        </div>
                        <span class="sub-title">Short Listed Job</span>
                        <h3><?php echo $Shortlistjob; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/getAssignedJobs">
                        <div class="icon-box">
                            <i class="ri-bookmark-line"></i>
                        </div>
                        <span class="sub-title">Assigned Jobs</span>
                        <h3><?php echo $Assignedjob; ?></h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="job-list-area">
        <div class="container">
            <div class="section-title">
                <h2>Available Jobs</h2>

            </div>
            <div class="row">

                <?php
if (count($jobInfo)):
    $cnt = 1;
    foreach ($jobInfo as $row):
        $encrypted_id = $this->encrypt->encode($row->id);
        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
        ?>
                <tr>

                    <div class="col-lg-4 col-md-6">
                        <div class="single-job-list-box">
                            <div class="job-information">
                                <div class="company-logo">
                                    <a href=""><img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>"
                                            alt="image"></a>
                                </div>
                                <h3>
                                    <a href="<?php echo base_url() ?>Job/job_details/<?php echo $encrypted_id ?>">
                                        <td><?php echo htmlentities($row->title) ?></td>
                                    </a>
                                </h3>
                                <span>
                                    <td><?php if ($row->experience == 1) {
            echo "OneYear Experience";
        }
        if ($row->experience == 2) {
            echo "TwoYear Experience";
        }
        if ($row->experience == 3) {
            echo "ThreeYear Experience";
        }
        ?></td>
                                </span>


                            </div>
                            <ul class="job-tag-list">
                                <td>
                                    <li><?php if ($row->career == 1) {

            echo Basic;
        }
        if ($row->career == 2) {
            echo Intermediate;
        }
        if ($row->career == 3) {
            echo Advance;
        }
        ?></li>
                                </td>

                            </ul>
                            <?php
                                $complete_address = "";
                                $addess = explode(',',$row->address);
                                if(count($addess)>1){
                                    $complete_address = $addess[1]." ".$addess[2];
                                }
                                if(count($addess)>2){
                                    $complete_address = $addess[2]." ".$addess[3];
                                }
                            ?>
                            <ul class="location-information">
                            <?php if($complete_address!=""){?>
                                <li><i class="ri-map-pin-line"></i><?php echo htmlentities($complete_address) ?></td>
                                </li>
                            <?php } ?>
                                <li><i class="ri-time-line"></i><?php echo $row->job_price; ?></li>
                                <li>
                                    <?php if ($row->type == 1) {

                                        echo htmlentities("PartTime");
                                    }
                                    if ($row->type == 2) {
                                        echo ("FullTime");
                                    }
                                    ?>
                              </li>
                            </ul><br>
                            <?php if ($this->session->userdata['rolecode'] == 2) {?>
                            <?php 
									$CI =& get_instance();
									$count = $CI->Manage_Dashboard_Model->getuserjobs($row->id);
                                    $statusDetails = $CI->Manage_Dashboard_Model->getStatus();
                                    if($statusDetails->status == 1){
									if($count->count < 1){
								?>
                            <div class="col-lg-3">
                                <div class="job-list-optional">
                                    <a href="<?php echo base_url(); ?>Job/apply_job/<?php echo $encrypted_id; ?>"
                                        class="default-btn"> Apply Jobs <i class="flaticon-list-1"></i></a>
                                    <div class="save-text">

                                    </div>
                                </div>
                            </div>
                            <?php }
										   else{?>
                            <ul class="job-tag-list">
                                <td>
                                    <li><?php if ($count->short_list == 11) {
												echo 'Assigned';
											}
											if ($count->short_list == 1) {
												echo 'Short Listed';
											}
											?></li>
                                </td>

                            </ul>
                            <?php }?>
                            <?php }?>
                            <?php }?>
                            <?php if ($this->session->userdata['rolecode'] != 2) {?>
                            <div class="job-btn">
                                <a href="<?php echo base_url() ?>Job/applicant_details/<?php echo $encrypted_id ?>"
                                    class="default-btn">View Applicant<i class="flaticon-list-1"></i></a>
                            </div>
                            <div class="job-btn">
                                <a href="<?php echo base_url() ?>Job/all_shortlist/<?php echo $encrypted_id ?>"
                                    class="default-btn">Shortlist Applicant<i class="flaticon-list-1"></i></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                <tr>
                    <?php
        $cnt++;
    endforeach;
else:
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