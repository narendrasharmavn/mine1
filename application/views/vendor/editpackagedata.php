<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Add Packages</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Add Packages</span></li>
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
						
										<h2 class="panel-title">Add Packages</h2>
									</header>
									
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Vendor/submiteditpackages',array('class' => 'form-horizontal','id' => 'editpackages'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?>
                                            <?php  
                                                $id = $_GET['id'];
                                                //echo $id."<br>";
                                                $query = $this->db->query("SELECT * FROM tblpackages WHERE packageid='$id'");
											    $rows = $query->row(); 
											    $resortid = $rows->resortid;
											    //echo $resortid."<br>";
											    $packagename = $rows->packagename;
											    //echo $packagename."<br>";
											    $description = $rows->description;
											    //echo $description."<br>";
											    $adultprice = $rows->adultprice;
											    //echo $amount."<br>"; 

											    $child = $rows->childprice;
											    //echo $amount."<br>"; 
											    
											    $packagetags = $rows->packagetags;
											    //echo $packagetags."<br>";
											    $packagetype = $rows->packagetype;
											    //echo $packagetype."<br>";
											    $eventid = $rows->eventid;
											    //echo $eventid."<br>";

                                            ?>
                                            <input type="hidden" class="form-control" name="packageid" id="packageid"  value="<?php echo $id; ?>">
								            <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Resorts *</label>
								                <div class="col-sm-7">
								                	
                                    
								                    <select name="resortname" id="resortname" class="form-control input-md">
														<option value="0">Select</option>
                                                        <?php 
					                                    foreach ($vendors->result() as $rs)
					                                    {  
					                                    ?>
														<option value="<?php echo $rs->resortid; ?>" <?php if($resortid == $rs->resortid ) { echo "Selected";}?>><?php echo $rs->resortname; ?></option>
														<?php } ?>
													</select>

												  <span class="text-danger"><?php echo form_error('resortname'); ?></span>
								                </div>
							                </div>

											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Package Name *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="text" class="form-control" name="packagename" id="packagename" placeholder="Enter Package Name" value="<?php echo $packagename; ?>">
												  <span class="text-danger"><?php echo form_error('packagename'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description *</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="description" id="description"  ><?php echo set_value('description'); ?>
								                  	<?php echo $description; ?>
								                  </textarea>
												  <span class="text-danger"><?php echo form_error('description'); ?></span>
								                </div>  
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Adult Price *</label>
								                <div class="col-sm-7">
								                  <input type="number" class="form-control" name="aprice" id="aprice" placeholder="Enter Adult Price" value="<?php echo $adultprice; ?>">
												  <span class="text-danger"><?php echo form_error('aprice'); ?></span>
								                </div>
							                </div>


											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Children Price *</label>
								                <div class="col-sm-7">
								                  <input type="number" class="form-control" name="cprice" id="cprice" placeholder="Enter Children Price" value="<?php echo $child; ?>">
												  <span class="text-danger"><?php echo form_error('cprice'); ?></span>
								                </div>
							                </div>
											

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Tags</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter Package Tags" value="<?php echo $packagetags; ?>">
												  <span class="text-danger"><?php echo form_error('tags'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Type *</label>
								                <div class="col-sm-7">
								                    <select name="packagetype" id="packagetype" class="form-control input-md" onchange="showEvent(this.value)">
														<option value="0" <?php if($packagetype == 0) { echo "Selected";}?>>Select</option>
														<option value="daily" <?php if($packagetype == 'daily') { echo "Selected";}?>>Daily</option>
														<option value="onetime" <?php if($packagetype == 'onetime') { echo "Selected";}?>>One Time</option>
														<option value="event" <?php if($packagetype == 'event') { echo "Selected";}?>>Event</option>
													</select>
												  <span class="text-danger"><?php echo form_error('packagetype'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;" id="hevents">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Events</label>
								                <div class="col-sm-7">
								                    <select name="event" id="event" class="form-control input-md">
														<option value="">Select</option>
														<?php 
					                                    foreach ($events->result() as $ev)
					                                    {  
					                                    ?>
														<option value="<?php echo $ev->eventid; ?>" <?php if($eventid == $ev->eventid) { echo "Selected";}?>><?php echo $ev->eventname; ?></option>
														<?php } ?>
													</select>
												  <span class="text-danger"><?php echo form_error('event'); ?></span>
								                </div>
							                </div>

							                

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Image</label>
								                <div class="col-sm-7">
								                    <input type="file" id="packageimage" name="userfile">
												  <span class="text-danger"><?php echo form_error('event'); ?></span>
								                </div>
							                </div>

							                <input type="hidden" class="form-control" name="bannerimage" id="bannerimage"  value="<?php echo $rows->packageimage; ?>">

                                            <div>
							                	<img src="<?php echo base_url().'/assets/package/'.$rows->packageimage;  ?>" height="80px" width="120px;">
							                </div>

											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="submit"  class="btn btn-primary hidden-xs">Submit</button>
												</div>
											</div>											
										</form>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

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
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 

 <script type="text/javascript">
    $("document").ready(function(){
    	var packagename = $("#packagetype").val();
    	if(packagename=="event")
    	{
            $('#hevents').show();
    	}else{
            $('#hevents').hide();
        }
			$("#editpackages").validate({
    
          
        // Specify the validation rules
        rules: {
            packagetype : "required",
			resortname : "required",
			eventname : "required",
			packagename : "required",
			aprice : "required",
			cprice : "required",
			kprice : "required",
			servicetax : "required",
			description : "required"
			
			
			
		},
        
        // Specify the validation error messages
        messages: {
            packagetype : "Select Package Type",
			resortname : "Select a Resort Name",
			eventname : "Select an Event Name",
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
   