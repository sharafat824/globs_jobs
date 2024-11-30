 <footer class="footer-area pt-100">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-sm-6">
                  <div class="single-footer-widget">
                     <div class="widget-logo">
                        <a href="<?php echo base_url() ?>Welcome"><img src="<?php echo base_url();?>assets/images/logo-2.png" alt="image"></a>
                     </div>
                     <!-- <p>Aegis Eagles is one of the most significant supply chain challenges for high-value product industrialists and their logistics service providers</p> -->
                     <ul class="widget-social-links">
                        <li><span>Follow:</span></li>
                        <li>
                           <a href="https://www.facebook.com/jobsglobuk" target="_blank">
                           <i class="flaticon-facebook"></i>
                           </a>
                        </li>
                        <li>
                           <a href="https://twitter.com/jobs_glob" target="_blank">
                           <i class="flaticon-twitter"></i>
                           </a>
                        </li>
                        <li>
                           <a href="https://www.instagram.com/jobsglob/" target="_blank">
                           <i class="flaticon-instagram"></i>
                           </a>
                        </li>
                        <li>
                           <a href="https://www.linkedin.com/" target="_blank">
                           <i class="flaticon-linkedin"></i>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <div class="single-footer-widget ps-5">
                     <h3>Company</h3>
                     <ul class="quick-links">
                        <li><a href="<?php echo base_url() ?>Welcome">Home</a></li>
                        <li><a href="<?php echo base_url() ?>Welcome/all_jobs">All Jobs</a></li>
                        <li><a href="<?php echo base_url() ?>Courses/cargoCourseView">Free Course</a></li>
                        <li><a href="<?php echo base_url() ?>Welcome/contact">Contact</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6">
                  <div class="single-footer-widget">
                     <h3>Quick Contact</h3>
                     <ul class="widget-info">
                        <li>
                           <i class="flaticon-a"></i>
                           <p>12 Cobcroft Road, Huddersfield ,</p>
                           United Kingdom, HD22RU
                        </li>
                        <li>
                           <i class="flaticon-p"></i>
                           <a href="tel:+447778737775">+44 7778 737775</a>
                        </li>
                        <li>
                           <i class="flaticon-e"></i>
                           <a href="#"><span class="__cf_email__" data-cfemail="563e333a3a391633332c377835393b">info@jobsglob.com</span></a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="copyright-area">
            <div class="container">
               <p><i class="ri-copyright-line"></i> <?php echo date('Y'); ?> JobsGlob. All Rights Reserved by <a href="#" target="_blank">JobsGlob</a></p>
            </div>
         </div>
      </footer>
      <div class="go-top">
         <i class="ri-arrow-up-line"></i>
      </div>
      <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js'); ?>"/></script><script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.meanmenu.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/owl.carousel.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.appear.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/odometer.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.magnific-popup.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/fancybox.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/selectize.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/TweenMax.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/aos.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/metismenu.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/simplebar.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/dropzone.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/sticky-sidebar.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/jquery.ajaxchimp.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/form-validator.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/contact-form-script.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/wow.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/js/main.js'); ?>"/></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"/></script>
	  <!--Toastr js-->
<script src="<?php echo base_url('assets/plugins/toastr/build/toastr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/toaster/garessi-notif.js'); ?>"></script>
<?php include APPPATH.'views/includes/toast.php';?>

<script>
$(document).ready(function() {
     var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
    $('#'+pgurl).addClass("active");

});
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en'
    }, 'google_translate_element');
}
</script>

   </body>
   
</html>