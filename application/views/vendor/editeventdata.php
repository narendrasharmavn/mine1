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
								            echo form_open_multipart('Vendor/updateEventsData/'.$eventid,array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         <?php
								            $id = $eventid; 
											//echo $id;
											$query = $this->db->query("SELECT * FROM tblevents WHERE eventid='$id'");
											$rows = $query->row(); 
											//$name = $rows->itemname;
											
											
								         ?>

											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event ToDate</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="date" class="form-control" name="eventdate" id="fname" placeholder="Enter event date" value="<?php echo $rows->todate; ?>">
												  <span class="text-danger"><?php echo form_error('vname'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event FromDate</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="date" class="form-control" name="evenfromdate" id="evenfromdate" placeholder="Enter event date" value="<?php echo $rows->fromdate; ?>">
												  <span class="text-danger"><?php echo form_error('evenfromdate'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">ToTime</label>
								                <div class="col-sm-7">
								                  <input type="time" class="form-control" name="totime" id="totime" placeholder="Choose time" value="<?php echo $rows->totime; ?>">
												  <span class="text-danger"><?php echo form_error('totime'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">FromTime</label>
								                <div class="col-sm-7">
								                  <input type="time" class="form-control" name="fromtime" id="fromtime" placeholder="Choose time" value="<?php echo $rows->fromtime; ?>">
												  <span class="text-danger"><?php echo form_error('fromtime'); ?></span>
								                </div>
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Location</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="location" id="fname" placeholder="Enter Location" value="<?php echo $rows->location; ?>">
												  <span class="text-danger"><?php echo form_error('location'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Time</label>
								                <div class="col-sm-7">
								                  <input type="time" class="form-control" name="time" id="fname" placeholder="Choose time" value="<?php echo $rows->time; ?>">
												  <span class="text-danger"><?php echo form_error('time'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Event Name</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="eventname" id="fname" placeholder="Enter event name" value="<?php echo $rows->eventname; ?>">
												  <span class="text-danger"><?php echo form_error('eventname'); ?></span>
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
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Choose event type</label>
								                <div class="col-sm-7 col-xs-7">
								                  <select class="form-control" name="eventtype" id="fname" >
								                  	<option value="" selected></option>
								                  	
														<option value="1">event type</option>

								                  </select>
												  <span class="text-danger"><?php echo form_error('eventtype'); ?></span>
								                </div>
								               
							                </div> 

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Cost</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="cost" id="fname" placeholder="Enter cost" value="<?php echo $rows->cost; ?>">
												  <span class="text-danger"><?php echo form_error('cost'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Latitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="latitude" id="fname" placeholder="Latitude" value="<?php echo $rows->latitude; ?>">
												  <span class="text-danger"><?php echo form_error('latitude'); ?></span>
								                </div>
							                </div>

							                <div class="form-group">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Longitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="longitude" id="fname" placeholder="Longitude" value="<?php echo $rows->longitude;; ?>">
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

 <script type="text/javascript">

    $(document).ready(function(){
		// we call the function
		 var url = window.location.href;
		 var res = url.split("?id="); 
         var id = res[1];
         //alert(id);
        
		ajaxC(id);
        setTimeout(function(){
		  ajaxS(id);
		  setTimeout(function(){
		    ajaxM(id);
		    setTimeout(function(){
			   ajaxE(id);
			}, 2500);
		  }, 2500);
		}, 2500);
       
		


		 

    });

 </script>