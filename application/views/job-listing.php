<div class="job-list-area ptb-100">
    <div class="container">
        <div class="row">

            <?php
if (count($jobInfo)):
    $cnt = 1;
    foreach ($jobInfo as $row):
        $encrypted_id = $this->encrypt->encode($row->id);
        $encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
        ?>
            <tr>

                <div class="col-lg-4 col-md-6">
                    <div class="single-job-list-box">
                        <div class="job-information">
                            <div class="company-logo">
                                <a href=""><img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>"
                                        alt="image"></a>
                            </div>
                            <h3>
                                <a href="<?php echo base_url() ?>Job/job_details/<?php echo $encrypted_id ?>">
                                    <td><?php echo htmlentities($row->category_name) ?></td>
                                </a>
                            </h3>
                            <span>
                                <td><?php 
                                if($row->experience==1) {
										 echo "Fresh"; 
									}
									if($row->experience==2){
										echo "OneYear Experience";
									}
									if($row->experience==3){
									   echo "TwoYear Experience";
									}
									if($row->experience==4){
										echo "ThreeYear Experience";
									 }
        ?></td>
                            </span>
                        </div>
                        <ul class="job-tag-list">
                            <td>
                                <li><?php if ($row->career == 1) {

									echo "Basic";
								}
								if ($row->career == 2) {
									echo "Intermediate";
								}
								if ($row->career == 3) {
									echo "Advance";
								}
								?></li>
                            </td>

                        </ul>
                        <ul class="location-information">
                            <?php
                                $complete_address = "";
                                $addess = explode(',',$row->address);
                                if(count($addess)>1){
                                    $complete_address = $addess[1]." ".$addess[2];
                                }
                                if(count($addess)>2){
                                    $complete_address = $addess[2]." ".$addess[3];
                                }
                            ?>
                            <?php if($complete_address!=""){?>
                                <li><i class="ri-map-pin-line"></i> <td> <?php echo htmlentities($complete_address) ?></td>
                                </li>
                             <?php } ?>
                            
                            <li><i class="ri-time-line"></i><?php echo $row->job_price; ?></li>
                            <li>
                                    <?php 
                                        if ($row->type == 1) {
                                        echo htmlentities("PartTime");
                                    }
                                    if ($row->type == 2) {
                                        echo htmlentities("FullTime");
                                    }

                                    ?>
                            </li>
                        </ul>
						
						<ul class="location-information">
                            <li> Apply Last Date: &nbsp; <td><?php echo date('m-d-Y', strtotime($row->apply_date)); ?></td>
                            </li>
							
                        </ul><br>
                        <?php if ($this->session->userdata['rolecode'] == 2) {?>
                        <?php 
									$CI =& get_instance();
									$count = $CI->Manage_Dashboard_Model->getuserjobs($row->id);
                                    $statusDetails = $CI->Manage_Dashboard_Model->getStatus();
                                    if($statusDetails->status == 1){
									if($count->count < 1){
								?>
                        <div class="col-lg-3">
                            <div class="job-list-optional">
                                <a href="<?php echo base_url(); ?>Job/apply_job/<?php echo $encrypted_id; ?>"
                                    class="default-btn"> Apply Jobs <i class="flaticon-list-1"></i></a>
                                <div class="save-text">

                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php }?>
                        <?php }?>
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




        </div>
    </div>
</div>