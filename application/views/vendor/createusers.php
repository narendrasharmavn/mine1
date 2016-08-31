<?php
	include 'header.php'; 
 ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Create Users</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li>
					<span>Create Users</span>
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
					<h2 class="panel-title">Create Users</h2>
				</header>
				<div class="panel-body">
					<?php 

			            echo form_open_multipart('Vendor/submitcreateusers',array('class' => 'form-horizontal','id' => 'usermaster'));

			        ?>
					<?php echo $this->session->flashdata('success'); ?>

					
					<div class="row">
						<div class="col-md-5 col-md-offset-1">
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Name *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="">
									<span class="text-danger">
										<?php echo form_error('username'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Department</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="department" id="department" placeholder="Enter Department" value="">
									<span class="text-danger">
										<?php echo form_error('department'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Email</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="">
									<span class="text-danger">
										<?php echo form_error('email'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">User Type *</label>
								<div class="col-sm-7">
									<select class="form-control" name="usertype" >
			                           <option value="">Select User Type</option>
			                           <option value="booking">Booking</option>
			                           <option value="security">Security</option>
			                        </select>
									<span class="text-danger">
										<?php echo form_error('email'); ?>
									</span>
								</div>
							</div>
							
							<input type="hidden" class="form-control" name="vendorid" id="vendorid" placeholder="Enter Vendorid" value="<?php echo $this->session->userdata('vendorid'); ?>">
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
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Designation</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation" value="">
									<span class="text-danger">
										<?php echo form_error('designation'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Mobile</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="">
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
									<button type="submit"  class="btn btn-primary">Submit</button>
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
	
		$("#usermaster").validate({
    
          
        // Specify the validation rules
        rules: {
            username: "required",
			password: "required",
			usertype: "required",
			email: "required"
			
			
		},
        
        // Specify the validation error messages
        messages: {
            username: "UserName Should not be Empty",
			password: "Password Should not be Empty",
			usertype: "Usertype Should not be Empty",
			email: "Email Should not be Empty"
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
        
    });

</script>