<?php
 include 'header.php'; 

 ?>

		<section role="main" class="content-body">
			<header class="page-header">
				<h2>Add Places</h2>
			
				<div class="right-wrapper pull-right">
					<ol class="breadcrumbs">
						<li>
							<a href="dashboard">
								<i class="fa fa-home"></i>
							</a>
						</li>
						<li><span>Add Places</span></li>
						<li><span>Place's</span></li>
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
				
								<h2 class="panel-title">Add Places</h2>
							</header>
							
							<div class="panel-body">
								
								<?php 
						            echo form_open_multipart('Admin/submitplaces',array('class' => 'form-horizontal'));
						        ?>

						        <?php echo $this->session->flashdata('success'); ?>

						        <div class="row">
						            <div class="col-md-5 col-md-offset-1">
                                        

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Place Name</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="pname" id="pname" placeholder="Enter Place" value="<?php echo set_value('pname'); ?>">
											  <span class="text-danger"><?php echo form_error('pname'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Longitude</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="longitude" id="fname" placeholder="Longitude" value="<?php echo set_value('longitude'); ?>">
											  <span class="text-danger"><?php echo form_error('longitude'); ?></span>
							                </div>
						                </div>


						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Latitude</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="latitude" id="fname" placeholder="Latitude" value="<?php echo set_value('latitude'); ?>">
											  <span class="text-danger"><?php echo form_error('latitude'); ?></span>
							                </div>
						                </div>
                                        
                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Place Description</label>
							                <div class="col-sm-7">
							                  <textarea class="form-control" name="description" id="description"  ><?php echo set_value('description'); ?></textarea>
											  <span class="text-danger"><?php echo form_error('description'); ?></span>
							                </div>
						                </div>
										

						            </div>
						            <div class="col-md-5">

						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">City</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="<?php echo set_value('city'); ?>">
											  <span class="text-danger"><?php echo form_error('city'); ?></span>
							                </div>
						                </div>

						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address</label>
							                <div class="col-sm-7">
							                  <textarea class="form-control" name="address" id="address"  ><?php echo set_value('address'); ?></textarea>
											  <span class="text-danger"><?php echo form_error('address'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Other Information</label>
							                <div class="col-sm-7">
							                  <textarea class="form-control" name="oinfo" id="oinfo"  ><?php echo set_value('oinfo'); ?></textarea>
											  <span class="text-danger"><?php echo form_error('oinfo'); ?></span>
							                </div>
						                </div>
                                        
                                        <div>&nbsp;</div>
                                        
						            </div>	
						        </div>
                                 <!--
						         <div class="form-group" style="margin-right: 442px;">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Places Image</label>
					                <div class="col-sm-7">
					                    <?php //echo form_error('uploadedimages[]'); ?>
                                        <?php //echo form_upload('uploadedimages[]','','multiple'); ?>
									  <span class="text-danger"><?php //echo form_error('userfile'); ?></span>
					                </div>
				                </div>-->
                                <div>&nbsp;</div>
								<center>
                                	<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-6 col-xs-11">
											<button type="submit"  class="btn btn-primary hidden-xs">Submit</button>
										</div>
									</div>
                                </center>										
								</form>
                                
                                <div>&nbsp;</div>
	                            <div>&nbsp;</div>

	                            <h2 class="panel-title">Places Data</h2>
	                            <hr>
	                            <div>&nbsp;</div>

	                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Place</th>
											<th>Address</th>
											<th>city </th>
											<th>Latitude</th>
											<th>Longitude</th>
											<th>Description</th>
											<th>Other Information</th>
											<th>Add Photos</th>
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
										
											

											foreach ($results->result() as $k) {
												# code...
											
											
										?>
										<tr>
											<td><?php echo $k->place; ?></td>
											<td><?php echo $k->address; ?></td>
											<td><?php echo $k->city; ?></td>
											<td><?php echo $k->latitude; ?></td>
											<td><?php echo $k->longitude; ?></td>
											<td><?php echo $k->description; ?></td>
											<td><?php echo $k->otherinfo; ?></td>
											
											
											
											<td><a href="<?php echo site_url(); ?>admin/addplacesphotos/<?php echo $k->plid; ?>">Add Pics to this Places</a></td>
											<td class="center hidden-phone">
												<a href="<?php echo site_url(); ?>admin/editaddplaces/<?php echo $k->plid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deleteplacesid(<?php echo $k->plid; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</section>
					</div>
				</div>


	<script type="text/javascript">
    function deleteplacesid(id)
    {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deleteplacesid")?>',
		      data: {
		             
		             uid:uid
		            },
		      success: function(res) {
		      //alert(res); 
		      location.reload();
		      }
	        }); 

	    } else {
	        location.reload();
	    }
    }

	</script>
						
								
<?php
 include 'footer.php'; 

 ?>