<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <title>Ocando</title>

    <!--Favicon -->
    <link rel="icon" href="<?php echo base_url('assets/img/brand/logo_favicon.png'); ?>" type="image/x-icon" />

    <!--Bootstrap.min css-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <!--Style css-->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--Icons css-->
    <link rel="stylesheet" href="assets/css/icons.css">

    <!--mCustomScrollbar css-->
    <link rel="stylesheet" href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css">

    <!--Sidemenu css-->
    <link href="assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">
    <link href="assets/plugins/horizontal-menu/webslidemenu.css" rel="stylesheet">

    <!--Toastr css-->
    <?php echo link_tag('assets/plugins/toastr/build/toastr.css'); ?>
    <?php echo link_tag('assets/plugins/toaster/garessi-notif.css'); ?>

</head>

<body style="background-color: #277336;">

    <!--app open-->
    <div id="app" class="page">
        <section class="section">
            <div class="container">
                <div class="">

                    <!--single-page open-->
                    <div class="single-page">
                        <div class="">
                            <div class="wrapper wrapper2 card-body" style="background:#ffffff;">
                                <?php if ($this->session->flashdata('error')) { ?><p onload="myFunction()"></p>
                                <?php } ?>
                                <?php echo form_open('Manage_login');?>

                                <h3 class="text-dark">
                                    <img src="<?php echo base_url('assets/img/brand/logo_main.png'); ?>" width="175px;"
                                        alt="" title="" />
                                </h3>
                                <div class="mail">
                                    <input type="text" class="form-control" name='emailid' id="exampleInputEmail1"
                                        placeholder="Enter Username" required>
                                </div>
                                <div class="passwd">
                                    <input type="password" name='password' class="form-control"
                                        id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <!--<p class="mb-3 text-right"><a href="#">Forgot Password</a></p>-->
                                <button class="btn btn-primary btn-block" type="submit">Login</button>
                                <div class="signup mb-0">
                                    <!--<p class="text-dark mb-0">Don't have account?<a href="register.html" class="text-primary ml-1">Sign UP</a></p>-->
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!--single-page closed-->

                </div>
            </div>
        </section>
    </div>
    <!--app closed-->

    <!--Jquery.min js-->
    <script src="assets/js/jquery.min.js"></script>

    <!--popper js-->
    <script src="assets/js/popper.js"></script>

    <!--Bootstrap.min js-->
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Tooltip js-->
    <script src="assets/js/tooltip.js"></script>

    <!-- Jquery star rating-->
    <script src="assets/plugins/rating/jquery.rating-stars.js"></script>

    <!--Jquery.nicescroll.min js-->
    <script src="assets/plugins/nicescroll/jquery.nicescroll.min.js"></script>

    <!--Scroll-up-bar.min js-->
    <script src="assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js"></script>

    <script src="assets/js/moment.min.js"></script>

    <!--mCustomScrollbar js-->
    <script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!--Toastr js-->
    <script src="<?php echo base_url('assets/plugins/toastr/build/toastr.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/toaster/garessi-notif.js'); ?>"></script>

    <!--Horizontalmenu js-->
    <script src="assets/plugins/horizontal-menu/webslidemenu.js"></script>

    <!--Showmore js-->
    <script src="assets/js/jquery.showmore.js"></script>

    <!--Scripts js-->
    <script src="assets/js/scripts.js"></script>

    <?php include APPPATH.'views/includes/toast.php';?>
</body>

</html>