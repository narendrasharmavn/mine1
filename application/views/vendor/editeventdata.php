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
								            echo form_open_multipart('Vendor/updateEventsData/'.$eventid,array('class' => 'form-horizontal','id' => 'editevents'));
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
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event FromDate *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="date" class="form-control" name="evenfromdate" id="evenfromdate" placeholder="Enter event date" value="<?php echo $rows->fromdate; ?>">
												  <span class="text-danger"><?php echo form_error('evenfromdate'); ?></span>
								                </div>
							                </div>

											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event ToDate *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="date" class="form-control" name="eventodate" placeholder="Enter event date" value="<?php echo $rows->todate; ?>">
												  <span class="text-danger"><?php echo form_error('vname'); ?></span>
								                </div>
								               
							                </div>

							                

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">ToTime </label>
								                <div class="col-sm-7">
								                  <input type="time" class="form-control" name="totime" id="totime" placeholder="Choose time" value="<?php echo $rows->totime; ?>">
												  <span class="text-danger"><?php echo form_error('totime'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">FromTime </label>
								                <div class="col-sm-7">
								                  <input type="time" class="form-control" name="fromtime" id="fromtime" placeholder="Choose time" value="<?php echo $rows->fromtime; ?>">
												  <span class="text-danger"><?php echo form_error('fromtime'); ?></span>
								                </div>
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="location" placeholder="Enter Location" value="<?php echo $rows->location; ?>">
												  <span class="text-danger"><?php echo form_error('location'); ?></span>
								                </div>
								               
							                </div>
											
											

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Event Name *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="eventname" placeholder="Enter event name" value="<?php echo $rows->eventname; ?>">
												  <span class="text-danger"><?php echo form_error('eventname'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description *</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="description" id="description"  ><?php echo $rows->description; ?></textarea>
												  <span class="text-danger"><?php echo form_error('description'); ?></span>
								                </div>
								               
							                </div>

							                
							               

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Latitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="latitude" placeholder="Latitude" value="<?php echo $rows->latitude; ?>">
												  <span class="text-danger"><?php echo form_error('latitude'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Longitude</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="longitude" placeholder="Longitude" value="<?php echo $rows->longitude;; ?>">
												  <span class="text-danger"><?php echo form_error('longitude'); ?></span>
								                </div>
							                </div>
                                            <input type="hidden" class="form-control" name="bannerimage" id="bannerimage"  value="<?php echo $rows->bannerimage; ?>">
							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Banner Image</label>
								                <div class="col-sm-7">
								                    <input type="file" id="packageimage" name="userfile">
												  <span class="text-danger"><?php echo form_error('event'); ?></span>
								                </div>
							                </div>

							                <img src="<?php echo base_url()."/assets/eventimages/".$rows->bannerimage; ?>" style="height:150px;"/>                                      
											
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
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 <script type="text/javascript">

    $(document).ready(function(){
		//alert("hello");
		$("#editevents").validate({
    
          
        // Specify the validation rules
        rules: {
            eventname : "required",
			location : "required",
			evenfromdate : "required",
			eventodate : "required",
			description : "required"
			
		},
        
        // Specify the validation error messages
        messages: {
			eventname : "Event Name Should not be Empty",
			location : "Location Should not be Empty",
			evenfromdate : "Event FromDate Should not be Empty",
			eventodate : "Event ToDate Should not be Empty",
			description : "Description Should not be Empty"
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
         });	



 </script>