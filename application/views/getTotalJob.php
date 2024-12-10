<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>


<!-- Select2 JS -->
<script src="<?php echo base_url('assets/js/select2.min.js'); ?>" defer></script>
<style>
    .select2-container--default .select2-selection--single {
        height: 39px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 5px 10px !important;
    }
    .select2-container {
    width: 15rem !important; 
}
</style>

<?php
$CI = &get_instance();
$CI->load->model('Manage_Dashboard_Model');
$CI->load->model('Job_Model');
?>
<div class="breadcrumb-area">
    <h1><?php
        echo  ucfirst($status)
        ?> Jobs</h1>
    <ol class="breadcrumb">

        <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
        <li class="item"><?php
                            echo  ucfirst($status)

                            ?> Jobs</li>
    </ol>
</div>
<div class="job-list-area">
    <div class="container">
        <div class="section-title">
            <h2><?php
                echo  ucfirst($status)

                ?> Jobs</h2>
        </div>
        <div class="d-flex justify-content-center">
            <div class="mb-5">
                <form action="<?php echo base_url(); ?>/Manage_dashboard/jobs" method="GET" class="">
                    <div class="form-group input-group">
                        <!-- <input type="text" id="date_range" name="date_range" class="form-control"
								value="<?php echo $this->input->get('date_range'); ?>"
								required placeholder="Select date range"> -->
                        <input type="hidden" name="status" value="<?php echo $status  ?>">
                        <div class="d-flex justify-content-center gap-2 flex-column flex-md-row text-center align-items-center ">
                            <input type="search" style="height: 40px;width:15rem;border:1px solid #ababab;background:transparent" class="form-control mb-2 mb-md-0" name="search" placeholder="Search...">
                            <div class="d-flex gap-2 flex-column flex-md-row  ">
                            <select id="country" name="country" class="form-control  ">
                                <option value="">All Countries</option>
                            </select>
                            <select id="town" name="city" class="form-control ">
                                <option value="">All Cities</option>
                            </select></div>
                            <div>
                                <button type="submit" class="default-btn mb-2 mb-md-0" style=" padding: 8px 54px 8px 20px !important;">
                                    <i class="bi bi-search"></i>Search
                                </button></div>
                            </div>
                    </div>
                </form>
            </div>
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

                    <div class="col-lg-4 col-md-6 job-item">
                        <div class="single-job-list-box">
                            <?php
                            if ($this->session->userdata('rolecode') == 3) { ?>
                                <div class="d-flex justify-content-end gap-2 mb-2">
                                    <a href="<?php echo base_url(); ?>/Job/edit_job?id=<?php echo $encrypted_id ?>" class="btn btn-sm default-btn "><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-sm default-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                        onclick="setDeleteAction('<?= base_url("Job/delete_job/" .  $encrypted_id) ?>')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            <?php }
                            ?>

                            <div class="job-information">
                                <div class="company-logo">
                                    <a href="#"><img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" alt="image"></a>
                                </div>
                                <h3>
                                    <a href="<?php echo base_url() ?>Job/job_details/<?php echo $encrypted_id ?>">
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
                                    <a href="<?php echo base_url() ?>Manage_dashboard/getAssignedEmployee/<?php echo $encrypted_id ?>"
                                        class="default-btn default-btn-0">
                                        Assigned Candidates <?php echo $count_assigned_count; ?>
                                        <i class="flaticon-list-1"></i>
                                    </a>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->userdata('rolecode') == 1 && $row->approve == 1) { ?>
                                <div class="job-btn">
                                    <a href="<?php echo base_url() ?>Job/applicant_details/<?php echo $encrypted_id ?>"
                                        class="default-btn default-btn-0">
                                        View Applicants <?php echo $count_applicant_count; ?>
                                        <i class="flaticon-list-1"></i>
                                    </a>
                                </div>
                                <div class="job-btn">
                                    <a href="<?php echo base_url() ?>Job/all_shortlist/<?php echo $encrypted_id ?>"
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
                <tr>
                    <td colspan="6" class="text-center no-record">
                        <div class="container text-center p-5">
                            <i class="bi bi-info-circle" style="font-size: 1.5rem; color: #6c757d;"></i>
                            <p class="mt-2" style="font-size: 1rem; color: #6c757d;">No Records Found</p>
                        </div>
                    </td>
                </tr>
            <?php
            endif;
            ?>
            <?php
            echo $pagination_links;
            ?>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this job? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmDeleteButton" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to set the delete action
    function setDeleteAction(deleteUrl) {
        document.getElementById('confirmDeleteButton').setAttribute('href', deleteUrl);
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#country').select2({
            placeholder: 'Select Country',
            allowClear: true,
            width: '20rem'
        });
        $('#town').select2({
            placeholder: 'Select City',
            allowClear: true,
            width: '20rem'
        });
    });
</script>
