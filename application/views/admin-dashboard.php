<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" defer></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
<div class="">
    <div class="breadcrumb-area">
        <h1>Welcome!</h1>
        <ol class="breadcrumb">

            <li class="item">Dashboard</li>
        </ol>
    </div>

    <div class="mb-4">
        <form action="<?php echo base_url(); ?>/Manage_dashboard/Home" method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="form-group input-group">
                    <input type="text" id="date_range" name="date_range" class="form-control"
                        value="<?php echo $this->input->get('date_range'); ?>"
                        required placeholder="Select date range">
                    <button type="submit" class="btn btn-warning text-white input-group-text">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>

    <div class="dashboard-fun-fact-area">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/jobs?status=all">
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
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/jobs?status=approved">
                        <div class="icon-box">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span class="sub-title">Approved Job</span>
                        <h3><?php echo $approved_job; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Company/company?status=all">
                        <div class="icon-box">
                            <i class="ri-briefcase-line"></i>
                        </div>
                        <span class="sub-title">Total Employers</span>
                        <h3><?php echo $totalemployer; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Company/company?status=pending">
                        <div class="icon-box">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <span class="sub-title">Pending Employers</span>
                        <h3><?php echo $pendingemployer; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Company/company?status=approved">
                        <div class="icon-box">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span class="sub-title">Approved Employers</span>
                        <h3><?php echo $approvedemployer; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/employee?status=total">
                        <div class="icon-box">
                            <i class="ri-briefcase-line"></i>
                        </div>
                        <span class="sub-title">Total Employee</span>
                        <h3><?php echo $total_employee; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/employee?status=pending">
                        <div class="icon-box">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <span class="sub-title">Pending Employee</span>
                        <h3><?php echo $pending_employee; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/employee?status=approved">
                        <div class="icon-box">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <span class="sub-title">Approved Employee</span>
                        <h3><?php echo $approved_employee; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/getShortListedEmployee">
                        <div class="icon-box">
                            <i class="bi bi-list"></i>
                        </div>
                        <span class="sub-title">ShortListed Employee</span>
                        <h3><?php echo $Shortlistjob; ?></h3>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="stats-fun-fact-box">
                    <a href="<?php echo base_url(); ?>/Manage_dashboard/getAssignedEmployee">
                        <div class="icon-box">
                            <i class="bi bi-person-fill-add"></i>
                        </div>
                        <span class="sub-title">Assigned Employee</span>
                        <h3><?php echo $Assignedjob; ?></h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        // Initialize the Date Range Picker
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                format: 'YYYY-MM-DD' // Format of the date range
            }
        });

        // Update the input when a range is selected
        $('#date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        // Clear the input when canceled
        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>