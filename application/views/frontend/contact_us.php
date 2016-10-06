

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    <title>Book4Holiday - Terms and Condtions</title>

    <script src="https://use.fontawesome.com/3ad883fb7d.js"></script>


  <!--  <script src="<?php echo base_url(); ?>/assets/frontend/fontawesome/fonts.js"></script>-->


    <!-- BASE CSS -->
    <link href="<?php echo base_url(); ?>/assets/frontend/css/base.css" rel="stylesheet" type="text/css" media="all" >

    <!-- Google web fonts -->
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <!-- REVOLUTION SLIDER CSS -->
    <link href="<?php echo base_url(); ?>/assets/frontend/rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/extralayers.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/slider-pro.min.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/date_time_picker.css" rel="stylesheet" type="text/css" media="all" >
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>/assets/frontend/js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>/assets/frontend/js/theia-sticky-sidebar.js'></script>



    
      <script src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyA-hMJfrFKuq7zQy30m0GBdzKSMl9qcxIo"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/frontend/style.css">
    

</head>
<style type="text/css">
 
  @media print
  {    
      #printbtn
      {
          display: none !important;
      }
  }
</style>

<div class="container margin_60" style="margin-top:80px;">
	<div class="row">
		<div class="col-md-8 col-sm-8">
			<div class="form_title">
				<h3><strong><i class="icon-pencil"></i></strong>Fill the form below</h3>
				
			</div>
			<div class="step">
            
				<div id="message-contact"></div>
				<form method="post" action="assets/contact.php" id="contactform">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="Enter Name">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" class="form-control" id="lastname_contact" name="lastname_contact" placeholder="Enter Last Name">
							</div>
						</div>
					</div>
					<!-- End row -->
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" id="email_contact" name="email_contact" class="form-control" placeholder="Enter Email">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Phone</label>
								<input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="Enter Phone number">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Message</label>
								<textarea rows="5" id="message_contact" name="message_contact" class="form-control" placeholder="Write your message" style="height:200px;"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="margin-bottom:20px;">
							<label>Human verification</label>
							<input type="text" id="verify_contact" class=" form-control add_bottom_30" placeholder="Are you human? 3 + 1 =">
							<input type="submit" value="Submit" class="btn_1" id="submit-contact">
						</div>
					</div>
				</form>
			</div>
		</div><!-- End col-md-8 -->
        
		<div>&nbsp;</div>
		
		<div class="col-md-4 col-sm-4">
			<div class="box_style_1">
				<span class="tape"></span>
				<h4>Address <span><i class="icon-pin pull-right"></i></span></h4>
				<p><b>Book4holiday</b></br>
					A unit of Adepto Geoinformatics Pvt. Ltd.</br>
					8-2-686/K/21, S-1, III rd Floor</br>
					Ashok Asha Abode,Behind Fortune Hotel</br>
					Road no.12, Banjara Hills, Hyderabad &ndash; 500 034</br>
					Ph: 040 -23393131, E: <a href="mailto:info@adeptogeoit.com">info@adeptogeoit.com</a></br>
				</p>
				<hr>
				<h4>Help center <span><i class="icon-help pull-right"></i></span></h4>
				<ul id="contact-info">
					<li>+ 91 91234 67890 </li>
					<li><a href="#">info@book4holiday.com</a></li>
				</ul>
			</div>
			<div class="box_style_4" style="margin-bottom: 20px;">
				<!-- <i class="icon_set_1_icon-57"></i> -->
				<h4>Need <span>Help?</span></h4>
				<a href="tel://919123467890" class="phone">+ 91 91234 67890 </a>
				<small style="font-size:12px;">Monday to Friday 9.00am - 7.30pm</small>
			</div>
		</div><!-- End col-md-4 -->
	</div><!-- End row -->
</div>


    
 <?php include 'footer.php'; ?>

<div id="toTop"></div><!-- Back to top button -->

<?php
     include 'scripts.php';
      ?>

        </body>

</html>
