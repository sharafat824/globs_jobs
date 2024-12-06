<div class="">

	<div class="breadcrumb-area">
		<h1>All Applicants</h1>
		<ol class="breadcrumb">
			<li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
			<li class="item"><a href="<?php echo base_url()?>job/approved_jobs">Approved Jobs</a></li>
			<li class="item">Applicants</li>
			
		</ol>
	</div>


<div class="all-applicants-box">
<h2>Applicants</h2>
<div class="row">
<tbody>
<?php
$CI =& get_instance();
if (count($jobInfo)):
    $cnt = 1;
    foreach ($jobInfo as $row):
        $encrypted_id = $this->encrypt->encode($row->user_id);
        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);

        $encrypted_id1 = $this->encrypt->encode($row->job_id);
        $encrypted_id1 = str_replace(array('/'), array('_'), $encrypted_id1);

        $encrypted_id2 = $this->encrypt->encode($row->id);
        $encrypted_id2 = str_replace(array('/'), array('_'), $encrypted_id2);
        ?>
					<tr>

					<div class="col-lg-6 col-md-12">
					<div class="single-applicants-card">
					<div class="image">
					<a href="">
					<?php if(!empty($row->profile_pic) ){ ?>
						<img src="<?php echo base_url() ?>employee_images/<?php echo htmlentities($row->profile_pic) ?>" alt="image">
						<?php }else{ ?>
							<img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image">
						<?php } ?></a>
					</div>
					<div class="content">
					<h3>
					<a href=""><td><?php echo htmlentities($row->first_name) ?></td></a>
					</h3>
					<span>
					    <?php 
					        if($row->category_id==1){
					            echo "Cleaning Work";
					        }
					        if($row->category_id==2){
					            echo "Security Work";
					        }
					        if($row->category_id==3){
					            echo "Drivers Job";
					        }
					    ?>
					</span>
					<ul class="job-info">
					<li><i class="ri-map-pin-line"></i> <?php echo htmlentities($row->address); ?></li>

					<li style="color:red;"><i class="ri-check-line"></i><?php if ($row->short_list == 0) {

            echo "Pending";
        }
        if ($row->short_list == 1) {
            echo "ShortList";
        }
        if ($row->short_list == 11) {
            echo "Assigned";
        }

        ?></li>

					 </ul>
					<div class="applicants-footer">
					<ul class="option-list">
					<td><?php echo anchor("Manage_applicant/getapllicant/{$encrypted_id2}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="View Aplication" ><i class="ri-eye-line"></i></button></li>') ?></td>
					<?php if ($row->short_list == 0) {?>
					<td><?php echo anchor("job/shortlistapplicant/{$encrypted_id}/{$encrypted_id1}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Short List" type="button"><i class="ri-check-line"></i></button></li>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog1();")) ?></td>
					<td><?php echo anchor("job/rejectapplicant/{$encrypted_id}/{$encrypted_id1}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Reject Aplication" type="button"><i class="ri-close-line"></i></button></li>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog2();")) ?></td>
					<?php }?>
					<?php if ($row->short_list == 1) {?>
					<td><?php echo anchor("job/assignapplicant/{$encrypted_id}/{$encrypted_id1}", '<li><button class="option-btn d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Assign" type="button"><i class="ri-check-line"></i></button></li>', array('class' => "fa fa-trash fa-lg", 'onclick' => "return confirmDialog1();")) ?></td>
					<?php }?>

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