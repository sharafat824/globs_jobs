<?php
if (isset($userInfo) != NULL) {
	
$encrypted_id = $this->encrypt->encode($userInfo->id);
$encrypted_id = str_replace(array('/'), array('_'), $encrypted_id);
$profile_pic = $userInfo->profile_pic;
$name = $userInfo->first_name;
$last_name = $userInfo->last_name;
$gender = $userInfo->gender;
$birth_date = $userInfo->birth_date;
$address = $userInfo->address;
$city_name = $userInfo->ccity_name;
$country_name = $userInfo->cocountry_name;
$post_code = $userInfo->post_code;
$email = $userInfo->email;
$phone = $userInfo->phone;
$birth_city = $userInfo->c1city_name;
$nationality = $userInfo->co1country_name;
$insurance_no = $userInfo->insurance_no;
$passport_pic = $userInfo->passport_pic;
$utilitybill_pic = $userInfo->utilitybill_pic;
$resident_pic = $userInfo->resident_pic;
$e_contact_name = $userInfo->e_contact_name;
$e_contact_relation = $userInfo->e_contact_relation;
$e_contact_phone = $userInfo->e_contact_phone;
$badge_type = $userInfo->badge_type;
$badge_number = $userInfo->badge_number;
$badge_expiry = $userInfo->badge_expiry;
$badge_pic = $userInfo->badge_pic;
$bank_sort_code = $userInfo->bank_sort_code;
$account_number = $userInfo->account_number;
$name_of_account = $userInfo->name_of_account;
$utr_number = $userInfo->utr_number;
$visa_required = $userInfo->visa_required;
$uk_driving_licence = $userInfo->uk_driving_licence;
$status = $userInfo->status;
$file_resume = $userInfo->file_resume;
$file_portfolio_video = $userInfo->file_portfolio_video;
} 
?>
<body>
   <!--<div class="page-banner-area item-bg-two">-->
   <!--   <div class="d-table">-->
   <!--      <div class="d-table-cell">-->
   <!--         <div class="container">-->
   <!--            <div class="page-banner-content">-->
   <!--               <h2>Candidates Details</h2>-->
   <!--            </div>-->
   <!--         </div>-->
   <!--      </div>-->
   <!--   </div>-->
   <!--</div>-->
   <div class="candidates-details-area ptb-100">
      <div class="container">
         <div class="row">
            <div class="col-lg-5 col-md-12">
               <div class="candidates-details-sticky">
                  <div class="candidates-details-information">
                     <div class="information-box">
                        <a href="<?php echo base_url()?>employee_images/<?php echo $profile_pic ?>" target="_blank"><img src="<?php echo base_url()?>employee_images/<?php echo $profile_pic ?>" alt="No Image Found"></a>
                        <h3><?php echo $name." ".$last_name; ?></h3>
                        
                     </div>
                     <ul class="information-list-box">
                        <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-calendar"></i> Gender</span>
							 <?php if($gender==1){
                               echo "Male"; 
							 }?>
							 <?php if($gender==2){
                               echo "Female"; 
							 }?>
							 <?php if($gender==3){
                               echo "Other"; 
							 }?>
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-calendar"></i> Date of Birth</span>
                              <?php echo $birth_date; ?></span>
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-telephone"></i> Phone</span>
                              <span><?php echo $phone; ?></span>
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-email"></i> Email</span>
                              <span><?php echo $email; ?></span>
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-location"></i> State</span>
                              <span><?php echo $country_name; ?></span>
                           </div>
                        </li>
						<li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-location"></i> City</span>
                              <span><?php echo $city_name; ?></span>
                           </div>
                        </li>
                        <!-- <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-layers"></i> Experience</span>
                              5+ Years
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-briefcase"></i> Qualification</span>
                              Master Degree
                           </div>
                        </li>
                        <li>
                           <div class="d-flex justify-content-between align-items-center">
                              <span><i class="flaticon-money"></i> Salary</span>
                              $40 - $60 / Hr
                           </div>
                        </li> -->
                     </ul>
                     
                  <?php if($status == 0){ ?>
               <a href="<?php echo base_url(); ?>Manage_applicant/approveSingleApplicant/<?php echo $encrypted_id; ?>" class="default-btn">Approve Applicant <i class="flaticon-list-1"></i></a>
                  <?php } ?>
                  </div>
               </div>
               </br>
               
            </div>
            <div class="col-lg-7 col-md-12">
               <div class="candidates-details-desc">
                  
                  <div class="candidates-desc-content">
                     <h4>Address <i class="flaticon-mortarboard"></i></h4>
                     <div class="candidates-desc-list">
                        <div class="list-box">
                           <h4><?php echo $address; ?></h4>
                           
                        </div>
                        
                        <div class="order-table table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th scope="col">Detail</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 
                                 <tr>
                                    <td class="product-name">
                                       Post Code
                                    </td>
                                    <td class="product-total">
                                       <?php echo $post_code; ?>
                                    </td>
                                 </tr>

                                 <tr>
                                    <td class="product-name">
                                       Birth City
                                    </td>
                                    <td class="product-total">
                                       <?php echo $birth_city; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Nationality
                                    </td>
                                    <td class="product-total">
                                       <?php echo $nationality; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Insurance #
                                    </td>
                                    <td class="product-total">
                                       <?php echo $insurance_no; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Passport Pic
                                    </td>
                                    <td class="product-total">
                                       <?php if(!empty($passport_pic)){ ?>
                                          <a href="<?php echo base_url()?>employee_images/<?php echo $passport_pic; ?>" target="_blank"><img src="<?php echo base_url()?>employee_images/<?php echo $passport_pic; ?>" width="200px" alt="No Image Found"></a>
                                       <?php }else{?>
                                          Passport Pic is not uploaded by employee
                                       <?php } ?>   
                                   </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Utility Bill Pic
                                    </td>
                                    <td class="product-total">
                                       <?php if(!empty($utilitybill_pic)){ ?>
                                          <a href="<?php echo base_url()?>employee_images/<?php echo $utilitybill_pic; ?>" target="_blank"><img src="<?php echo base_url()?>employee_images/<?php echo $utilitybill_pic; ?>" width="200px" alt="No Image Found"></a>
                                       <?php }else{?>
                                          Utility Pic is not uploaded by employee
                                       <?php } ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Resident Pic
                                    </td>
                                    <td class="product-total">
                                       <?php if(!empty($resident_pic)){ ?>
                                          <a href="<?php echo base_url()?>employee_images/<?php echo $resident_pic; ?>" target="_blank"><img src="<?php echo base_url()?>employee_images/<?php echo $resident_pic; ?>" width="200px" alt="No Image Found"></a>
                                       <?php }else{?>
                                          Resident Pic is not uploaded by employee
                                       <?php } ?>   
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Emergency Contact Name
                                    </td>
                                    <td class="product-total">
                                       <?php echo $e_contact_name; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Emergency contact relation
                                    </td>
                                    <td class="product-total">
                                       <?php echo $e_contact_relation; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Emergency Contact Phone
                                    </td>
                                    <td class="product-total">
                                       <?php echo $e_contact_phone; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Badge type
                                    </td>
                                    <td class="product-total">
                                        <?php echo $badge_type; ?>
									
                                    </td>
                                    
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Badge Number
                                    </td>
                                    <td class="product-total">
                                        <?php echo $badge_number; ?>
									
                                    </td> 
                                </tr>
                                 <tr>
                                    <td class="product-name">
                                       Badge Expiry
                                    </td>
                                    <td class="product-total">
                                       <?php echo $badge_expiry; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                     Badge Pic
                                    </td>
                                    <td class="product-total">
                                       <?php if(!empty($badge_pic)){ ?>
                                          <a href="<?php echo base_url()?>employee_images/<?php echo $badge_pic; ?>" target="_blank"><img src="<?php echo base_url()?>employee_images/<?php echo $badge_pic; ?>" width="200px" alt="No Image Found"></a>
                                       <?php }else{?>
                                          Badge Pic is not uploaded by employee
                                       <?php } ?>
                                    </td>
                                 </tr>

                                 <tr>
                                    <td class="product-name">
                                       Post Code
                                    </td>
                                    <td class="product-total">
                                       <?php echo $post_code; ?>
                                    </td>
                                 </tr>
                                 <!-- <tr>
                                    <td class="product-name">
                                       Bank sort code
                                    </td>
                                    <td class="product-total">
                                       <?php echo $bank_sort_code; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Account Nnumber
                                    </td>
                                    <td class="product-total">
                                       <?php echo $account_number; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Name of account
                                    </td>
                                    <td class="product-total">
                                       <?php echo $name_of_account; ?>
                                    </td>
                                 </tr> -->
                                 <tr>
                                    <td class="product-name">
                                       Utr number
                                    </td>
                                    <td class="product-total">
                                       <?php echo $utr_number; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Post Code
                                    </td>
                                    <td class="product-total">
                                       <?php echo $post_code; ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Visa Required
                                    </td>
                                    <td class="product-total">
									<?php if($visa_required==1){
                                        echo "Yes";
									}?>
									<?php if($visa_required==2){
                                        echo "No"; 
									}?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="product-name">
                                       Uk driving licence
                                    </td>
                                    <td class="product-total">
									<?php if($uk_driving_licence==1){
                                        echo Yes;
									}?>
									<?php if($uk_driving_licence==2){
                                        echo No; 
									}?>
                                       
                                    </td>
                                 </tr>

                                 <tr>
                                    <td class="product-name">
                                       CV
                                    </td>
                                    <td class="product-total">
                                    <?php if(!empty($file_resume)){ ?>
                                       <a href="<?php echo base_url() . "employee_images/" . $file_resume; ?>" target="_blank" >View Cv</a>
                                    <?php }else{ ?>

                                       CV is not uploaded by employee
                                    <?php }?>
                                       
                                    </td>
                                 </tr>


                                 <tr>
                                    <td class="product-name">
                                       Portfolio Video
                                    </td>
                                    <td class="product-total">
                                    <?php if(!empty($file_portfolio_video)){ ?>
                                       <a href="<?php echo base_url() . "employee_images/" . $file_portfolio_video; ?>" target="_blank" >View Cv</a>
                                    <?php }else{ ?>

                                       video is not uploaded by employee
                                    <?php }?>
                                       
                                    </td>
                                 </tr>
                                 
                                 
                                 
                              </tbody>
                           </table>
                        </div>
                     </div>
                     
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
   <!--<footer class="footer-area pt-100">-->
   <!--   <div class="container">-->
   <!--      <div class="row">-->
   <!--         <div class="col-lg-3 col-sm-6">-->
   <!--            <div class="single-footer-widget">-->
   <!--               <div class="widget-logo">-->
   <!--                  <a href="index.html"><img src="assets/images/logo-2.png" alt="image"></a>-->
   <!--               </div>-->
   <!--               <p>Lorem ipsum dolor sit amet consetet ur sadipscing elitr sed diam nonumy eirmod tempor invidunt labore.</p>-->
   <!--               <ul class="widget-social-links">-->
   <!--                  <li><span>Follow:</span></li>-->
   <!--                  <li>-->
   <!--                     <a href="https://www.facebook.com/" target="_blank">-->
   <!--                     <i class="flaticon-facebook"></i>-->
   <!--                     </a>-->
   <!--                  </li>-->
   <!--                  <li>-->
   <!--                     <a href="https://twitter.com/" target="_blank">-->
   <!--                     <i class="flaticon-twitter"></i>-->
   <!--                     </a>-->
   <!--                  </li>-->
   <!--                  <li>-->
   <!--                     <a href="https://www.instagram.com/" target="_blank">-->
   <!--                     <i class="flaticon-instagram"></i>-->
   <!--                     </a>-->
   <!--                  </li>-->
   <!--                  <li>-->
   <!--                     <a href="https://www.linkedin.com/" target="_blank">-->
   <!--                     <i class="flaticon-linkedin"></i>-->
   <!--                     </a>-->
   <!--                  </li>-->
   <!--               </ul>-->
   <!--            </div>-->
   <!--         </div>-->
   <!--         <div class="col-lg-3 col-sm-6">-->
   <!--            <div class="single-footer-widget ps-5">-->
   <!--               <h3>Company</h3>-->
   <!--               <ul class="quick-links">-->
   <!--                  <li><a href="about-us.html">About Eeza</a></li>-->
   <!--                  <li><a href="job-listing-2.html">Browse Jobs</a></li>-->
   <!--                  <li><a href="contact.html">Contact Us</a></li>-->
   <!--                  <li><a href="candidates-dashboard.html">Candidate Dashboard</a></li>-->
   <!--               </ul>-->
   <!--            </div>-->
   <!--         </div>-->
   <!--         <div class="col-lg-3 col-sm-6">-->
   <!--            <div class="single-footer-widget">-->
   <!--               <h3>Resources</h3>-->
   <!--               <ul class="quick-links">-->
   <!--                  <li><a href="blog.html">Blog</a></li>-->
   <!--                  <li><a href="dashboard-post-job.html">Post A Job</a></li>-->
   <!--                  <li><a href="candidates-1.html">Candidates</a></li>-->
   <!--                  <li><a href="privacy-policy.html">Privacy Policy</a></li>-->
   <!--               </ul>-->
   <!--            </div>-->
   <!--         </div>-->
   <!--         <div class="col-lg-3 col-sm-6">-->
   <!--            <div class="single-footer-widget">-->
   <!--               <h3>Quick Contact</h3>-->
   <!--               <ul class="widget-info">-->
   <!--                  <li>-->
   <!--                     <i class="flaticon-a"></i>-->
   <!--                     32, Wales Street, New York, USA-->
   <!--                  </li>-->
   <!--                  <li>-->
   <!--                     <i class="flaticon-p"></i>-->
   <!--                     <a href="tel:00901361246725">(009)01361246725</a>-->
   <!--                  </li>-->
   <!--                  <li>-->
   <!--                     <i class="flaticon-e"></i>-->
   <!--                     <a href="https://templates.envytheme.com/cdn-cgi/l/email-protection#bed6dbd2d2d1fedbdbc4df90ddd1d3"><span class="__cf_email__" data-cfemail="09616c656566496c6c7368276a6664">[email&#160;protected]</span></a>-->
   <!--                  </li>-->
   <!--               </ul>-->
   <!--            </div>-->
   <!--         </div>-->
   <!--      </div>-->
   <!--   </div>-->
   <!--   <div class="copyright-area">-->
   <!--      <div class="container">-->
   <!--         <p><i class="ri-copyright-line"></i> 2021 Eeza. All Rights Reserved by <a href="https://envytheme.com/" target="_blank">EnvyTheme</a></p>-->
   <!--      </div>-->
   <!--   </div>-->
   <!--</footer>-->
   <div class="go-top">
      <i class="ri-arrow-up-line"></i>
   </div>
</body>

</html>