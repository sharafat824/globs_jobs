<?php
if (isset($userInfo) != NULL) {

$company_logo = $userInfo->company_logo;	
$company_name = $userInfo->company_name;
$email = $userInfo->c_mail;
$phone = $userInfo->c_phone;
$website = $userInfo->c_website;
$about_company = $userInfo->c_about_company;
$address = $userInfo->c_address;
$city_name = $userInfo->ccity_name;
$country_name = $userInfo->cocountry_name;

} 
?>
<body>
  
   <div class="candidates-details-area ptb-100">
   <div class="breadcrumb-area mb-5 mx-3">
		<h1>Welcome!</h1>
		<ol class="breadcrumb">
			<li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Home</a></li>
			<li class="item"><a href="<?php echo base_url()?>Manage_dashboard/Home">Dashboard</a></li>
            <li class="item"><a href="<?php echo base_url()?>Company/allcompany">All Companies</a></li>
            <li class="item">Company Details</li>
		</ol>
	</div>
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-12">
               <div class="candidates-details-sticky">
                  <div class="candidates-details-information">
                     <div class="information-box">
                     <?php if(!empty($company_logo) ){ ?>
                        <img src="<?php echo base_url()?>employee_images/<?php echo $company_logo ?>" alt="image"> <?php } else{ ?><img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image"><?php } ?>

                        <h3><?php echo $company_name; ?></h3>
                        <a href="<?php echo $website ?>" target="_blank"><span><?php echo $website; ?></span></a>
                        
                     </div>
                     <ul class="information-list-box">
                        
                        
                        <li>
                           <div class="d-flex justify-content-between align-items-left">
                              <span><i class="flaticon-telephone"></i> </span>
                              <a href="#"><span><?php echo $phone; ?></a>
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-left">
                              <span><i class="flaticon-email"></i>  </span>
                              <input type="hidden" name="companyemail" id="companyemail" value="<?php echo $email;?>">
                              <a href="#"><span><?php echo $email; ?></span></a>
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-left">
                              <span><i class="flaticon-location"></i> </span>
                              <span><?php echo $address; ?>
                           </div>
                        </li>
						<li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-location"></i> Country</span>
                              <?php echo $country_name; ?>
                           </div>
                        </li>
						<li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-location"></i> City </span>
                              <?php echo $city_name; ?>
                           </div>
                        </li>
                        
                     </ul>
                     <div class="candidates-details-btn-box">
                        <button onclick="sendMail(); return false" class="default-btn">Contact Me <i class="flaticon-send"></i></button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-8 col-md-12">
               <div class="candidates-details-desc">
                  <div class="candidates-desc-content mb-30">
                     <h3>About Company</h3>
                     <p><?php echo $about_company; ?></p>
                  </div>
                  
                  <!-- <div class="candidates-desc-content">
                     <h3>Experience <i class="flaticon-layers"></i></h3>
                     <div class="candidates-desc-list">
                        <div class="list-box">
                           <h4>Google (Head of Industry & Development)</h4>
                           <span>2014 - 2021</span>
                           <p>Lorem consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
                        </div>
                        <div class="list-box">
                           <h4>Spotify (Professor and Consultant)</h4>
                           <span>2021 - Present</span>
                           <p>Lorem consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
                        </div>
                        <div class="list-box">
                           <h4>Google (2021 - Present)</h4>
                           <span>Head of Industry & Development</span>
                           <p>Lorem consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
                        </div>
                     </div>
                  </div> -->
                 <!--  <div class="candidates-desc-content">
                     <h3>Awards & Certificates <i class="flaticon-trophy"></i></h3>
                     <div class="candidates-desc-list">
                        <div class="list-box">
                           <h4>Certified Professional in Learning and Performance (CPLP)</h4>
                           <span>American Society for Training & Development N/A</span>
                           <p>Lorem consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
                        </div>
                        <div class="list-box">
                           <h4>Best Design Awards 2021</h4>
                           <span>Awards</span>
                           <p>Lorem consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
                        </div>
                        <div class="list-box">
                           <h4>Perfect Attendance Programs</h4>
                           <span>Awards</span>
                           <p>Lorem consetetur sadipscing elitr sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.</p>
                        </div>
                     </div>
                  </div> -->
                 
               </div>
            </div>
         </div>
      </div>
   </div>
  
   <script>
        function sendMail() {
          var link = "mailto:" + encodeURIComponent(document.getElementById('companyemail').value)
                    + "?cc="
                    + "&subject=" + encodeURIComponent("This is my subject")
                    + "&body="
    ;
    
    window.location.href = link;
}
   </script>
   <div class="go-top">
      <i class="ri-arrow-up-line"></i>
   </div>
</body>

</html>