<?php
	include 'header.php'; 
 ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Edit User</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li>
					<span>Edit User</span>
				</li>
				<li>
					<span>User</span>
				</li>
			</ol>
			<a class="sidebar-right-toggle" data-open="sidebar-right">
				<i class="fa fa-chevron-left"></i>
			</a>
		</div>
	</header>
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
					</div>
					<h2 class="panel-title">Edit User</h2>
				</header>
				<div class="panel-body">
					<?php 

			            echo form_open_multipart('Vendor/submiteditusers',array('class' => 'form-horizontal','id' => 'usermaster'));

			        ?>
					<?php echo $this->session->flashdata('success'); ?>
					<?php  
					    $vendoremail = $this->session->userdata('username');
					    
					    $getdetails = $this->db->query("SELECT * FROM tblvendors WHERE email='$vendoremail'");
					    $row = $getdetails->row();
					?>
					<div class="row">
						<div class="col-md-5 col-md-offset-1">
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Email *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php echo $this->session->userdata('username'); ?>">
									<span class="text-danger">
										<?php echo form_error('email'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Name</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?php echo $row->vendorname;  ?>">
									<span class="text-danger">
										<?php echo form_error('name'); ?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 1</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="address1" id="address1" placeholder="Enter Address" value="<?php echo $row->Address1; ?>">
									<span class="text-danger">
										<?php echo form_error('address1'); ?>
									</span>
								</div>
							</div>
                            
                            <div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">City</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="<?php echo $row->city; ?>">
									<span class="text-danger">
										<?php echo form_error('city'); ?>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Landline</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="landline" id="landline" placeholder="Enter Landline" value="<?php echo $row->landline; ?>">
									<span class="text-danger">
										<?php echo form_error('landline'); ?>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Webiste</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="website" id="website" placeholder="Enter Website" value="<?php echo $row->website; ?>">
									<span class="text-danger">
										<?php echo form_error('website'); ?>
									</span>
								</div>
							</div>
                            
							<input type="hidden" class="form-control" name="vendorid" id="vendorid" placeholder="Enter vendorid" value="<?php echo $row->vendorid;  ?>">
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Password</label>
								<div class="col-sm-7">
									<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" value="">
									<span class="text-danger">
										<?php echo form_error('password'); ?>
									</span>
								</div>
							</div>
                            <div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Contact Person</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="cperson" id="cperson" placeholder="Enter Contact Person" value="<?php echo $row->contact_person; ?>">
									<span class="text-danger">
										<?php echo form_error('cperson'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 2</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="address2" id="address2" placeholder="Enter Address" value="<?php echo $row->Address2;  ?>">
									<span class="text-danger">
										<?php echo form_error('address2'); ?>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Pincode</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode" value="<?php echo $row->pincode;  ?>">
									<span class="text-danger">
										<?php echo form_error('pincode'); ?>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Mobile</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="<?php echo $row->mobile; ?>">
									<span class="text-danger">
										<?php echo form_error('mobile'); ?>
									</span>
								</div>
							</div>
							<div>&nbsp;</div>	
							<div>&nbsp;</div>
                            <div>&nbsp;</div>
							
						</div>
						<center>
						<div class="form-group">
								<label class="col-md-3 control-label"></label>
								<div class="col-md-6 col-xs-11">
									<button type="submit"  class="btn btn-primary">Update</button>
								</div>
							</div>
							</center>
						</div>	
					</form>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
											
					</div>
				</section>
			</div>
		</div>
<script type="text/javascript">
	

</script>
<?php
 include 'footer.php'; 
 ?>
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">

    $("document").ready(function(){
	
		
        
    });

</script>