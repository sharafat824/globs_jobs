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
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/getTotalJob" >
                        <div class="icon-box">
                            <i class="ri-briefcase-line"></i>
                        </div>
                        <span class="sub-title">Total Posted Jobs</span>
                        <h3><?php echo $total_job; ?></h3>
                    </a>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Job/approved_jobs">
                        <div class="icon-box">
                            <i class="ri-file-list-line"></i>
                        </div>
                        <span class="sub-title">Approved Job</span>
                        <h3><?php echo $approved_job; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a  href="<?php echo base_url(); ?>/Company/allcompany">
                        <div class="icon-box">
                            <i class="ri-chat-2-line"></i>
                        </div>
                        <span class="sub-title">Total Employers</span>
                        <h3><?php echo $totalemployer; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a  href="<?php echo base_url(); ?>/Manage_dashboard/getTotalEmployee">
                        <div class="icon-box">
                            <i class="ri-chat-2-line"></i>
                        </div>
                        <span class="sub-title">Total Employee</span>
                        <h3><?php echo $total_employee; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                <a  href="<?php echo base_url(); ?>/Manage_dashboard/getApprovedEmployee">
                        <div class="icon-box">
                            <i class="ri-bookmark-line"></i>
                        </div>
                        <span class="sub-title">Approved Employee</span>
                        <h3><?php echo $approved_employee; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                <a  href="<?php echo base_url(); ?>/Manage_dashboard/getShortListedEmployee">
                        <div class="icon-box">
                            <i class="ri-bookmark-line"></i>
                        </div>
                        <span class="sub-title">ShortListed Employee</span>
                        <h3><?php echo $Shortlistjob; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                <a  href="<?php echo base_url(); ?>/Manage_dashboard/getAssignedEmployee">
                        <div class="icon-box">
                            <i class="ri-bookmark-line"></i>
                        </div>
                        <span class="sub-title">Assigned Employee</span>
                        <h3><?php echo $Assignedjob; ?></h3>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>