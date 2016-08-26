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
								            echo form_open_multipart('Vendor/submitaddpackages',array('class' => 'form-horizontal','id' => 'addpackages'));
								        ?>

								        <?php echo $this->session->flashdata('success'); ?>

                                            <div class="row">
						                        <div class="col-md-5 col-md-offset-1">
                                                     <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Resorts *</label>
										                <div class="col-sm-7">
										                	
		                                    
										                    <select name="resortname" id="resortname" class="form-control input-md">
																<option value="0">Select</option>
		                                                        <?php 
							                                    foreach ($vendors->result() as $rs)
							                                    {  
							                                    ?>
																<option value="<?php echo $rs->resortid; ?>"><?php echo $rs->resortname; ?></option>
																<?php } ?>
															</select>

														  <span class="text-danger"><?php echo form_error('resortname'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Adult Price *</label>
										                <div class="col-sm-7">
										                  <input type="number" class="form-control" name="aprice" id="aprice" placeholder="Enter Adult Price" value="<?php echo set_value('aprice'); ?>">
														  <span class="text-danger"><?php echo form_error('aprice'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Tags </label>
										                <div class="col-sm-7">
										                  <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter Package Tags" value="<?php echo set_value('tags'); ?>">
														  <span class="text-danger"><?php echo form_error('tags'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description *</label>
										                <div class="col-sm-7">
										                  <textarea class="form-control" name="description" id="description"  ><?php echo set_value('description'); ?></textarea>
														  <span class="text-danger"><?php echo form_error('description'); ?></span>
										                </div>  
									                </div>
                                                    
                                                    <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Expiry Date</label>
										                <div class="col-sm-7 col-xs-7">
										                  <input type="text" style="cursor:default;background-color:white;" class="form-control" name="expirydate" id="expirydate" placeholder="Enter Expiry date" value="<?php echo set_value('expirydate'); ?>" readonly>
														  <span class="text-danger"><?php echo form_error('expirydate'); ?></span>
										                </div>
									                </div>
									                <div>&nbsp;</div>
						                        </div>
						                        <div class="col-md-5">
                                                    <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Package Name *</label>
										                <div class="col-sm-7 col-xs-7">
										                  <input type="text" class="form-control" name="packagename" id="packagename" placeholder="Enter Package Name" value="<?php echo set_value('packagename'); ?>">
														  <span class="text-danger"><?php echo form_error('packagename'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Children Price *</label>
										                <div class="col-sm-7">
										                  <input type="number" class="form-control" name="cprice" id="cprice" placeholder="Enter Children Price" value="<?php echo set_value('cprice'); ?>">
														  <span class="text-danger"><?php echo form_error('cprice'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Type *</label>
										                <div class="col-sm-7">
										                    <select name="packagetype" id="packagetype" class="form-control input-md" onchange="showEvent(this.value)">
																<option value="">Select</option>
																<option value="daily">Daily</option>
																<option value="onetime">One Time</option>
																<option value="event">Event</option>
															</select>
														  <span class="text-danger"><?php echo form_error('packagetype'); ?></span>
										                </div>
									                </div>

									                <div class="form-group" id="hevents">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Events</label>
										                <div class="col-sm-7">
										                    <select name="event" id="event" class="form-control input-md">
																<option value="">Select</option>
																<?php 
							                                    foreach ($events->result() as $ev)
							                                    {  
							                                    ?>
																<option value="<?php echo $ev->eventid; ?>"><?php echo $ev->eventname; ?></option>
																<?php } ?>
															</select>
														  <span class="text-danger"><?php echo form_error('event'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Image</label>
										                <div class="col-sm-7">
										                    <input type="file" id="packageimage" name="userfile">
														  <span class="text-danger"><?php echo form_error('event'); ?></span>
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

			                            <h2 class="panel-title">Packages Data</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Package Name</th>
													<th>Description</th>
													<th>Adult Price </th>
													<th>Child Price </th>
													<th>Package Type</th>
													<th class="hidden-phone">Edit</th>
													<th class="hidden-phone">Delete</th>
													
												</tr>
											</thead>
											<tbody>
												<?php 
												
													

													foreach ($result->result() as $k) {
														# code...
													
													
												?>
												<tr>
													<td><?php echo $k->packagename; ?></td>
													<td><?php echo $k->description; ?></td>
													<td><?php echo $k->adultprice; ?></td>
													<td><?php echo $k->childprice; ?></td>
													<td><?php echo $k->packagetype; ?></td>
                                                   <td class="center hidden-phone">
														<a href="editpackagedata?id=<?php echo $k->packageid; ?>"   name="edit" id="edit" value="edit">
															Edit
														</a>
													</td>
													<td class="center hidden-phone"><a href="#" onclick="deleteresortid(<?php echo $k->packageid; ?>)">Delete</a></td>

													
												</tr>
												<?php } ?>
											</tbody>
										</table>
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

        function deleteresortid(id)
   {
   	    var uid = id;
   	    //alert(uid);
   	    
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("vendor/deletepackageid")?>',
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
 
   

 <script type="text/javascript">
 
    $("document").ready(function(){
		var $j = jQuery.noConflict();
    	$( "#expirydate" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});

        $('#hevents').hide();
		$j("#addpackages").validate({
    
          
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
			description : "required",
			userfile : "required"
			
			
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
			description : "Description should not be empty",
			userfile : "Upload Package Image"
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
    });
</script>
   