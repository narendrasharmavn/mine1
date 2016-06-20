<?php
 include 'header.php';
 $id = $_GET['id']; 

 $delete =  $_GET['delete'];

 if ($delete=="yes") {
 	//delete the id
 	$sql = "DELETE FROM memberreg WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    //echo "Record deleted successfully";
   
    ?>
    <script type="text/javascript">
    window.location = "activitiesdata.php";
    </script>

    <?php
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
 }


 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Member edit</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Membership Registration Management</span></li>
								<li><span>Member edit</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Member Edit</h2>
									</header>
									<div class="panel-body">
										<?php
										if (isset($_POST['fname'])) {
											//echo "<h1>Activity</h1>";
											$fname = addslashes($_POST['fname']);
											$lname = addslashes($_POST['lname']);
											$number = addslashes($_POST['number']);
											$anumber = addslashes($_POST['anumber']);
											$email = addslashes($_POST['email']);
											$dob = addslashes($_POST['dob']);
											$address = addslashes($_POST['address']);
											$status="1";
											$dateofentry = date("Y:m:d h:i:s");
											
											$sql = "UPDATE memberreg SET fname='$fname' , lname='$lname', mobile='$number',email='$email',dateofbirth='$dob',address='$address',altcontact='$anumber' WHERE id='$id'";

											if (mysqli_query($conn, $sql)) {
											    echo "Record updated successfully<br>";
											} else {
											    echo "Error updating record: " . mysqli_error($conn);
											}

												

										}
										?>

										<?php
										$sql = "SELECT * FROM memberreg WHERE id='$id'";
										$result = mysqli_query($conn, $sql);

										if (mysqli_num_rows($result) > 0) {
										    // output data of each row
										    $row = mysqli_fetch_assoc($result);
										     $fname =  $row["fname"];
										     $lname =  $row["lname"];
										     $mobile =  $row["mobile"];
										     $email =  $row["email"];
										     $dateofbirth =  $row["dateofbirth"];
										     $address =  $row["address"];
										     $alternatenumber =  $row["altcontact"];
										    
										    
										} else {
										    echo "No data";
										}

										?>
										
										<form class="form-horizontal form-bordered" method="POST" action="">
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">First Name</label>
												<div class="col-md-6">
													<input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control" id="inputDefault" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Last Name</label>
												<div class="col-md-6">
													<input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control" id="inputDefault" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Mobile Number</label>
												<div class="col-md-6">
													<input type="text" name="number" value="<?php echo $mobile; ?>" class="form-control" id="inputDefault" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Alternate Contact Number</label>
												<div class="col-md-6">
													<input type="text" name="anumber" value="<?php echo $alternatenumber; ?>" class="form-control" id="inputDefault" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Email</label>
												<div class="col-md-6">
													<input type="text" name="email" value="<?php echo $email; ?>" class="form-control" id="inputDefault" required>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Date of Birth</label>
												<div class="col-md-6">
													<input type="date" name="dob" value="<?php echo $dateofbirth; ?>" class="form-control" id="inputDefault" required>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Address</label>
												<div class="col-md-6">
													<textarea name="address" class="form-control" id="inputDefault" rows="6" required><?php echo $address; ?></textarea>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="submit"  class="btn btn-primary hidden-xs">Update</button>
												</div>
											</div>											
										</form>
									</div>
								</section>
							</div>
						</div>
						
								

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
	<?php  

mysqli_close($conn);
	 ?>
</html>