

<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Apps</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->	
    <link rel="icon" href="#">
    <!--===============================================================================================-->
    <link href="<?php echo base_url(); ?>assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <!--===============================================================================================-->
	<style>
		.no-js #loader { display: none;  }
		.js #loader { display: block; position: absolute; left: 100px; top: 0; }
		.se-pre-con {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url(<?php echo base_url(); ?>assets/images/Preloader_3.gif) center no-repeat #fff;
		}
	</style>
</head>
<body>
<div class="se-pre-con"></div>
	<div class="limiter">

		<div class="container-login100">
			<div class="wrap-login100">

				<!-- Preloader - style you can find in spinners.css -->
				<div class="loader">
					<!-- <svg class="circular" viewBox="25 25 50 50">
						<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" 
						stroke-miterlimit="10" /> </svg> -->
				</div>

                <?php echo form_open('auth/auth_login', ['class' => 'login100-form']); ?>
					<span class="login100-form-title p-b-34">
						 <img src="<?php echo base_url() ?>assets/images/images.png" alt="Image" class="img-fluid">
					</span>
                    
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="email" placeholder="Email">					
    					<span class="#">
							<?php 
								echo $this->session->flashdata('error');
								echo form_error('email'); 
							?>
						</span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="#"><?php echo form_error('password'); ?></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-200">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a>
					</div>
                <?php echo form_close(); ?>

				<div class="login100-more" style="background-image: url('<?php echo base_url(); ?>assets/images/background/bg-02.jpg');"></div>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
    <!-- <script src="<?php //echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script> -->
<!--===============================================================================================-->
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

	<script>
		$(window).load(function() {
			// Animate loader off screen
			$(".se-pre-con").fadeOut("slow");;
		});
	</script>

</body>
</html>