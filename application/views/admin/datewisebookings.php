<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Date Wise Bookings</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Date Wise Bookings</span></li>
								
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
						                <h2>Date Wise Bookings</h2>
										
									</header>
									
									<div class="panel-body">
										<?php

								            echo form_open_multipart('Admin/datewisebookings',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">From Date</label>
								                <div class="col-sm-7">
								                   <input type="date" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="<?php echo set_value('fromdate'); ?>">
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">To Date</label>
								                <div class="col-sm-7">
								                   <input type="date" class="form-control" name="todate" id="todate" placeholder="Enter To date" value="<?php echo set_value('todate'); ?>">
												  <span class="text-danger"><?php echo form_error('todate'); ?></span>
								                </div>
								               
							                </div>
							                                                      
											
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="button"  onclick="getDailybookings()" class="btn btn-primary hidden-xs">Get</button>
												</div>
											</div>	
										</form>
                                
                                <div>&nbsp;</div>
	                            <div>&nbsp;</div>

										
                                        
			                            <h2 class="panel-title">Date Wise Bookings</h2>
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
													
													
												</tr>
											</thead>
											<tbody>
												
												<tr>
													<td><?php echo $k->ticketnumber; ?></td>
													<td>
														<?php echo
										$this->db->get_where('tblpackages' , array('packageid' =>$k->packageid))->row()->packagename;
														  ?>
													</td>
													<td><?php echo $k->name; ?></td>
													<td><?php echo $k->quantity; ?></td>
													<td><?php echo $k->childqty; ?></td>
													<td><?php echo $k->amount; ?></td>
													
													
													

													
												</tr>
												

											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

	    function getDailybookings()
	    {
	    	var fromdate = $('#fromdate').val();
	    	//alert(fromdate);
	    	var todate = $('#todate').val();
	    	//alert(todate);
	    	window.location.href='<?php echo site_url("admin/datewisebookings")?>/'+fromdate+'/'+todate;


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