<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<title>Unilever</title>

	<!--Favicon -->
	<link rel="icon" href="<?php echo base_url('assets/img/brand/unilever.png'); ?>" type="image/x-icon" />

	<!--Bootstrap.min css-->
	<?php echo link_tag('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>

	<!--Style css-->
	<?php echo link_tag('assets/css/mystyle.css'); ?>
	<?php echo link_tag('assets/css/style.css'); ?>

	<!--Icons css-->
	<?php echo link_tag('assets/css/icons.css'); ?>

	<!--mCustomScrollbar css-->
	<?php echo link_tag('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css'); ?>

	<!--Sidemenu css-->
	<?php echo link_tag('assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet'); ?>
	<?php echo link_tag('assets/plugins/horizontal-menu/webslidemenu.css" rel="stylesheet'); ?>

	<!--Toastr css-->
	<?php echo link_tag('assets/plugins/toastr/build/toastr.css'); ?>
	<?php echo link_tag('assets/plugins/toaster/garessi-notif.css'); ?>
	<style>
		.yel-btn {
			background: #fde642;
			color: black;
			font-size: 20px;
			font-weight: bold;
			text-transform: uppercase;
			font-family: unset;
		}

		input[type=text],
		input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #0e0ef2;
			box-sizing: border-box;
			border-radius: 5px;
		}

		button {
			background-color: #0e0ef2;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
			border-radius: 5px;
		}
	</style>

</head>

<body class="bg-login">

	<!--app open-->
	<!-- <div id="app" class="page">
		<section class="section">
		<div class="container">
					<div class="">
					<?php echo form_open('Manage_login', 'margin: 355px auto 0 auto;width: 300px;'); ?>
						  

						  <div class="container">
						    <input type="text" placeholder="Enter Username" name="emailid" required>

						    <input type="password" placeholder="Enter Password" name="password" required>
						        <a href="<?php echo base_url() ?>Manage_login/forgot_password" style="color:#fff; text-align: right">Forget Password</a>
						    <button type="submit" class="yel-btn">Login</button>
						   
						  </div>
						</form>
					</div>
				</div>
		</section>
	</div> -->
	<div class="container">
		<div class="">
			<!-- <form action="/action_page.php" method="post" style="margin: 355px auto 0 auto;width: 300px;"> -->
			<?php echo form_open('Manage_login', 'style="margin: 355px auto 0 auto;width: 300px;"'); ?>

			<div class="container">
				<input type="text" placeholder="Enter Username" name="emailid" required>

				<input type="password" placeholder="Enter Password" name="password" required>
				<a href="<?php echo base_url() ?>Manage_login/forgot_password" style="color:#fff; text-align: right">Forgot Password</a>
				<button type="submit" class="yel-btn">Login</button>

			</div>

		</div>
		</form>
	</div>
	</div>
	<!--app closed-->

	<script src="<?php echo base_url(''); ?>"></script>

	<!--Jquery.min js-->
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

	<!--popper js-->
	<script src="<?php echo base_url('assets/js/popper.js'); ?>"></script>

	<!--Bootstrap.min js-->
	<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>

	<!--Tooltip js-->
	<script src="<?php echo base_url('assets/js/tooltip.js'); ?>"></script>

	<!-- Jquery star rating-->
	<script src="<?php echo base_url('assets/plugins/rating/jquery.rating-stars.js'); ?>"></script>

	<!--Jquery.nicescroll.min js-->
	<script src="<?php echo base_url('assets/plugins/nicescroll/jquery.nicescroll.min.js'); ?>"></script>

	<!--Scroll-up-bar.min js-->
	<script src="<?php echo base_url('assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js'); ?>"></script>

	<script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>

	<!--mCustomScrollbar js-->
	<script src="<?php echo base_url('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>

	<!--Toastr js-->
	<script src="<?php echo base_url('assets/plugins/toastr/build/toastr.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/plugins/toaster/garessi-notif.js'); ?>"></script>

	<!--Horizontalmenu js-->
	<script src="<?php echo base_url('assets/plugins/horizontal-menu/webslidemenu.js'); ?>"></script>

	<!--Showmore js-->
	<script src="<?php echo base_url('assets/js/jquery.showmore.js'); ?>"></script>

	<!--Scripts js-->
	<script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>

	<?php include APPPATH . 'views/includes/toast.php'; ?>
</body>

</html>