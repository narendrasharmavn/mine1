<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Create Member</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Create Member</span></li>
								<li><span></span></li>
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
						
										<h2 class="panel-title">Member</h2>
									</header>
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/submitstaff',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 

								            <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo set_value('name'); ?>">
								                </div>
							                </div>

											<div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
								                </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
								                <div class="col-sm-3">
								                  <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
								                </div>
							                </div>

							                
                                            <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Mobile Number</label>
								                <div class="col-sm-3">
								                  <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo set_value('mobile'); ?>">
								                </div>
							                </div>

											
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="submit"  class="btn btn-primary">Submit</button>
												</div>
											</div>											
										</form>
									</div>
								</section>
							</div>
						</div>



						
								
<?php
 include 'footer.php'; 

 ?>