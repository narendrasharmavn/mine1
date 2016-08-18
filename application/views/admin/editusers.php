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

			            echo form_open_multipart('Admin/submiteditusers',array('class' => 'form-horizontal'));

			        ?>
					<?php echo $this->session->flashdata('success'); ?>
					<?php  
					    $adminname = $this->session->userdata('username');
					    
					    $getuser = $this->db->query("SELECT * FROM tblusers WHERE username='$adminname'");
					    $row = $getuser->row();
					?>
					<div class="row">
						<div class="col-md-5 col-md-offset-1">
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Username *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?php echo $this->session->userdata('username'); ?>">
									<span class="text-danger">
										<?php echo form_error('username'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Department *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="department" id="department" placeholder="Enter Department" value="<?php echo $row->department; ?>">
									<span class="text-danger">
										<?php echo form_error('department'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Email  *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php echo $row->email; ?>">
									<span class="text-danger">
										<?php echo form_error('email'); ?>
									</span>
								</div>
							</div>
							<input type="hidden" class="form-control" name="userid" id="userid" placeholder="Enter Userid" value="<?php echo $row->userid; ?>">
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Password *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="password" id="password" placeholder="Enter Password" value="<?php echo $row->password; ?>">
									<span class="text-danger">
										<?php echo form_error('password'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Designation *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation" value="<?php echo $row->designation; ?>">
									<span class="text-danger">
										<?php echo form_error('designation'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Mobile *</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="<?php echo $row->mobile; ?>">
									<span class="text-danger">
										<?php echo form_error('mobile'); ?>
									</span>
								</div>
							</div>
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
<script type="text/javascript">

    $("document").ready(function(){

        
    });

</script>