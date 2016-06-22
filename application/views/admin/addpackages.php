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
			<li><span>Package's</span></li>
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
			            echo form_open_multipart('Admin/submitPackages',array('class' => 'form-horizontal'));
			        ?>

			         <?php echo $this->session->flashdata('success'); ?>

			            <div class="row">
						    <div class="col-md-5 col-md-offset-1">
						    	<div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Vendor Name</label>
					                <div class="col-sm-7 col-xs-7">
					                  <select name="vendorname" class="form-control">
					                  	<option value="0">Select Vendor name</option>
					                  	<?php

											foreach ($vendorData as $k) {
													//echo $k->description;
													?>
													<option value="<?php echo $k->vendorid;  ?>"><?php echo $k->vendorname;  ?></option>


													<?php
												}


												?> 

					                  </select>
									  <span class="text-danger"><?php echo form_error('vendorname'); ?></span>
					                </div>
				                </div>
				                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Name</label>
					                <div class="col-sm-7">
					                  <input type="text" class="form-control" name="packagename" id="fname" placeholder="Enter Package name" value="<?php echo set_value('packagename'); ?>">
									  <span class="text-danger"><?php echo form_error('packagename'); ?></span>
					                </div>
					               
				                </div>
				                <div>&nbsp;</div>
                                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Adult Price</label>
					                <div class="col-sm-7">
					                  <input type="number" class="form-control" name="aprice" id="aprice" placeholder="Enter Adult Price" value="<?php echo set_value('aprice'); ?>">
									  <span class="text-danger"><?php echo form_error('aprice'); ?></span>
					                </div>
				                </div>
                                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Service Tax</label>
					                <div class="col-sm-7">
					                  <input type="text" class="form-control" name="servicetax" id="fname" placeholder="Enter servicetax" value="<?php echo set_value('servicetax'); ?>">
									  <span class="text-danger"><?php echo form_error('servicetax'); ?></span>
					                </div>
				                </div>
				                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Type</label>
					                <div class="col-sm-7">
					                    <select name="packagetype" id="packagetype" class="form-control input-md" onchange="showEvent(this.value)">
											<option value="">Select</option>
											<option value="daily">daily</option>
											<option value="onetime">One Time</option>
											<option value="event">Event</option>
										</select>
									  <span class="text-danger"><?php echo form_error('packagetype'); ?></span>
					                </div>
				                </div>

				                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Expiry Date</label>
					                <div class="col-sm-7 col-xs-7">
					                  <input type="date" class="form-control" name="expirydate" id="expirydate" placeholder="Enter event date" value="<?php echo set_value('expirydate'); ?>">
									  <span class="text-danger"><?php echo form_error('expirydate'); ?></span>
					                </div>
				                </div>

						    </div>
						    <div class="col-md-5">
						    	<div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Resort Name</label>
					                <div class="col-sm-7 col-xs-7">
					                  <select name="resortname" class="form-control">
					                  	<option value="0">Select resort name</option>
					                  	<?php

											foreach ($resortData as $k) {
													//echo $k->description;
													?>
													<option value="<?php echo $k->resortid;  ?>"><?php echo $k->resortname;  ?></option>


													<?php
												}


												?> 

					                  </select>
									  <span class="text-danger"><?php echo form_error('resortname'); ?></span>
					                </div>
				                </div>
						    	
				                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Description</label>
					                <div class="col-sm-7">
					                  <textarea class="form-control" name="description" id="fname"><?php echo set_value('description'); ?></textarea>
									  <span class="text-danger"><?php echo form_error('description'); ?></span>
					                </div>
				                </div>
				                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Children Price</label>
					                <div class="col-sm-7">
					                  <input type="number" class="form-control" name="cprice" id="cprice" placeholder="Enter Children Price" value="<?php echo set_value('cprice'); ?>">
									  <span class="text-danger"><?php echo form_error('cprice'); ?></span>
					                </div>
				                </div>
                                <div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Tags</label>
					                <div class="col-sm-7">
					                  <input type="text" class="form-control" name="tags" id="fname" placeholder="Enter tags" value="<?php echo set_value('tags'); ?>">
									  
					                </div>
					               
				                </div>
				                <div id="hevents" class="form-group">
					                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Event Name</label>
					                <div class="col-sm-7 col-xs-7">
					                  <select name="eventname" class="form-control">
					                  	<option value="">Select Event name</option>
					                  	<?php

											foreach ($eventsData as $k) {
													//echo $k->description;
													?>
													<option value="<?php echo $k->eventid;  ?>"><?php echo $k->eventname;  ?></option>


													<?php
												}


												?> 

					                  </select>
									  <span class="text-danger"><?php echo form_error('Eventname'); ?></span>
					                </div>
				                </div>
						    </div>
						</div>
						<div>&nbsp;</div>
					    <div class="form-group" style="margin-right: 442px;">
			                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Package Image</label>
			                <div class="col-sm-7">
			                    <input type="file" class="form-control" name="userfile">
							  <span class="text-danger"><?php echo form_error('userfile'); ?></span>
			                </div>
		                </div>
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
                    <h2 class="panel-title">Packages Data</h2>
                    <hr>
                    <div>&nbsp;</div>
                    <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
						<thead>
							<tr>
								<th>Resort Name</th>
								<th>Package name</th>
								
								<th>Amount</th>
								
								
								<th>Vendor Name</th>
								<!--<th>Package Image</th>-->
								<th>Package Tags</th>
								<th>Package type</th>
								<th>Event Name</th>
								
								
								<th class="hidden-phone">Edit</th>
								<th class="hidden-phone">Delete</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($packages->result() as $k) {
									# code...
							?>
							<tr>
								<td><?php echo $k->resortname; ?></td>
								<td><?php echo $k->packagename; ?></td>
								
								<td><?php echo $k->adultprice; ?></td>
								
								
								<td><?php echo $k->vendorname; ?></td>
								<!--<td><img src="<?php echo base_url().'assets/package/'.$k->packageimage; ?>" height="80px;"></td>-->
								<td><?php echo $k->packagetags; ?></td>
								<td><?php echo $k->packagetype; ?></td>

								<td><?php echo $k->eventname; ?></td>
			
								<td class="center hidden-phone">
									<a href="<?php echo site_url(); ?>admin/editpackagedata/<?php echo $k->packageid; ?>" target="_blank"  name="edit" id="edit" value="edit">
										Edit
									</a>
								</td>
								<td class="center hidden-phone"><a href="#" onclick="deletepackageid(<?php echo $k->packageid; ?>)">Delete</a></td>
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
    

    function deletepackageid(id)
    {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deletepackageid")?>',
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
        $('#hevents').hide();
        //alert("hello");
    });
</script>