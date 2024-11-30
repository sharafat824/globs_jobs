<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <title>Ocando</title>

    <!--favicon -->
    <link rel="icon" href="<?php echo base_url('assets/img/brand/logo_favicon.png'); ?>" type="image/x-icon" />

    <!--Bootstrap.min css-->
    <?php echo link_tag('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>
    <!--Style css-->
    <?php echo link_tag('assets/css/style.css'); ?>
    <!--Icons css-->
    <?php echo link_tag('assets/css/icons.css'); ?>
    <!--mCustomScrollbar css-->
    <?php echo link_tag('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css'); ?>
    <!--Sidemenu css-->
    <?php echo link_tag('assets/plugins/horizontal-menu/dropdown-effects/fade-down.css'); ?>
    <?php echo link_tag('assets/plugins/horizontal-menu/webslidemenu.css'); ?>
    <!--Morris css-->
    <?php echo link_tag('assets/plugins/morris/morris.css'); ?>
    <!--Chartist css-->
    <?php echo link_tag('assets/plugins/chartist/chartist.css'); ?>

    <?php echo link_tag('assets/plugins/select2/select2.css'); ?>
    <!--Toastr css-->
    <?php echo link_tag('assets/plugins/toastr/build/toastr.css'); ?>
    <?php echo link_tag('assets/plugins/toaster/garessi-notif.css'); ?>
    <!--DataTables css-->
    <?php echo link_tag('assets/plugins/Datatable/css/dataTables.bootstrap4.css'); ?>
    <?php echo link_tag('assets/plugins/Datatable/css/buttons.bootstrap4.min.css'); ?>

    <?php echo link_tag('https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body class="app ">

    <!--Header Style -->
    <div class="wave -three"></div>

    <!--loader -->
    <div id="spinner"></div>

    <!--app open-->
    <div class="page">
        <div class="main-wrapper">
            <div class="header">
                <!--nav open-->
                <nav class="navbar navbar-expand-lg main-navbar">
                    <div class="container">
                        <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
                        <a class="header-brand" href="<?php echo site_url('Manage_dashboard'); ?>">
                            <img src="<?php echo base_url('assets/img/brand/stepwise.jpg'); ?>" class="header-brand-img" alt="castrol Logo">
                        </a>
                        <form class="form-inline mr-auto">
                            <ul class="navbar-nav mr-2">
                                <li><a href="#" data-toggle="search" class="nav-link  d-md-none navsearch"><i class="fa fa-search"></i></a></li>
                            </ul>
                        </form>
                        <ul class="navbar-nav navbar-right">
                            <li class="dropdown dropdown-list-toggle d-none d-lg-block">
                                <p class="nav-link nav-link-lg full-screen-link" style="color:#fff;">Hello
                                    <?php echo ucfirst($this->session->userdata('username')); ?></p>
                            </li>
                            <li class="dropdown dropdown-list-toggle d-none d-lg-block">
                                <a href="#" class="nav-link nav-link-lg full-screen-link">
                                    <i class="fa fa-expand " id="fullscreen-button"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg d-flex">

                                    <span><img src="<?php echo base_url('assets/img/brand/user1.jpg'); ?>" alt="profile-user" class="rounded-circle w-32 mr-2"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class=" dropdown-header noti-title text-center border-bottom pb-3">
                                        <img src="<?php echo base_url('assets/img/brand/logo_main.png'); ?>" width="60%" />
                                    </div>
                                    <a class="dropdown-item" href="<?php echo site_url('Manage_login/logout'); ?>"><i class="mdi  mdi-logout-variant mr-2"></i> <span>Log Out</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!--nav closed-->
            </div>