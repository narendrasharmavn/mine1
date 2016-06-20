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
						            echo form_open_multipart('Admin/submitsliders',array('class' => 'form-horizontal'));
						        ?>

						        <?php echo $this->session->flashdata('success'); ?>

						        <div class="row">
						            <div class="col-md-5 col-md-offset-1">
                                        

						                <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Name</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="sname" id="sname" placeholder="Enter Name" value="<?php echo set_value('sname'); ?>">
											  <span class="text-danger"><?php echo form_error('sname'); ?></span>
							                </div>
						                </div>

						                


						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Subtitle</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Subtitle" value="<?php echo set_value('subtitle'); ?>">
											  <span class="text-danger"><?php echo form_error('subtitle'); ?></span>
							                </div>
						                </div>
                                        
                                        <div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Link</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="link" id="link" placeholder="Enter Link" value="<?php echo set_value('link'); ?>">
											  <span class="text-danger"><?php echo form_error('link'); ?></span>
							                </div>
						                </div>
										

						            </div>
						            <div class="col-md-5">

						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Title</label>
							                <div class="col-sm-7">
							                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo set_value('title'); ?>">
											  <span class="text-danger"><?php echo form_error('title'); ?></span>
							                </div>
						                </div>

						            	<div class="form-group">
							                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Expiry Date</label>
							                <div class="col-sm-7 col-xs-7">
							                  <input type="date" class="form-control" name="edate" id="edate" placeholder="Enter expiry date" value="<?php echo set_value('edate'); ?>">
											  <span class="text-danger"><?php echo form_error('edate'); ?></span>
							                </div>
						                </div>
						            	

						                
                                        
                                        <div>&nbsp;</div>
                                        
						            </div>	
						        </div>
                                 <!--
						         <div class="form-group" style="margin-right: 442px;">
					                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Places Image</label>
					                <div class="col-sm-7">
					                    <?php //echo form_error('uploadedimages[]'); ?>
                                        <?php //echo form_upload('uploadedimages[]','','multiple'); ?>
									  <span class="text-danger"><?php //echo form_error('userfile'); ?></span>
					                </div>
				                </div>-->
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

	                            <h2 class="panel-title">Sliders Data</h2>
	                            <hr>
	                            <div>&nbsp;</div>

	                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Name</th>
											<th>Title</th>
											<th>Subtitle </th>
											<th>Link</th>
											<th>Expiry Date</th>
											<th>Add Photos</th>
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
											
										</tr>
									</thead>
									<tbody>
										<?php 
										
											
                                            
											foreach ($results->result() as $k) {
												# code...
											
											
										?>
										<tr>
											<td><?php echo $k->name; ?></td>
											<td><?php echo $k->title; ?></td>
											<td><?php echo $k->subtitle; ?></td>
											<td><?php echo $k->link; ?></td>
											<td><?php echo $k->expirydate; ?></td>
											
											
											
											
											<td><a href="<?php echo site_url(); ?>/admin/addsliderphotos/<?php echo $k->sid; ?>">Add Pics to this Places</a></td>
											<td class="center hidden-phone">
												<a href="<?php echo site_url(); ?>/admin/editaddslider/<?php echo $k->sid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deletesliderid(<?php echo $k->sid; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</section>
					</div>
				</div>


	<script type="text/javascript">
    function deletesliderid(id)
    {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deletesliderid")?>',
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