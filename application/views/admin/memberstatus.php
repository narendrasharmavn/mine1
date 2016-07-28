<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Edit</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Member Status</span></li>
								
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
						
										<h2 class="panel-title">Member Status</h2>
									</header>
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/submitmemberstatus',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
											

							               
                                            <div class="form-group">
								                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
								                <div class="col-sm-4">
								                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="">
								                </div>
							                </div>
	
							                <div class="form-group">
								                <label for="inputPassword3" class="col-sm-2 control-label">Member Status</label>
								                <div class="col-sm-4">
								                    <select class="form-control" name="mstatus" id="mstatus">
								                      <option value="" <?php echo  set_select('mstatus', 'Select'); ?>>Select</option>
								                      <option value="Active" <?php echo  set_select('mstatus', 'Active'); ?>>Active</option>
								                      <option value="Deactive" <?php echo  set_select('mstatus', 'Deactive'); ?>>Deactive</option>
								                    </select>
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


	<script type="text/javascript">

	    



	</script>
						
								
<?php
 include 'footer.php'; 

 ?>