
<div class="">
<div class="breadcrumb-area">
        <h1>Applied Jobs</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Home</a></li>
            <li class="item"><a href="<?php echo base_url() ?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item">Applied Jobs</li>
        </ol>
</div>
   
   <div class="job-list-area">
         <div class="container">
            <div class="section-title">
               <h2>Applied Jobs</h2>
                   
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
                        <span><td><?php if($row->experience==1) {
							 echo "OneYear Experience" ; 
						}
						if($row->experience==2){
							echo "TwoYear Experience";
						}
						if($row->experience==3){
						   echo "ThreeYear Experience";
						}
						?></td></span>
                        <div class="bookmark-btn">
                           <i class="ri-bookmark-line"></i>
                        </div>
                        <div class="hover-bookmark-btn">
                           <i class="ri-bookmark-fill"></i>
                        </div>
                     </div>
                     <ul class="job-tag-list">	
                        <td><li><?php if($row->career==1) {
							
							 echo Basic; 
						}
						if($row->career==2){
							echo Intermediate;
						}
						if($row->career==3){
						   echo Advance;
						}
						?></li></td>
						
                     </ul>
                     <ul class="location-information">
                        <li><i class="ri-map-pin-line"></i><?php echo htmlentities($row->address) ?></td></li>
                        <li><i class="ri-time-line"></i> 
						<td><?php if($row->type==1) {
							
							 echo PartTime; 
						}
						if($row->type==2){
							echo FullTime;
						}
						
						?></td></li>
                     </ul>
					 <ul class="job-tag-list">	
                        <td><li><?php if($row->short_list==0) {
							
							 echo Pending; 
						}
						if($row->short_list==1){
							echo ShortList;
						}
						if($row->short_list==11){
							echo Assigned;
						}
						
						?></li></td>
						
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