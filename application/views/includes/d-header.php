<!doctype html>
<html lang="zxx">

   <head>
      <meta charset="utf-8'); ?>"/>
      <meta property="og:type" content="website" />
        <meta
          property="og:title"
          content="UK Job Opportunities in Banking, Finance, IT, and more | Jobs Glob"
        />
        <meta
          property="og:description"
          content="Find your ideal job on Jobs Glob, a platform for UK and global employment. Explore opportunities in Banking, Finance BankingFinance Banking, Finance, Graphic Designer, Architecture, and advance your career"
        />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/aos.css'); ?>"/>


      <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/meanmenu.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/flaticon.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/remixicon.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/odometer.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.default.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/magnific-popup.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/fancybox.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/selectize.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/metismenu.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/simplebar.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/dropzone.min.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/navbar.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css'); ?>"/>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css'); ?>"  />

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-1YL4J6XL77"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());

         gtag('config', 'G-1YL4J6XL77');
      </script>
      <?php echo link_tag('https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css'); ?>
	  <!--Toastr css-->
        <?php echo link_tag('assets/plugins/toastr/build/toastr.css'); ?>
        <?php echo link_tag('assets/plugins/toaster/garessi-notif.css'); ?>
      <title> JobsGlob</title>
      <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/favicon.ico'); ?>"/>
    <style>
        .goog-te-combo {
            width: 100%;
          padding: 6px 8px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
          border-radius: 20px;
        }
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
    
        body {
            top: 0px !important;
        }
    
        .goog-logo-link {
            display: none !important;
        }
    
        .goog-te-gadget {
            color: transparent !important;
        }
    
        #google_translate_element {
            color: transparent;
        }
    
        #google_translate_element a {
            display: none;
        }
    
        body>.skiptranslate {
            display: none;
        }
    </style>

   </head>
   <body>
      <div class="preloader-area">
         <div class="spinner">
            <div class="inner">
               <div class="disc"></div>
               <div class="disc"></div>
               <div class="disc"></div>
            </div>
         </div>
      </div>
      <div class="sidemenu-area">
         <div class="sidemenu-header">
            <a href="<?php echo base_url() ?>Manage_dashboard/Home" class="navbar-brand d-flex align-items-center">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="image">
            </a>
            <div class="responsive-burger-menu d-block d-lg-none">
               <span class="top-bar"></span>
               <span class="middle-bar"></span>
               <span class="bottom-bar"></span>
            </div>
         </div>
         <div class="sidemenu-body">
            <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>

               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Manage_dashboard/Home" class="nav-link">
                  <span class="icon"><i class="ri-home-line"></i></span>
                  <span class="menu-title">Dashboard</span>
                  </a>
               </li>
			   <?php if ($this->session->userdata['rolecode'] == '2') {?>
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Candidate/addCandidate" class="nav-link">
                  <span class="icon"><i class="ri-user-line"></i></span>
                  <span class="menu-title">Candidate Profile</span>
                  </a>
               </li>
			   <li class="nav-item">
                  <a href="<?php echo base_url() ?>Candidate/applied_jobs" class="nav-link">
                  <span class="icon"><i class="ri-user-line"></i></span>
                  <span class="menu-title">Applied Jobs</span>
                  </a>
               </li>
			   <?php }?>
			   <?php if ($this->session->userdata['rolecode'] == '3') {?>
			   <li class="nav-item">
                  <a href="<?php echo base_url() ?>Company/addcompany" class="nav-link">
                  <span class="icon"><i class="ri-user-line"></i></span>
                  <span class="menu-title">Company Profile</span>
                  </a>
               </li>
			   <?php }?>
			   <?php if ($this->session->userdata['rolecode'] == '1') {?>
            
            <?php if (authorize($_SESSION["access"]["ADMIN"]["Candidate"]["view"])) { ?>
      
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Manage_applicant" class="nav-link">
                  <span class="icon"><i class="ri-team-line"></i></span>
                  <span class="menu-title">All Candidate</span>
                  </a>
               </li>
            <?php } ?>
            
            <?php if (authorize($_SESSION["access"]["ADMIN"]["AssignedCandidate"]["view"])) { ?>
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Manage_applicant/assignedjobs" class="nav-link">
                  <span class="icon"><i class="ri-user-line"></i></span>
                  <span class="menu-title">Assigned Candidate</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (authorize($_SESSION["access"]["ADMIN"]["AdminUser"]["view"])) { ?>
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>User" class="nav-link">
                  <span class="icon"><i class="ri-user-line"></i></span>
                  <span class="menu-title">Admin Users</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (authorize($_SESSION["access"]["ADMIN"]["ManageRole"]["view"])) { ?>

               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Manage_role" class="nav-link">
                  <span class="icon"><i class="ri-user-line"></i></span>
                  <span class="menu-title">Manage Role</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (authorize($_SESSION["access"]["ADMIN"]["IncompleteProfile"]["view"])) { ?>
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Manage_Incomplete_Profiles" class="nav-link">
                  <span class="icon"><i class="ri-alert-line"></i></span>
                  <span class="menu-title">Incomplete Profiles</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (authorize($_SESSION["access"]["ADMIN"]["Company"]["view"])) { ?>
			      <li class="nav-item">
                  <a href="<?php echo base_url() ?>Company/allcompany" class="nav-link">
                  <span class="icon"><i class="ri-user-line"></i></span>
                  <span class="menu-title">All Companies</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (authorize($_SESSION["access"]["ADMIN"]["ApprovedJobs"]["view"])) { ?>
   			   <li class="nav-item">
                  <a href="<?php echo base_url() ?>job/approved_jobs" class="nav-link">
                  <span class="icon"><i class="ri-shield-check-line"></i></span>
                  <span class="menu-title">Approved Jobs</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (authorize($_SESSION["access"]["ADMIN"]["PendingJobs"]["view"])) { ?>
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>job/pending_jobs" class="nav-link">
                  <span class="icon"><i class="ri-loader-3-line"></i></span>
                  <span class="menu-title">Pending Jobs</span>
                  </a>
               </li>
            <?php } ?>

            <?php if (authorize($_SESSION["access"]["ADMIN"]["JobsCategories"]["view"])) { ?>
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Categories" class="nav-link">
                  <span class="icon"><i class="ri-creative-commons-nd-line"></i></span>
                  <span class="menu-title">Jobs Categories</span>
                  </a>
               </li>
            <?php } ?>

            <?php }?>
			   <?php if ($this->session->userdata['rolecode'] == '3') {?>
               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Job/add_job" class="nav-link">
                  <span class="icon"><i class="ri-send-plane-fill"></i></span>
                  <span class="menu-title">Post a New Job</span>
                  </a>
               </li>
			    <?php }?>

               <li class="nav-item">
                  <a href="<?php echo base_url() ?>Manage_login/logout" class="nav-link">
                  <span class="icon"><i class="ri-logout-circle-r-line"></i></span>
                  <span class="menu-title">Logout</span>
                  </a>
               </li>

            </ul>
         </div>
      </div>
      <div class="main-dashboard-content d-flex flex-column">
         <div class="navbar-area">
            <div class="main-responsive-nav">
               <div class="main-responsive-menu">
                  <div class="responsive-burger-menu d-lg-none d-block">
                     <span class="top-bar"></span>
                     <span class="middle-bar"></span>
                     <span class="bottom-bar"></span>
                  </div>
               </div>
            </div>
            <div class="main-navbar">
               <nav class="navbar navbar-expand-md navbar-light">
                  <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                  <?php if ($this->session->userdata['rolecode'] != '1' && $this->session->userdata['rolecode'] != '2'  && $this->session->userdata['rolecode'] != '3') {?>
                     <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                           <a href="<?php echo base_url() ?>Welcome" class="nav-link">
                           Home1
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url() ?>job/all_jobs" class="nav-link">
                           All Jobs
                           </a>

                        </li>


                        <li class="nav-item">
                           <a href="#" class="nav-link">
                           Services

                           </a>

                        </li>
                         <li class="nav-item">
                           <a href="<?php echo base_url() ?>Welcome/about" class="nav-link tab" id="about">About Us</a>
                        </li>
						      <li class="nav-item">
                           <a href="" class="nav-link tab" id="all_jobs">
                              Free Course
                              <i class="ri-arrow-down-s-line"></i>
                           </a>
                           <ul class="dropdown-menu">
                              <li class="nav-item">
                              <a href="<?php echo base_url() ?>Courses/cargoCourseView" class="nav-link">Cargo Work Course</a>
                              </li>
                              <li class="nav-item">
                              <a href="<?php echo base_url() ?>Courses/cleaningCourseView" class="nav-link">Cleaning Work Course</a>
                              </li>
                              <li class="nav-item">
                              <a href="<?php echo base_url() ?>Courses/securityCourseView" class="nav-link">Security Work Course</a>
                              </li>
                           </ul>
                        </li>

                        <li class="nav-item">
                           <a href="contact.php" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url() ?>Blog" class="nav-link">
                           Blog
                           </a>
                           
                        </li>
                     </ul>
                  <?php } ?>
                     <div class="others-options d-flex align-items-center">
                        <div class="option-item">
						<?php if (!$this->session->userdata['rolecode'] == '') {?>
                           <div class="dropdown profile-nav-item">
                              <a href="#" class="dropdown-bs-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <div class="menu-profile">
                                    <?php if ($this->session->userdata['rolecode'] == '3') {?>
                                       
                                       <?php $image_url = "employee_images/".$this->session->userdata['user_logo'];
                                           $image_url_complete =  base_url($image_url);
                                       ?>
                                       <?php if (file_exists($image_url_complete)) { ?>
                                          <img src="<?php echo base_url($image_url) ?>" class="rounded-circle" alt="image">
                                       <?php }else{ ?>
                                          <img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image">
                                       <?php } ?>
                                    <?php }else{ ?>
                                       <img src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image">
                                    <?php } ?>
                                    <span class="name">My Account</span>
                                 </div>
                              </a>
                              <div class="dropdown-menu">
                                 <div class="dropdown-header d-flex flex-column align-items-center">
                                  <!--  <div class="figure mb-3">
                                       <img src="assets/images/dashboard/user1.jpg" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="info text-center">
                                       <span class="name">Andy Smith</span>
                                       <p class="mb-3 email"><a href="https://templates.envytheme.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="076f626b6b68476669637568746a6e736f2964686a">[email&#160;protected]</a></p>
                                    </div>-->
                                     <div>
                        <div id="google_translate_element" style="width: 140px;"></div>
                    </div>
                                    
                                 </div>
                                 <div class="dropdown-body">
                                    <ul class="profile-nav p-0 pt-3">
                                       <li class="nav-item active">
                                          <a href="<?php echo base_url() ?>Manage_dashboard/Home" class="nav-link">
                                          <span class="icon"><i class="ri-home-line"></i></span>
                                          <span class="menu-title">Dashboard</span>
                                          </a>
                                       </li>

                                    </ul>
                                 </div>
                                 
                                 <div class="dropdown-footer">
                                    <ul class="profile-nav">
                                       <li class="nav-item">
                                          <a href="<?php echo base_url() ?>Manage_login/logout" class="nav-link"><i class="ri-logout-box-r-line"></i> <span>Logout</span></a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
						   <?php }?>
                        </div>
                     </div>
                  </div>
               </nav>
            </div>
         </div>

         <?php
function authorize($module) {
	return $module == "yes" ? TRUE : FALSE;
}
?>