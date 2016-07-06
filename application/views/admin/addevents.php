<?php
 include 'header.php'; 

 ?>

		<section role="main" class="content-body">
			<header class="page-header">
				<h2>Add Events</h2>
			
				<div class="right-wrapper pull-right">
					<ol class="breadcrumbs">
						<li>
							<a href="dashboard">
								<i class="fa fa-home"></i>
							</a>
						</li>
						<li><span>Add Events</span></li>
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
				
								<h2 class="panel-title">Add Events</h2>
							</header>
							
							<div class="panel-body">
								
								<?php 
						            echo form_open_multipart('Admin/submiteventdata',array('class' => 'form-horizontal'));
						        ?>

						        <?php echo $this->session->flashdata('success'); ?>

						        <div class="row">
						            <div class="col-md-5 col-md-offset-1">
                                        
                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Choose Vendor Name</label>
							                <div class="col-sm-7 col-xs-7">
							                  <select class="form-control" name="vendorid" id="fname" >
							                  	<option value="">Select Vendor name</option>
							                  	<?php
												foreach ($vendors->result() as $k) {
														//echo $k->vendorid."<br>";
													?>
													<option value="<?php echo $k->vendorid ?>"><?php echo $k->vendorname; ?></option>

													<?php
												}
												?>
							                  	
							                  </select>
											  <span class="text-danger"><?php echo form_error('vname'); ?></span>
							                </div>
						                </div> 

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Location</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="location" id="fname" placeholder="Enter Location" value="<?php echo set_value('location'); ?>">
											  <span class="text-danger"><?php echo form_error('location'); ?></span>
							                </div>
						                </div>


						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event FromDate</label>
							                <div class="col-sm-7 col-xs-7">
							                  <input type="date" class="form-control" name="evenfromdate" id="evenfromdate" placeholder="Enter event date" value="<?php echo set_value('evenfromdate'); ?>">
											  <span class="text-danger"><?php echo form_error('evenfromdate'); ?></span>
							                </div>
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">FromTime</label>
							                <div class="col-sm-7">
							                  <input type="time" class="form-control" name="fromtime" id="fromtime" placeholder="Choose time" value="<?php echo set_value('fromtime'); ?>">
											  <span class="text-danger"><?php echo form_error('fromtime'); ?></span>
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
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Event Name</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="eventname" id="fname" placeholder="Enter event name" value="<?php echo set_value('eventname'); ?>">
											  <span class="text-danger"><?php echo form_error('eventname'); ?></span>
							                </div> 
						                </div>

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Choose event type</label>
							                <div class="col-sm-7 col-xs-7">
							                  <select class="form-control" name="eventtype" id="fname" >
							                  	<option value="" selected></option>
							                  	
													<option value="1">event type</option>

							                  </select>
											  <span class="text-danger"><?php echo form_error('eventtype'); ?></span>
							                </div>
						                </div> 

						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event ToDate</label>
							                <div class="col-sm-7 col-xs-7">
							                  <input type="date" class="form-control" name="eventodate" id="eventodate" placeholder="Enter event date" value="<?php echo set_value('eventodate'); ?>">
											  <span class="text-danger"><?php echo form_error('eventodate'); ?></span>
							                </div>
						                </div>

                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">ToTime</label>
							                <div class="col-sm-7">
							                  <input type="time" class="form-control" name="totime" id="totime" placeholder="Choose time" value="<?php echo set_value('totime'); ?>">
											  <span class="text-danger"><?php echo form_error('totime'); ?></span>
							                </div>
						                </div>
						                
						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Longitude</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="longitude" id="fname" placeholder="Longitude" value="<?php echo set_value('longitude'); ?>">
											  <span class="text-danger"><?php echo form_error('longitude'); ?></span>
							                </div>
						                </div>
                                        
                                        <div>&nbsp;</div>
                                        <div>&nbsp;</div>
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

	                            <h2 class="panel-title">Events Data</h2>
	                            <hr>
	                            <div>&nbsp;</div>

	                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Vendor Name</th>
											<th>Event name</th>
											<th>Location </th>
											<th>Time</th>
											<th>Date</th>
											<th>Add Photos</th>
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
											
										</tr>
									</thead>
									<tbody>
										<?php 

											foreach ($events->result() as $k) {
												# code...

										?>
										<tr>
											<td><?php echo $k->vendorname; ?></td>
											<td><?php echo $k->eventname; ?></td>
											<td><?php echo $k->location; ?></td>
											<td><?php echo $k->totime; ?></td>
											<td><?php echo $k->todate; ?></td>

											<td><a href="<?php echo site_url(); ?>/admin/addeventphotos/<?php echo $k->eventid; ?>">Add Pics to this Event</a></td>
											<td class="center hidden-phone">
												<a href="<?php echo site_url(); ?>/admin/editeventdata/<?php echo $k->eventid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deleteeventid(<?php echo $k->eventid; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</section>
					</div>
				</div>


	<script type="text/javascript">
    function deleteeventid(id)
    {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deleteeventid")?>',
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