<?php
    include 'header.php'; 
?>

	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Add Vendors</h2>
		
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li>
						<a href="dashboard">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Add Vendors</span></li>
					<li><span>Vendor's</span></li>
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
			
							<h2 class="panel-title">Add Vendors</h2>
						</header>
						<div class="panel-body">
							
							<?php 
					            echo form_open_multipart('Admin/submitvendordata',array('class' => 'form-horizontal'));
					        ?>

					         <?php echo $this->session->flashdata('success'); ?> 

					            <div class="row">
						            <div class="col-md-5 col-md-offset-1">
                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Vendor Name</label>
							                <div class="col-sm-7 col-xs-7">
							                  <input type="text" class="form-control" name="vname" id="fname" placeholder="Enter vendor name" value="<?php echo set_value('vname'); ?>">
											  <span class="text-danger"><?php echo form_error('vname'); ?></span>
							                </div>
						                </div>
                                        
                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 1</label>
							                <div class="col-sm-7">
							                  <textarea class="form-control" name="address1" id="fname"><?php echo set_value('address1'); ?></textarea>
											  <span class="text-danger"><?php echo form_error('address1'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor city</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="city" id="fname" placeholder="Enter city" value="<?php echo set_value('city'); ?>">
											  <span class="text-danger"><?php echo form_error('city'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Landline</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="landline" id="fname" placeholder="Enter Landline" value="<?php echo set_value('landline'); ?>">
											  <span class="text-danger"><?php echo form_error('landline'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Email</label>
							                <div class="col-sm-7">
							                  <input type="email" class="form-control" name="email" id="fname" placeholder="Enter Email" value="<?php echo set_value('email'); ?>">
											  <span class="text-danger"><?php echo form_error('email'); ?></span>
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
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Website</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="websitelink" id="fname" placeholder="Website Link" value="<?php echo set_value('websitelink'); ?>">
											  <span class="text-danger"><?php echo form_error('websitelink'); ?></span>
							                </div>
						                </div>
                                        
                                        <div>&nbsp;</div>

						            </div>
						            <div class="col-md-5">
                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Contact Person</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="cperson" id="fname" placeholder="Enter contact person name" value="<?php echo set_value('cperson'); ?>">
											  <span class="text-danger"><?php echo form_error('cperson'); ?></span>
							                </div>
						                </div>

                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 2</label>
							                <div class="col-sm-7">
							                  <textarea class="form-control" name="address2" id="fname"><?php echo set_value('address2'); ?></textarea>
											  <span class="text-danger"><?php echo form_error('address2'); ?></span>
							                </div>
						                </div>

                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Pincode</label>
							                <div class="col-sm-7">
							                  <input type="number" class="form-control" name="pincode" id="fname" placeholder="Enter Pincode" value="<?php echo set_value('pincode'); ?>">
											  <span class="text-danger"><?php echo form_error('pincode'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Mobile</label>
							                <div class="col-sm-7">
							                  <input type="number" class="form-control" name="mobile" id="fname" placeholder="Enter Mobile" value="<?php echo set_value('mobile'); ?>">
											  <span class="text-danger"><?php echo form_error('mobile'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Password</label>
							                <div class="col-sm-7">
							                  <input type="password" class="form-control" name="password" id="fname" placeholder="Enter password" value="<?php echo set_value('password'); ?>">
											  <span class="text-danger"><?php echo form_error('password'); ?></span>
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
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description</label>
							                <div class="col-sm-7">
							                  <textarea name="description" class="form-control"><?php echo set_value('description'); ?></textarea>  
											  <span class="text-danger"><?php echo form_error('description'); ?></span>
							                </div>
						                </div>
						                
								    </div>	
						        </div>
                                
                                <center>
                                	<div class="form-group">
										<label class="col-md-3 control-label"></label>
										<div class="col-md-6 col-xs-11">
											<button type="submit"  class="btn btn-primary">Submit</button>
											<button type="reset"  class="btn btn-danger">Cancel</button>
										</div>
									</div>
                                </center>							
							</form>

							<div>&nbsp;</div>
                            <div>&nbsp;</div>

                            <h2 class="panel-title">Vendors Data</h2>
                            <hr>
                            <div>&nbsp;</div>
                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Vendor Name</th>
											<th>Contact Person</th>
											<th>Address 1 </th>
											
											<th>Email</th>
											<th>Mobile</th>
											
											<th>Website</th>
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
											<td><?php echo $k->vendorname; ?></td>
											<td><?php echo $k->contact_person; ?></td>
											<td><?php echo $k->Address1; ?></td>
											
											<td><?php echo $k->email; ?></td>
											<td><?php echo $k->mobile; ?></td>
											
											<td><?php echo $k->website; ?></td>
											
											
											<td><a href="addvendorphotos/<?php echo $k->vendorid; ?>">Add Pics to this vendor</a></td>
											<td class="center hidden-phone">
												<a href="editvendorsdata?id=<?php echo $k->vendorid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deletevendorid(<?php echo $k->vendorid; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>
						</div>
					</section>
				</div>
		    </div>


	<script type="text/javascript">
        function deletevendorid(id)
		{
	   	    var uid = id;
	   	    //alert(uid);
	   	    if (confirm("Are You Sure You Want To Delete") == true) {
		        
	            $.ajax({
			      type: "POST",
			      url: '<?php echo site_url("admin/deletevendorid")?>',
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