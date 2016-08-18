<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Edit Resort Details</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Edit Resort Details</span></li>
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
						
										<h2 class="panel-title">Edit Resort Details</h2>
									</header>
									
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Vendor/submiteditresorts',array('class' => 'form-horizontal','id' => 'editresorts'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?>
                                            <?php  
                                                $id = $this->uri->segment('3');
                                                //echo $id."<br>";
                                                $query = $this->db->query("SELECT * FROM tblresorts WHERE resortid='$id'");
											    $rows = $query->row(); 
											    
											    $vendorid = $rows->vendorid;
											    //echo $packagename."<br>";
											    $description = $rows->description;
											    //echo $description."<br>";
											    $location = $rows->location;
											    //echo $amount."<br>"; 
											    $resortname = $rows->resortname;
											    //echo $servicetax."<br>";

											    $latitude = $rows->latitude;
											    //echo $latitude."<br>";

											    $longitude = $rows->longitude;
											    //echo $longitude."<br>";

											    

                                            ?>
                                            <input type="hidden" class="form-control" name="resortid" id="resortid"  value="<?php echo $id; ?>">
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Resort Name *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="resortname" id="resortname" placeholder="Enter Resort Name" value="<?php echo $resortname; ?>">
												  <span class="text-danger"><?php echo form_error('resortname'); ?></span>
								                </div>
							                </div>

											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Address *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" value="<?php echo $location; ?>">
												  <span class="text-danger"><?php echo form_error('location'); ?></span>
								                </div>
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description *</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="description" id="description"  ><?php echo set_value('description'); ?>
								                  	<?php echo $description; ?></textarea>
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

							                <img src="<?php echo base_url()."/assets/resortimages/".$rows->bannerimage; ?>" style="height:150px;"/>

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


						
								
<?php
 include 'footer.php'; 

 ?>

 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 <script type="text/javascript">
  	
		$("#editresorts").validate({
    
          
        // Specify the validation rules
        rules: {
            resortname : "required",
			location : "required",
			description: "required"
			
		},
        
        // Specify the validation error messages
        messages: {
			resortname : "Resort Name Should Not be Empty",
			location : "Location Should Not be Empty",
			description: "Description Should not be Empty"
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>
   