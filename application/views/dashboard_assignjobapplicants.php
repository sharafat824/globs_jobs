
<div class="">

<div class="breadcrumb-area">
<h1>Assigned Candidate</h1>
<ol class="breadcrumb">
<li class="item"><a href="dashboard.html">Home</a></li>
<li class="item"><a href="dashboard.html">Dashboard</a></li>
<li class="item">Candidate Assigned Job</li>
</ol>
</div>


<div class="all-applicants-box">
<h2>Applicants</h2>
<div class="row">
<tbody>
<?php
if (count($applicant)):
    $cnt = 1;
    foreach ($applicant as $row):
        $encrypted_id = $this->encrypt->encode($row->user_job_id);
        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);

		$encrypted_id_1 = $this->encrypt->encode($row->employee_id);
        $encrypted_id_1 = str_replace(array('/'), array('_'), $encrypted_id_1);
        ?>
					<tr>

					<div class="col-lg-6 col-md-12">
					<div class="single-applicants-card">
					<div class="image">
					<?php $image_url =  'employee_images/'.$row->profile_pic; ?>
						<?php if(file_exists($image_url)){ ?>
							<img src="<?php echo base_url() ?>employee_images/<?php echo htmlentities($row->profile_pic) ?>" alt="image">
						<?php }else{ ?>
							<img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image">
						<?php } ?>	
				</div>
					<div class="content">
					<h3>
					<a href=""><td><?php echo htmlentities($row->first_name) ?></td></a>
					</h3>
					<span><td><?php echo htmlentities($row->category_name) ?></td></span>
					<ul class="job-info">
					<li><i class="ri-map-pin-line"></i><td><?php echo htmlentities($row->cocountry_name) ?></td></li>
					<li><i class="ri-phone-line"></i><td><?php echo htmlentities($row->phone) ?></td></li>
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
					</ul>
					<div class="applicants-footer">
					<ul class="option-list">
					<td><?php echo anchor("Manage_applicant/getapllicant/{$encrypted_id_1}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="View Aplication" ><i class="ri-eye-line"></i></button></li>') ?></td>
					
					<td><?php echo anchor("Manage_applicant/deleteapplicant/{$encrypted_id}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Aplication" type="button"><i class="ri-delete-bin-line"></i></button></li> ', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog3();")) ?></td>
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

