
<div class="">

<div class="breadcrumb-area">
<h1>All Companies</h1>
<ol class="breadcrumb">
<li class="item"><a href="dashboard.html">Home</a></li>
<li class="item"><a href="dashboard.html">Dashboard</a></li>
<li class="item">All Companies</li>
</ol>
</div>


<div class="all-applicants-box">
<h2>Companies</h2>
<div class="row">
<tbody>
<?php
if (count($company)):
    $cnt = 1;
    foreach ($company as $row):
        $encrypted_id = $this->encrypt->encode($row->id);
        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
        ?>
					<tr>


					<div class="col-lg-6 col-md-12">
					<div class="single-applicants-card">
					<div class="image">
					<a href="">
						<?php $image_url =  'employeereg_images/'.$row->company_logo; ?>
						<?php if(file_exists($image_url)){ ?>
							<img src="<?php echo base_url() ?>employee_images/<?php echo htmlentities($row->company_logo) ?>" alt="image">
						<?php }else{ ?>
							<img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image">
						<?php } ?>
					</a>
					</div>
					<div class="content">
					<h3>
					<a href=""><td><?php echo htmlentities($row->company_name) ?></td></a>
					</h3>
					<!--<span>IT Specialist</span>-->
					<ul class="job-info">
					<li><i class="ri-map-pin-line"></i> <?php echo htmlentities($row->ccity_name) ?></li>
					<!--<li><i class="ri-time-line"></i> Part Time</li>-->
					<li></i>
					<?php if ($row->status == 1) {?>
						<b style="color:green;" >Approved</b>
					<?php }?>
					<?php if ($row->status == 2) {?>
						<b style="color:red;" >Rejected</b>
					<?php }?>
					<?php if ($row->status == 0) {?>
						<b style="color:orange;" >Pending</b>
					<?php }?>
					</li>

					<li>
						<?php if ($row->user_source == 1) {?>
							<b style="color:green;" >RegisterThrough: Aegseagles</b>
						<?php }?>
						<?php if ($row->user_source == 2) {?>
							<b style="color:green;" >RegisterThrough: MobileApp</b>
						<?php }?>
						<?php if ($row->user_source == 0) {?>
							<b style="color:green;" >RegisterThrough: JobsGlob</b>
						<?php }?>
					</li>

					</ul>
					<div class="applicants-footer">
					<ul class="option-list">
					<td><?php echo anchor("Company/getcompanydetail/{$row->id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Company Detail" ><i class="ri-eye-line"></i></button></li>') ?></td>
					<?php if ($row->status == 1) {?>
					<td>
						<?php echo anchor("Job/approved_jobs/{$row->id}", "<li><button class='option-btn d-inline-block' data-bs-toggle='tooltip' data-bs-placement='top' title='' ><span>{$row->job_count}</span></button></li>") ?>
					</td>
					<?php } ?>
					<?php if ($row->status == 0 || $row->status == 2) {?>
					<td><?php echo anchor("Company/approvedcompany/{$encrypted_id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve Aplication" type="button"><i class="ri-check-line"></i></button></li>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog1();")) ?></td>
					<?php }?>
					<?php if ($row->status == 0) {?>
					<td><?php echo anchor("Company/rejectcompany/{$encrypted_id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject Aplication" type="button"><i class="ri-close-line"></i></button></li>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog2();")) ?></td>
					<?php }?>
					<td><?php echo anchor("Company/deletecompany/{$encrypted_id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Aplication" type="button"><i class="ri-delete-bin-line"></i></button></li> ', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog3();")) ?></td>
					</ul>
					</div>
					</div>
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
			</tbody>
</div>
</div>
</div>

