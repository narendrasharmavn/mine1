<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Add Resorts</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Add Resorts</span></li>
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
						                <h2>Vendor Bookings</h2>
										
									</header>
									
									<div class="panel-body">
										<?php

								            echo form_open_multipart('Admin/vbookings',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Names</label>
								                <div class="col-sm-7">
								                  <select class="form-control" id="vendorid" name="vendorid">
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
												  <span class="text-danger"><?php echo form_error('pname'); ?></span>
								                </div>
								               
							                </div>
											
											
							                                                      
											
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="button"  onclick="getVendordetails()" class="btn btn-primary hidden-xs">Get</button>
												</div>
											</div>	
										</form>
                                
                                <div>&nbsp;</div>
	                            <div>&nbsp;</div>

										
                                        
			                            <h2 class="panel-title">Daily Bookings</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Ticket No.</th>
													<th>Package Name</th>
													<th>Customer Name</th>
													<th>Adults</th>
													<th>Children</th>
													<th>Price</th>
													<th>Update</th>
													
												</tr>
											</thead>
											<tbody>
												
												<tr>
													<td><?php echo $vendorb->ticketnumber; ?></td>
													<td>
														<?php echo
										$this->db->get_where('tblpackages' , array('packageid' =>$vendorb->packageid))->row()->packagename;
														  ?>
													</td>
													<td><?php echo $vendorb->name; ?></td>
													<td><?php echo $vendorb->quantity; ?></td>
													<td><?php echo $vendorb->childqty; ?></td>
													<td><?php echo $vendorb->amount; ?></td>
													
													
													<td class="center hidden-phone"><a href="#" onclick="deleteresortid(<?php echo $k->bookingid; ?>)">Update</a></td>

													
												</tr>
												

											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

	    function getVendordetails()
	    {
	    	var vendorid = $('#vendorid').val();
	    	//alert(vendorid);
	    	window.location.href='<?php echo site_url("admin/vbookings")?>/'+vendorid;

	    }

	    function deleteresortid(id)
	    {
	   	    var uid = id;
	   	    //alert(uid);
	   	    
	   	    if (confirm("Are You Sure You Want To Delete") == true) {
		        
	            $.ajax({
			      type: "POST",
			      url: '<?php echo site_url("vendor/deleteresortid")?>',
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