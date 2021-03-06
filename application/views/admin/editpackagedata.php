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
								<li><span>Edit Package Data</span></li>
								
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
						
										<h2 class="panel-title">Package Edit</h2>
									</header>
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/updatePackageData',array('class' => 'form-horizontal','id' => 'editpackages'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?>

								         <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Vendor Name *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <select name="vendorname" id="vendorname" class="form-control" onchange="getResort(), getEvent()">
								                  	<option value="">Select Vendor name</option>
								                  	<?php

														foreach ($vendorData as $k) {
																//echo $k->description;
																?>
																<option value="<?php echo $k->vendorid;  ?>" <?php if($packageData->vendorid == $k->vendorid) { echo "Selected";}?>><?php echo $k->vendorname;  ?></option>


																<?php
															}


															?> 

								                  </select>
												  <span class="text-danger"><?php echo form_error('vendorname'); ?></span>
								                </div>
								               
							                </div>

								            
										    
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Resort Name *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <select name="resortname" id="resortname" class="form-control">
								                  	<option value="">Select resort name</option>
								                  	<?php

														foreach ($resortData as $k) {
																//echo $k->description;
																?>
																<option value="<?php echo $k->resortid;  ?>" <?php if($packageData->resortid == $k->resortid) { echo "Selected";}?>><?php echo $k->resortname;  ?></option>


																<?php
															}


															?> 

								                  </select>
												  <span class="text-danger"><?php echo form_error('resortname'); ?></span>
								                </div>
								               
							                </div>

							                
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Name *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="packagename" id="fname" placeholder="Enter Package name" value="<?php echo $packageData->packagename;  ?>">
								                  <input type="hidden" class="form-control" name="packageid" id="fname" placeholder="Enter Package name" value="<?php echo $packageData->packageid;  ?>">
												  <span class="text-danger"><?php echo form_error('packagename'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description *</label>
								                <div class="col-sm-7">
								                	<textarea class="description" name="description" id="description"><?php echo $packageData->description;  ?></textarea>
								                  
												  <span class="text-danger"><?php echo form_error('description'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Adult Price *</label>
								                <div class="col-sm-7">
									                <input type="number" class="form-control" name="aprice" id="aprice" value="<?php echo $packageData->adultprice;  ?>">
													<span class="text-danger"><?php echo form_error('aprice'); ?></span>
									            </div>
							                </div>


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Children Price *</label>
								                <div class="col-sm-7">
									                <input type="number" class="form-control" name="cprice" id="cprice" value="<?php echo $packageData->childprice;  ?>">
									                <span class="text-danger"><?php echo form_error('cprice'); ?></span>
									            </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Kids Meal Price *</label>
								                <div class="col-sm-7">
									                <input type="number" class="form-control" name="kprice" id="cprice" value="<?php echo $packageData->kidsmealprice;  ?>">
									                <span class="text-danger"><?php echo form_error('kprice'); ?></span>
									            </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Internet Handling & Charges *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="servicetax" id="fname" placeholder="Enter servicetax" value="<?php echo $packageData->servicetax;  ?>">
												  <span class="text-danger"><?php echo form_error('servicetax'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Tags *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="tags" id="fname" placeholder="Enter tags" value="<?php echo $packageData->packagetags;  ?>">
												  
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Type</label>
								                <div class="col-sm-7">
								                    <select name="packagetype" id="packagetype" class="form-control input-md" onchange="showEvent(this.value)">
														<option value="0" <?php if($packageData->packagetype == '0') { echo "Selected";}?> >Select</option>
														<option value="daily" <?php if($packageData->packagetype == 'daily') { echo "Selected";}?> >daily</option>
														<option value="onetime" <?php if($packageData->packagetype == 'onetime') { echo "Selected";}?> >One Time</option>
														<option value="event" <?php if($packageData->packagetype == 'event') { echo "Selected";}?> >Event</option>
													</select>
												  <span class="text-danger"><?php echo form_error('packagetype'); ?></span>
								                </div>
							                </div>

							                <div id="hevents" class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event Name *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <select name="eventname" id="eventname" class="form-control">
								                  	<option value="">Select Event name</option>
								                  	<?php

														foreach ($eventsData as $k) {
																//echo $k->description;
																?>
																<option value="<?php echo $k->eventid;  ?>" <?php if($packageData->eventid == $k->eventid) { echo "Selected";}?>><?php echo $k->eventname;  ?></option>


																<?php
															}


															?> 

								                  </select>
												  <span class="text-danger"><?php echo form_error('Eventname'); ?></span>
								                </div>
								               
							                </div>
											<div class="form-group" id="expdate" style="margin-right: 442px;">
												<label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Expiry Date *</label>
												<div class="col-sm-7 col-xs-7">
													<input type="text" class="form-control" style="cursor:default;background:white;" readonly name="expirydate" id="expirydate" placeholder="Enter event date" value="<?php echo date("d-m-Y", strtotime($packageData->expirydate)); ?>">
														<span class="text-danger">
															<?php echo form_error('expirydate'); ?>
														</span>
													</div>
												</div>
                                            
							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Image</label>
								                <div class="col-sm-7">
								                    <input type="file" class="form-control" name="userfile">
												  <span class="text-danger"><?php echo form_error('userfile'); ?></span>
								                </div>
							                </div>
                                            <input type="hidden" class="form-control" name="bannerimage" id="bannerimage"  value="<?php echo $packageData->packageimage; ?>">
							                <div>
							                	<img src="<?php echo base_url().'assets/package/'.$packageData->packageimage;  ?>" height="80px" width="120px;">
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
	function getResort()
	{

        var vid = $("#vendorname").val();

        //alert(vid);

        $.ajax({

	      type: "POST",

	      url: '<?php echo site_url("admin/getResort")?>',

	      data: {vid:vid},

	      success: function(res) {

	        //alert(res); 

	        $("#resortname").html(res);

	      }

        }); 

	}
	function getEvent()
	{
        var vid = $("#vendorname").val();

        //alert(vid);

        $.ajax({

	      type: "POST",

	      url: '<?php echo site_url("admin/getEvent")?>',

	      data: {vid:vid},
	      success: function(res) {

	        //alert(res); 

	        $("#eventname").html(res);

	      }

        });

	}
	 function showEvent(x)
        {
            var pkg = x;
            if(pkg == 'event')
            {
                $('#hevents').show();
            }else{
                $('#hevents').hide();
            }
        }
		

	</script>
						
								
<?php
 include 'footer.php'; 

 ?>
 <script type="text/javascript">
 var $j = jQuery.noConflict();
    $("document").ready(function(){

    	$( "#expirydate" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});

    	var packagename = $("#packagetype").val();
    	if(packagename=="event")
    	{
            $('#hevents').show();
    	}else{
            $('#hevents').hide();
        }

        //$('#hevents').hide();
		$("#editpackages").validate({
    
          
        // Specify the validation rules
        rules: {
            vendorname: "required",
			packagetype : "required",
			packagename : "required",
			aprice : "required",
			cprice : "required",
			kprice : "required",
			servicetax : "required",
			description : "required"
			
			
			
		},
        
        // Specify the validation error messages
        messages: {
            vendorname: "Select A Vendor Name",
			packagetype : "Select Package Type",
			packagename : "Package Name should not be empty",
			aprice : "Adult Price should not be empty",
			cprice : "Child Price Should not be empty min zero",
			kprice : "Kid Meal Price Should not be empty min zero",
			servicetax : "Internet Handling Charges Should Not be Empty",
			description : "Description should not be empty"
			
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    });
</script>