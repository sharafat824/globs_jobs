<div class="">

	<div class="breadcrumb-area">
		<h1>Total Employee</h1>
		<ol class="breadcrumb">
			<li class="item"><a href="dashboard.html">Home</a></li>
			<li class="item"><a href="dashboard.html">Dashboard</a></li>
			<li class="item">Total Employee</li>
		</ol>
	</div>


	<div class="all-applicants-box">
		<div class="d-flex justify-content-between align-items-center">
			<div>
			<h2>Total Employee</h2>
			</div>
			<div>
			<a href="<?php echo base_url() .'Candidate/create_employ_user' ?>" class="default-btn"><i class="bi bi-plus"></i>Add</a>
			</div>
		</div>
		<div class="row">
			<tbody>
				<?php
				if (count($jobInfo)):
					$cnt = 1;
					foreach ($jobInfo as $row):
						$encrypted_id2 = $this->encrypt->encode($row->id);
						$encrypted_id2 = str_replace(array('/'), array('_'), $encrypted_id2);
				?>
						<tr>

							<div class="col-lg-6 col-md-12">
								<div class="single-applicants-card">
									<div class="image">
										<a href=""><img
												src="<?php echo base_url() ?>employee_images/<?php echo htmlentities($row->profile_pic) ?>"
												alt="image"></a>
									</div>
									<div class="content">
										<h3>
											<a href="">
												<td><?php echo htmlentities($row->first_name); ?></td>
											</a>
										</h3>
										<span><?php echo htmlentities($row->email); ?></span>
										<ul class="job-info">
											<li><i class="flaticon-telephone"></i><?php echo htmlentities($row->phone); ?></li>
											<li><i class="flaticon-calendar"></i><?php echo htmlentities($row->birth_date); ?></li>
											<li><i class="flaticon-user"></i><?php if ($row->gender == 1) {
																					echo "Male";
																				}
																				if ($row->gender == 2) {
																					echo "Female";
																				} ?></li>
										</ul>
										<ul class="job-info">
											<li><i class="flaticon-location"></i><?php echo htmlentities($row->address); ?></li>
										</ul>
										<div class="applicants-footer">
											<ul class="option-list">
												<td>
													<?php if ($row->status == 0) { ?>
														<?php echo anchor("Manage_applicant/approveSingleApplicant/{$encrypted_id2}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve Aplication" ><i class="ri-check-line"></i></button></li>') ?>
													<?php } ?>

													<?php echo anchor("Manage_applicant/getapllicant/{$encrypted_id2}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="View Aplication" ><i class="ri-eye-line"></i></button></li>') ?>
												</td>
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