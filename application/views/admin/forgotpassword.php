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
				<h3 class="logo pull-left" style="color: #0088cc;">Book4Holiday Vendor login</h3>
				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Forgot password</h2>
					</div>
					<div class="panel-body">
						
						<?php 
				          echo form_open('Admin/submitfogotpassword',array('class' => 'form-horizontal','id' => 'forgotpassword'));

				        ?>
				        <?php echo $this->session->flashdata('success'); ?> 
							

							<div class="form-group mb-lg">
								<label>Email</label>
								<div class="input-group input-group-icon">
									<input name="email" id="email" type="text" class="form-control input-lg"  />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
                                                                       
								</div>
                                                                <span class="text-danger">
										<?php echo form_error('packagetype'); ?>
									</span>
							</div>

							<div class="row">
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs" id="submit">Submit</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" id="submit">Submit</button>
								</div>
							</div>
						</form>

						
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. All Rights Reserved.</p>
			</div>
		</section>
	<?php
 include 'footer.php'; 
 ?>
<script type="text/javascript">
var $j = jQuery.noConflict();
$("document").ready(function(){
   $j("#forgotpassword").validate({
       // Specify the validation rules
        rules: {
             email: "required"
        },
        // Specify the validation error messages
        messages: {
             email: "Please Enter Email"
        },
        submitHandler: function(form) {
            form.submit();
        }
   });
   
});
</script>