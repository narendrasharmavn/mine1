<!Doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?php echo base_url(); ?>assets/assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				
					<h3 class="logo pull-left" style="color: #0088cc;">Book4Holiday Staff login</h3>
				

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						
						<?php 
				          echo form_open('Staff/submitlogin',array('class' => 'form-horizontal'));

				        ?>
				        <?php echo $this->session->flashdata('success'); ?> 
							<div class="form-group mb-lg">
								<label>Select Login Type</label>
								<div class="input-group input-group-icon">
									<select name="usertype" class="form-control input-lg" onchange="showLink(this.value)">
										<option value="">Select</option>
										<option value="booking">Booking</option>
										<option value="security">Security</option>
									</select>
									
									
								</div>
							</div>
							
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									
									<input name="username" type="text" class="form-control input-lg"  />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<!--<a href="pages-recover-password.html" class="pull-right">Lost Password?</a>-->
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
						<!--		<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>  -->
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>

								</div>
							<div class="col-sm-4 text-right" id="showlink">
									<!--<a href="<?php //echo base_url(); ?>index.php/admin/forgotpassword">Forgot Password</a>-->
								</div>
							</div>

							
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo base_url(); ?>assets/assets/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url(); ?>assets/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url(); ?>assets/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url(); ?>assets/assets/javascripts/theme.init.js"></script>

	</body>
<script type="text/javascript">
function showLink(x)
{
   
}
</script>
</html>
<script type="text/javascript">
$("document").ready(function(){
   //$('#showlink').hide();
});
</script>