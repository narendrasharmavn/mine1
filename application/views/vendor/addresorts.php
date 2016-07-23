<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Add Resorts</h2>
					
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
								            echo form_open_multipart('Vendor/submitresortsdata',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?>

								        
										    <div class="row">
						                        <div class="col-md-5 col-md-offset-1">
                                                    <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Resort Name</label>
										                <div class="col-sm-7 col-xs-7">
										                  <input type="text" class="form-control" name="resortname" id="resortname" placeholder="Enter Resort Name" value="<?php echo set_value('resortname'); ?>">
														  <span class="text-danger"><?php echo form_error('resortname'); ?></span>
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
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description</label>
										                <div class="col-sm-7">
										                  <textarea class="form-control" name="description" id="description"  ><?php echo set_value('description'); ?></textarea>
														  <span class="text-danger"><?php echo form_error('description'); ?></span>
										                </div>
									                </div>
						                        </div>
						                        <div class="col-md-5">
                                                    <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Location</label>
										                <div class="col-sm-7">
										                  <input type="text" class="form-control" name="location" id="fname" placeholder="Enter Resort Location" value="<?php echo set_value('location'); ?>">
														  <span class="text-danger"><?php echo form_error('location'); ?></span>
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
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Banner Image</label>
										                <div class="col-sm-7">
										                    <input type="file" id="packageimage" name="userfile">
														  <span class="text-danger"><?php echo form_error('event'); ?></span>
										                </div>
									                </div>
			                                        <div>&nbsp;</div>
						                        </div>	
						                    </div>

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
                                        
			                            <h2 class="panel-title">Resorts Data</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Vendor Name</th>
													<th>Resort Name</th>
													<th>Location </th>
													<th>Description</th>
													<th>Created By</th>
													<th>Created On</th>
													<th>Updated By</th>
													<th>Updated On</th>
													

													
													<th>Add Photos</th>
													<th class="hidden-phone">Edit</th>
													<th class="hidden-phone">Delete</th>
													
												</tr>
											</thead>
											<tbody>
												<?php 
												
													$vendorid = $this->session->userdata('vendorid');
                                                    $query = $this->db->query("SELECT e.resortid,e.vendorid,e.resortname,v.vendorname,e.location,e.description,e.createdby,e.createdon,e.updatedby,e.updatedon from tblresorts e LEFT JOIN tblvendors v ON e.vendorid=v.vendorid WHERE e.status=1 AND e.vendorid='$vendorid' ORDER BY e.resortid DESC");
													foreach ($query->result() as $k) {
														# code...
													
													
												?>
												<tr>
													<td><?php echo $k->vendorname; ?></td>
													<td><?php echo $k->resortname; ?></td>
													<td><?php echo $k->location; ?></td>
													<td><?php echo $k->description; ?></td>
													<td><?php echo $k->createdby; ?></td>
													<td><?php echo $k->createdon; ?></td>
													<td><?php echo $k->updatedby; ?></td>
													<td><?php echo $k->updatedon; ?></td>
													
													
													
													
													<td><a href="<?php echo site_url(); ?>vendor/addresortphotos/<?php echo $k->resortid; ?>">Add Pics to this Event</a></td>
													<td class="center hidden-phone">
														<a href="<?php echo site_url(); ?>vendor/editresortdata/<?php echo $k->resortid; ?>" target="_blank"  name="edit" id="edit" value="edit">
															Edit
														</a>
													</td>
													<td class="center hidden-phone"><a href="#" onclick="deleteresortid(<?php echo $k->resortid; ?>)">Delete</a></td>

													
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

	    function deleteresortid(id)
	    {
	   	    var uid = id;
	   	    //alert(uid);
	   	    
	   	    if (confirm("Are You Sure You Want To Delete") == true) {
		        
	            $.ajax({
			      type: "POST",
			      url: '<?php echo site_url("vendor/deleteresortid")?>',
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