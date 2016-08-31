
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Holiday App Admin Panel</title>
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

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/morris/morris.css" />

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/stylesheets/theme.css" />

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/summernote/summernote-bs3.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?php echo base_url(); ?>assets/assets/vendor/modernizr/modernizr.js"></script>
		<script src="<?php echo base_url();  ?>assets/js/datetimepicker_css.js"></script>
		
		<!-- drop zone css -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="<?php echo site_url(); ?>admin/dashboard" class="logo">
						<!--<img src="<?php echo base_url(); ?>assets/assets/images/logo.png" height="35" alt="Porto Admin" />-->
						<h4>Holiday Application Staff</h4>
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
				
			
					<span class="separator"></span>
			
				
					<span class="separator"></span>
			        <?php 
			        $usertype=$this->session->userdata('usertype');
			        //echo $usertype;
			        $username=$this->session->userdata('email');
			        //echo $username;
			        $vendorid = $this->session->userdata('vendorid');

			        ?>
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo base_url(); ?>assets/assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="<?php echo base_url(); ?>assets/assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $username; ?></span>
								<span class="role"><?php echo $usertype; ?></span>
								
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<!--<li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>-->
								<li>
									<a role="menuitem" tabindex="-1" href="logout"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
