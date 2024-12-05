
<div class="">
   
<div class="breadcrumb-area">
        <h1>Welcome!</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Home</a></li>
            <li class="item">Pending Jobs</li>
        </ol>
    </div>
   
   <div class="job-list-area">
         <div class="container">
            <div class="section-title">
               <h2>Pending Jobs</h2>
               
            </div>
            <div class="row">
			
				<?php
				if (count($jobInfo)) :
					$cnt = 1;
					foreach ($jobInfo as $row) :
						$encrypted_id = $this->encrypt->encode($row->id);
						$encrypted_id=str_replace(array('/'), array('_'), $encrypted_id);
						?>   
						<tr>
						
               <div class="col-lg-4 col-md-6">
                  <div class="single-job-list-box">
                     <div class="job-information">
                        <div class="company-logo">
                           <a href=""><img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" alt="image"></a>
                        </div>
                        <h3>
                           <a href="<?php echo base_url()?>Job/job_details/<?php echo $encrypted_id ?>"><td><?php echo htmlentities($row->title) ?></td></a>
                        </h3>
                        <span><td><?php 
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
						?></td></span>
                        
                        
                     </div>
                     <ul class="job-tag-list">	
                        <td><li><?php if($row->career==1) {
							
							 echo "Basic"; 
						}
						if($row->career==2){
							echo "Intermediate";
						}
						if($row->career==3){
						   echo "Advance";
						}
						?></li></td>
						
                     </ul>
                     <ul class="location-information">
                        <li><i class="ri-map-pin-line"></i><?php echo htmlentities($row->address) ?></td></li>
                        <li><i class="ri-time-line"></i> 
						<td><?php if($row->type==1) {
							
							 echo "PartTime"; 
						}
						if($row->type==2){
							echo 'FullTime';
						}
						
						?></td></li>
                     </ul>
                  </div>
               </div>
               
               <tr>
			 <?php
						$cnt++;
					endforeach;
				else :
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
   
  </div> 