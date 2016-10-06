<?php
 include 'header.php'; 

 ?>

		<section role="main" class="content-body">
			<header class="page-header">
				<h2>Add Sliders</h2>
			
				<div class="right-wrapper pull-right">
					<ol class="breadcrumbs">
						<li>
							<a href="dashboard">
								<i class="fa fa-home"></i>
							</a>
						</li>
						<li><span>Add Sliders</span></li>
						<li><span>Slider's</span></li>
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
				
								<h2 class="panel-title">Add Sliders</h2>
							</header>
							
							<div class="panel-body">
								
								<?php 
						            echo form_open_multipart('Admin/submitmobilesliders',array('class' => 'form-horizontal', 'id' => 'slidersubmit'));
						        ?>

						        <?php echo $this->session->flashdata('success'); ?>

						        <div class="row">
						            <div class="col-md-5 col-md-offset-1">
                                        

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Title</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="title" placeholder="Enter Name" value="<?php echo set_value('sname'); ?>">
											  <span class="text-danger"><?php echo form_error('sname'); ?></span>
							                </div>
						                </div>

						                


						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Type</label>
							                <div class="col-sm-7">
							                  
							                  <select class="form-control" name="type" onchange="getNames(this.value)">
							                  	<option value="">Choose type</option>
							                  	<option value="resortdetails">Resorts</option>
							                  	<option value="eventdetails">Events</option>
							                  	<option value="placedetails">Place</option>
							                  	<option value="placedetails/adventure">Adventure</option>
							                  	<option value="placedetails/kids">Kids</option>
							                  </select>
											  <span class="text-danger"><?php echo form_error('subtitle'); ?></span>
							                </div>
						                </div>
                                        
                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Value</label>
							                <div class="col-sm-7">
							                  <select class="form-control" name="value" id="value">
							                  	
							                  </select>
											  <span class="text-danger"><?php echo form_error('link'); ?></span>
							                </div>
						                </div>
										

						            </div>
						            <div class="col-md-5">

						            	<div class="form-group">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Slider Image</label>
					                <div class="col-sm-7">
					                    <input type="file" class="form-control" name="userfile">
									  <span class="text-danger"><?php echo form_error('userfile'); ?></span>
					                </div>
				                </div> 
                                        
						            </div>	
						        </div>
						        <div>&nbsp;</div>
                                
						         
                                <div>&nbsp;</div>
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

	                            <h2 class="panel-title">Sliders Data</h2>
	                            <hr>
	                            <div>&nbsp;</div>

	                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											
											<th>Title</th>
											<th>Type </th>
											<th>Image </th>
											<th>Value</th>
											
											
											<!--<th class="hidden-phone">Edit</th>-->
											<th class="hidden-phone">Delete</th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
										
											
                                            
											foreach ($results->result() as $k) {
												# code...
											
											
										?>
										<tr>
											
											<td><?php echo $k->title; ?></td>
											<td><?php echo $k->type; ?></td>
											<td><img src="<?php echo base_url().'assets/sliderimages/'.$k->image; ?>" alt="<?php echo $k->image; ?>" title="<?php echo $k->image; ?>" height="120px" width="130px"></td>
											<td><?php echo $k->value; ?></td>
											
											
											
											
											<!--
											
											<td class="center hidden-phone">
												<a href="<?php echo site_url(); ?>/admin/editaddslider/<?php echo $k->sid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											-->
											<td class="center hidden-phone"><a href="#" onclick="deletesliderid(<?php echo $k->id; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</section>
					</div>
				</div>

				<?php
 include 'footer.php'; 

 ?>


	<script type="text/javascript">
	$("#slidersubmit").validate({
    
        // Specify the validation rules
        rules: {
            title: "required",
            type: "required",
            value: "required",
        },
        
        // Specify the validation error messages
        messages: {
             title: "Please provide a title",
            type: "Please provide a type",
            value: "Please provide a value",
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });


    function getNames(type){
    	//alert(type);
    	$.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/getNamesMobileSlider")?>',
		      data: {
		             
		             type:type
		            },
		      success: function(res) {
		      //alert(res); 
		      $('#value').html(res);
		      
		      }
	        }); 
    }



    function deletesliderid(id)
    {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
   	    	
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deleteMobileSlider")?>',
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
						
								
