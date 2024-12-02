<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<style>
	.pagination {
		display: flex;
		flex-wrap: wrap;
		gap: 0.5rem;
		justify-content: center;
		padding: 0;
	}

	.pagination .page-item {
		margin: 0.1rem;
	}

	.pagination .page-item.disabled .page-link {
		background-color: #f0f0f0;
		color: #d1d1d1;
	}

	.pagination .page-item.active .page-link {
		background-color: #007bff;
		border-color: #007bff;
		color: white;
	}

	.pagination .page-item a {
		padding: 0.5rem 1rem;
	}
</style>
<div class="">

	<div class="breadcrumb-area">
		<h1>All Applicants</h1>
		<ol class="breadcrumb">
			<li class="item"><a href="dashboard.html">Home</a></li>
			<li class="item"><a href="dashboard.html">Dashboard</a></li>
			<li class="item">All Applicants</li>
		</ol>
	</div>

	<div class="all-applicants-box">
		<h2>Applicants </h2>
		<br />
		<div class="row">
			<table id="example" class="display respons " style="width:100%">
				<thead>
					<tr>
						<th>ProfilePic</th>
						<th>Name</th>
						<th>Category</th>
						<th>Country</th>
						<th>Phone</th>
						<th>Status</th>
						<th>Register Source</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($applicant)):
						$cnt = 1;
						foreach ($applicant as $row):
							$encrypted_id = $this->encrypt->encode($row->id);
							$encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
					?>
							<tr>
								<td>
									<div class="image">
										<?php $image_url =  'employee_images/' . $row->profile_pic; ?>
										<?php if (file_exists($image_url)) { ?>
											<img src="<?php echo base_url() ?>employee_images/<?php echo htmlentities($row->profile_pic) ?>" height="110" width="80" alt="image">
										<?php } else { ?>
											<img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" height="110" width="80" class="rounded-circle" alt="image">
										<?php } ?>
									</div>
								</td>
								<td>
									<?php echo htmlentities($row->first_name) ?>
								</td>
								<td>
									<?php echo htmlentities($row->category_name) ?>
								</td>
								<td>
									<?php echo htmlentities($row->cocountry_name) ?>
								</td>
								<td>
									<?php echo htmlentities($row->phone) ?>
								</td>
								<td>
									<?php if ($row->status == 1) { ?>
										<b style="color:green;">Approved</b>
									<?php } ?>
									<?php if ($row->status == 2) { ?>
										<b style="color:red;">Rejected</b>
									<?php } ?>
									<?php if ($row->status == 0) { ?>
										<b style="color:orange;">Pending</b>
									<?php } ?>
								</td>
								<td>
									<?php if ($row->user_source == 1) { ?>
										<b style="color:green;">Aegseagles</b>
									<?php } ?>
									<?php if ($row->user_source == 2) { ?>
										<b style="color:green;">MobileApp</b>
									<?php } ?>
									<?php if ($row->user_source == 0) { ?>
										<b style="color:green;">JobsGlob</b>
									<?php } ?>
								</td>
								<td>
									<?php echo anchor("Manage_applicant/getapllicant/{$encrypted_id}", '<button class="option-btn  border-0  rounded d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="View Aplication" ><i class="ri-eye-line mt-2"></i></button>') ?>

									<?php if ($row->status == 0 || $row->status == 2) { ?>
										<?php echo anchor("Manage_applicant/approvedapplicant/{$encrypted_id}", '<button class="option-btn border-0  rounded d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve Aplication" type="button"><i class="ri-check-line"></i></button>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog1();")) ?>
									<?php } ?>
									<?php if ($row->status == 0) { ?>
										<?php echo anchor("Manage_applicant/rejectapplicant/{$encrypted_id}", '<button class="option-btn border-0  rounded d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject Aplication" type="button"><i class="ri-close-line"></i></button>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog2();")) ?>
									<?php } ?>
									<?php echo anchor("Manage_applicant/deleteapplicant/{$encrypted_id}", '<button class="option-btn border-0  rounded d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Aplication" type="button"><i class="ri-delete-bin-line"></i></button>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog3();")) ?>
								</td>

							</tr>

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
			</table>
			<?php echo $pagination_links; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"paging": false, // Enable pagination
			"lengthChange": true, // Allow changing the number of entries per page
			"searching": true, // Enable search functionality
			"ordering": true, // Enable column ordering
			"info": false, // Show info about the table
			"autoWidth": false // Disable auto-width calculation for columns
		});
	});
</script>