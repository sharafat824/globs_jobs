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
</style>
<div class="">
	<div class="breadcrumb-area">
		<h1><?php echo $status ?> Companies</h1>
		<ol class="breadcrumb">

			<li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
			<li class="item"><?php echo $status ?> Companies</li>
		</ol>
	</div>

	<div class="all-applicants-box">
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<h2>Companies</h2>
			</div>
			<div>
				<form action="<?php echo base_url(); ?>/Company/company" method="GET" class="row g-3">
					<div class="form-group input-group">
						<!-- <input type="text" id="date_range" name="date_range" class="form-control"
								value="<?php echo $this->input->get('date_range'); ?>"
								required placeholder="Select date range"> -->
						<input type="hidden" name="status" value="<?php echo $status  ?>">
						<div class="d-flex">
						<select id="country" name="country" class="form-control">
							<option value="">All Countries</option>
						</select>
						<select id="town" name="city" class="form-control">
							<option value="">All Cities</option>
						</select>
						</div>
						
						<button type="submit" class="btn btn-warning text-white input-group-text">
							<i class="bi bi-search"></i>Search
						</button>
					</div>
				</form>
			</div>
			<div>
				<a href="<?php echo base_url() . 'Company/CreateCompanyAdmin' ?>" class="default-btn default-btn-0"><i class="bi bi-plus"></i>Add</a>
			</div>
		</div>
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
											<?php $image_url =  'employee_images/' . $row->company_logo; ?>
											<?php if (file_exists($image_url)) { ?>
												<img src="<?php echo base_url() ?>employee_images/<?php echo htmlentities($row->company_logo) ?>" alt="image">
											<?php } else { ?>
												<img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image">
											<?php } ?>
										</a>
									</div>
									<div class="content">
										<h3>
											<a href="">
												<td><?php echo htmlentities($row->company_name) ?></td>
											</a>
										</h3>
										<!--<span>IT Specialist</span>-->
										<ul class="job-info">
											<li><i class="ri-map-pin-line"></i> <?php echo htmlentities($row->ccity_name) ?></li>
											<!--<li><i class="ri-time-line"></i> Part Time</li>-->
											<li></i>
												<?php if ($row->status == 1) { ?>
													<b style="color:green;">Approved</b>
												<?php } ?>
												<?php if ($row->status == 2) { ?>
													<b style="color:red;">Rejected</b>
												<?php } ?>
												<?php if ($row->status == 0) { ?>
													<b style="color:orange;">Pending</b>
												<?php } ?>
											</li>

											<li>
												<?php if ($row->user_source == 1) { ?>
													<b style="color:green;">RegisterThrough: Aegseagles</b>
												<?php } ?>
												<?php if ($row->user_source == 2) { ?>
													<b style="color:green;">RegisterThrough: MobileApp</b>
												<?php } ?>
												<?php if ($row->user_source == 0) { ?>
													<b style="color:green;">RegisterThrough: JobsGlob</b>
												<?php } ?>
											</li>

										</ul>
										<div class="applicants-footer">
											<ul class="option-list">
												<td><?php echo anchor("Company/editCompanyAdmin/{$row->id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Company Detail" ><i class="ri-edit-box-line"></i></button></li>') ?></td>
												<td><?php echo anchor("Company/getcompanydetail/{$row->id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Company Detail" ><i class="ri-eye-line"></i></button></li>') ?></td>
												<?php if ($row->status == 1) { ?>
													<td>
														<?php echo anchor("Job/approved_jobs/{$row->id}", "<li><button class='option-btn d-inline-block' data-bs-toggle='tooltip' data-bs-placement='top' title='' ><span>{$row->job_count}</span></button></li>") ?>
													</td>
												<?php } ?>
												<?php if ($row->status == 0 || $row->status == 2) { ?>
													<td><?php echo anchor("Company/approvedcompany/{$encrypted_id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve Aplication" type="button"><i class="ri-check-line"></i></button></li>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog1();")) ?></td>
												<?php } ?>
												<?php if ($row->status == 0) { ?>
													<td><?php echo anchor("Company/rejectcompany/{$encrypted_id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject Aplication" type="button"><i class="ri-close-line"></i></button></li>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog2();")) ?></td>
												<?php } ?>
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
			</tbody>
			<?php echo $pagination_links; ?>
		</div>
	</div>
</div>

<script type="text/javascript">
  
    $(document).ready(function() {
        $('#country').select2({
            placeholder: 'Select Country',
            allowClear: true,
            width: '15rem'
        });
        $('#town').select2({
            placeholder: 'Select City',
            allowClear: true,
           width: '15rem'
        });
    });
</script>