<?php
	include 'header.php'; 
 ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Edit Tax Master</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li>
					<span>Edit Tax Master</span>
				</li>
				<li>
					<span>Tax Master</span>
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
					<h2 class="panel-title">Edit Tax Master</h2>
				</header>
				<div class="panel-body">
					<?php 

			            echo form_open_multipart('Admin/submitedittaxmaster',array('class' => 'form-horizontal'));

			        ?>
					<?php echo $this->session->flashdata('success'); ?>
					<?php  
					    $gettax = $this->db->query("SELECT * FROM taxmaster");
					    $row = $gettax->row();
					?>
					<div class="row">
						<div class="col-md-5 col-md-offset-1">
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Service Tax *</label>
								<div class="col-sm-7">
									<input type="number" class="form-control" name="servicetax" id="servicetax" placeholder="Enter Service Tax" value="<?php echo $row->servicetax; ?>">
									<span class="text-danger">
										<?php echo form_error('servicetax'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label pull-left">Krishi Kalyan Cess *</label>
									<div class="col-sm-7">
										<input type="number" class="form-control" name="kkcess" id="kkcess" placeholder="Enter Krishi Kalyan Cess" value="<?php echo $row->krishicess; ?>">
										<span class="text-danger">
											<?php echo form_error('kkcess'); ?>
										</span>
									</div>
							</div>
							
							<input type="hidden" class="form-control" name="taxid" id="taxid" placeholder="Enter Taxid" value="<?php echo $row->taxid; ?>">
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label pull-left">Swachh Bharath Cess *</label>
								<div class="col-sm-7">
									<input type="number" class="form-control" name="sbcess" id="sbcess" placeholder="Enter Swachh Bharath" value="<?php echo $row->swachcess; ?>">
									<span class="text-danger">
										<?php echo form_error('sbcess'); ?>
									</span>
								</div>
							</div>
							<div class="form-group">
									<label for="inputEmail3" class="col-sm-5 control-label pull-left">Kid Meal Tax *</label>
									<div class="col-sm-7">
										<input type="number" class="form-control" name="kmtax" id="kmtax" placeholder="Enter Kid Meal Tax" value="<?php echo $row->kidsmealtax; ?>">
										<span class="text-danger">
											<?php echo form_error('kmtax'); ?>
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