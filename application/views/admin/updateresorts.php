<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Update Resorts</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Add Resorts</span></li>
								<li><span>Event's</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
						
										<h2 class="panel-title">Add Resorts</h2>
									</header>
									
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/submitupdateresorts',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?>
								         <?php 
                                           $resortid = $resortid;
								           $query = $this->db->query("SELECT * FROM tblresorts WHERE resortid='$resortid'");
								           $row = $query->row();
								           $vendorid = $row->vendorid;
                                           $resortname = $row->resortname;
                                           $location = $row->location;
                                           $description = $row->description;
                                           $latitude = $row->latitude;
                                           $longitude = $row->longitude;
                                           $getvendorname = $this->db->query("SELECT * FROM tblvendors WHERE vendorid='$vendorid'");
                                           $gvn = $getvendorname->row();
                                           $vendorname = $gvn->vendorname;
                                           
								         ?>
                                         <input type="hidden" class="form-control" name="resortid" id="resortid"  value="<?php echo $resortid; ?>">
								         <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Vendor Name</label>
								                <div class="col-sm-7 col-xs-7">
								                  <select class="form-control" name="vendorid" id="fname" >
								                  	<option value="">Select Vendor Name</option>
								                  	<?php
													foreach ($vendors->result() as $k) {
															//echo $k->vendorid."<br>";
														?>
														<option value="<?php echo $k->vendorid ?>" <?php if($vendorid == $k->vendorid ) { echo "Selected";}?>><?php echo $k->vendorname; ?></option>

														<?php
													}
													?>
								                  	
								                  </select>
												  <span class="text-danger"><?php echo form_error('vname'); ?></span>
								                </div>
								               
							                </div> 
										 
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Resort Name</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="text" class="form-control" name="resortname" id="resortname"  value="<?php echo $resortname; ?>">
												  <span class="text-danger"><?php echo form_error('resortname'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Location</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="location" id="location"  value="<?php echo $location; ?>">
												  <span class="text-danger"><?php echo form_error('location'); ?></span>
								                </div>
								               
							                </div>
											
											

							                

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="description" id="description"  ><?php echo $description; ?></textarea>
												  <span class="text-danger"><?php echo form_error('description'); ?></span>
								                </div>
							                </div>


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Latitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="latitude" id="fname" placeholder="Latitude" value="<?php echo $latitude; ?>">
												  <span class="text-danger"><?php echo form_error('latitude'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Longitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="longitude" id="fname" placeholder="Longitude" value="<?php echo $longitude; ?>">
												  <span class="text-danger"><?php echo form_error('longitude'); ?></span>
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