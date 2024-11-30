<!doctype html>
<html lang="zxx">
    <head>
      <meta charset="utf-8'); ?>"/>
      <meta property="og:type" content="website" />
        <meta
          property="og:title"
          content="<?php echo $title!=""?$title:"UK Job Opportunities in Banking, Finance, IT, and more | Jobs Glob"; ?>"
        />
        <meta
          property="og:description"
          content="<?php echo $meta_desc!=""?$meta_desc:"Find your ideal job on Jobs Glob, a platform for UK and global employment. Explore opportunities in Banking, Finance, Graphic Designer, Architecture, and advance your career."; ?>"
        />
      <!--Toastr css-->
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
	  <!-- Google tag (gtag.js) -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-1YL4J6XL77"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());

         gtag('config', 'G-1YL4J6XL77');
      </script>
      <!--Toastr css-->
        <?php echo link_tag('assets/plugins/toastr/build/toastr.css'); ?>
        <?php echo link_tag('assets/plugins/toaster/garessi-notif.css'); ?>
      <title> <?php echo $title!=""?$title:"UK Job Opportunities in Banking, Finance, IT, and more | Jobs Glob" ?></title>
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
        .skiptranslate.goog-te-gadget {
    position: absolute;
    top: -7px;
}
    </style>
	  
   </head>
   <body>
   <div class="topbar-area">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-lg-5 col-md-6">
			   
                  <ul class="topbar-social-list">
                     <li>
                        <a href="https://www.facebook.com/jobsglobuk" target="_blank"><i class="flaticon-facebook"></i></a>
                     </li>
                     <li>
                        <a href="https://twitter.com/jobs_glob" target="_blank"><i class="flaticon-twitter"></i></a>
                     </li>
                     <li>
                        <a href="https://www.instagram.com/jobsglob/" target="_blank"><i class="flaticon-instagram"></i></a>
                     </li>
                     <li>
                        <a href="https://linkedin.com/" target="_blank"><i class="flaticon-linkedin"></i></a>
                     </li>
                  </ul>
			   
               </div>
               <div class="col-lg-7 col-md-6">
			   <?php if($this->session->userdata['rolecode']=='') { ?>
                  <ul class="topbar-action">
                    <li>
                         <a href="#">
                            <div id="google_translate_element" style="width: 140px;"></div>
                        </a> 
                    </li>
                     
                     <li>
                        <a href="<?php echo base_url() ?>Manage_login?page=1"><i class="flaticon-user"></i> Register</a>
                     </li>
                     <li>
                        <a href="<?php echo base_url()?>Manage_login?page=2"><i class="flaticon-padlock"></i> Log In</a>
                     </li>
                    
                  </ul>
				  <?php } ?>
               </div>
            </div>
         </div>
      </div>
      <div class="navbar-area">
         <div class="main-responsive-nav">
            <div class="container">
               <div class="main-responsive-menu">
                  <div class="logo">
                     <a href="<?php echo base_url() ?>Welcome">
                     <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="logo">
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="main-navbar">
            <div class="container-fluid">
               <nav class="navbar navbar-expand-md navbar-light">
                  <a class="navbar-brand" href="<?php echo base_url() ?>Welcome">
                  <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="image">
                  </a>
                  <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                     <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                           <a href="<?php echo base_url() ?>Welcome" class="nav-link tab" id="Welcome">
                           Home
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url() ?>Welcome/all_jobs" class="nav-link tab" id="all_jobs">
                           All Jobs
                           </a>
                           
                        </li>
                        
                        
                        <!-- <li class="nav-item">
                           <a href="#" class="nav-link">
                           Services
                          
                           </a>
                        
                        </li> -->
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
                           <a href="<?php echo base_url() ?>Welcome/about" class="nav-link tab" id="about">About Us</a>
                        </li>
                        <!--<li class="nav-item">-->
                        <!--   <a href="<?php //echo base_url() ?>Welcome/vission" class="nav-link tab" id="vission">Our Vission</a>-->
                        <!--</li>-->
                        <!--<li class="nav-item">-->
                        <!--   <a href="<?php //echo base_url() ?>Welcome/vission" class="nav-link tab" id="vission">Our Mission</a>-->
                        <!--</li>-->
                        <li class="nav-item">
                           <a href="<?php echo base_url() ?>Welcome/contact" class="nav-link tab" id="contact">Contact</a>
                        </li>
                        <li class="nav-item">
                           <a href="<?php echo base_url() ?>Blog" class="nav-link tab" id="Blog">
                           Blog
                           </a>
                           
                        </li>
                     </ul>
                     <div class="others-options d-flex align-items-center">
					 <?php if($this->session->userdata['rolecode']=='') { ?>
                        <div class="option-item" style="margin-right: 5px;">
                           <a href="<?php echo base_url() ?>Welcome/all_jobs" class="default-btn btn-2">Apply for a job <i class="flaticon-plus"></i></a>
                        </div>

                        <div class="option-item">
                           <a href="<?php echo base_url() ?>Manage_login?page=2" class="default-btn ">Post Job<i class="flaticon-plus"></i></a>
                        </div>

					 <?php } ?>
					 <?php if(!$this->session->userdata['rolecode']=='') { ?>
                           <div class="dropdown profile-nav-item">
                              <a href="#" class="dropdown-bs-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <div class="menu-profile">
                                    <img width='50px'; src="<?php echo base_url('assets/images/dashboard/user1.jpg'); ?>" class="rounded-circle" alt="image">
                                    <span class="name">My Account</span>
                                 </div>
                              </a>
                              <div class="dropdown-menu">
                                 
                                 <div class="dropdown-body">
                                    <ul class="profile-nav p-0 pt-3">
                                       <li class="nav-item active">
                                          <a href="<?php echo base_url()?>Manage_dashboard/Home" class="nav-link">
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
					 <?php } ?>
                     </div>
                  </div>
               </nav>
            </div>
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      