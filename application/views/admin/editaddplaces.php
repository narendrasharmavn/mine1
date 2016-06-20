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
								<li><span>Edit Event Data</span></li>
								
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
						
										<h2 class="panel-title">Event Edit</h2>
									</header>
									<div class="panel-body">
										
										<?php

								            echo form_open_multipart('Admin/submiteditaddplaces',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         <?php
								            $placeid = $this->uri->segment(3, 0); 
											//echo $placeid;
											$query = $this->db->query("SELECT * FROM tblplaces WHERE plid='$placeid'");
											$rows = $query->row(); 
											//$name = $rows->itemname;
							
								         ?>
									
								         
										 
											<input type="hidden" class="form-control" name="plid" id="plid"  value="<?php echo $rows->plid; ?>">
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">place Name</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="pname" id="pname" placeholder="Enter Location" value="<?php echo $rows->place; ?>">
												  <span class="text-danger"><?php echo form_error('pname'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="address" id="address"  ><?php echo $rows->address; ?></textarea>
												  <span class="text-danger"><?php echo form_error('address'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">City</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="city" id="city" placeholder="Enter event name" value="<?php echo $rows->city; ?>">
												  <span class="text-danger"><?php echo form_error('city'); ?></span>
								                </div>
								               
							                </div>

							                

							                

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Latitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="latitude" id="fname" placeholder="Latitude" value="<?php echo $rows->latitude; ?>">
												  <span class="text-danger"><?php echo form_error('latitude'); ?></span>
								                </div>
							                </div>
                                            
                                            <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Longitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="longitude" id="fname" placeholder="Longitude" value="<?php echo $rows->longitude; ?>">
												  <span class="text-danger"><?php echo form_error('longitude'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="description" id="description"  ><?php echo $rows->description; ?></textarea>
												  <span class="text-danger"><?php echo form_error('description'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Other Information</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="oinfo" id="oinfo"  ><?php echo $rows->otherinfo; ?></textarea>
												  <span class="text-danger"><?php echo form_error('oinfo'); ?></span>
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


	<script type="text/javascript">

	    



	</script>
						
								
<?php
 include 'footer.php'; 

 ?>

 <script type="text/javascript">

    $(document).ready(function(){
		
    });

 </script>