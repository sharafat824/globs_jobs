<div class="">
    <div class="breadcrumb-area">
        <h1><?php if ($this->session->userdata('rolecode') == 1) {
    echo "Admin";
} elseif ($this->session->userdata('rolecode') == 2) {
    echo "Candidate";
} elseif ($this->session->userdata('rolecode') == 3) {
    echo "Company";
}
?></h1>
        <ol class="breadcrumb">
            
            <li class="item">Dashboard</li>
        </ol>
    </div>

    <div class="dashboard-fun-fact-area">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/jobs?status=all">
                        <div class="icon-box">
                            <i class="ri-briefcase-line"></i>
                        </div>
                        <span class="sub-title">Total Posted Jobs</span>
                        <h3><?php echo $total_job; ?></h3>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/jobs?status=approved">
                        <div class="icon-box">
                            <i class="ri-file-list-line"></i>
                        </div>
                        <span class="sub-title">Approved Job</span>
                        <h3><?php echo $approved_job; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/jobs?status=pending">
                        <div class="icon-box">
                            <i class="ri-file-list-line"></i>
                        </div>
                        <span class="sub-title">Pending Job</span>
                        <h3><?php echo $pendingjob; ?></h3>
                    </a>
                </div>
            </div>
            <!--<div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stats-fun-fact-box">
               <div class="icon-box">
                  <i class="ri-chat-2-line"></i>
               </div>
               <span class="sub-title">Assigned Candidate</span>
               <h3><?php echo $Assignedjob; ?></h3>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stats-fun-fact-box">
               <div class="icon-box">
                  <i class="ri-bookmark-line"></i>
               </div>
               <span class="sub-title">Shortlist Candidate</span>
                <h3><?php echo $Shortlistjob; ?></h3>
            </div>
         </div>-->
        </div>
    </div>




</div>