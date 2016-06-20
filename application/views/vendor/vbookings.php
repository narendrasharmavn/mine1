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
						
										
									</header>
									
									<div class="panel-body">
										
										
                                        
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
												<?php 
												
													$vendorid = $this->session->userdata('vendorid');
                                                    $query = $this->db->query("SELECT b.bookingid,b.date, b.quantity,b.childqty, b.amount,b.ticketnumber,p.packagename,c.name FROM tblbookings b,tblpackages p,tblcustomers c,tblvendors v where b.packageid=p.packageid and b.userid=c.customer_id and v.vendorid='$vendorid' and b.booking_status='booked' and b.payment_status='paid' ORDER BY b.date DESC");
													foreach ($query->result() as $k) {
														# code...
													
													
												?>
												<tr>
													<td><?php echo $k->ticketnumber; ?></td>
													<td><?php echo $k->packagename; ?></td>
													<td><?php echo $k->name; ?></td>
													<td><?php echo $k->quantity; ?></td>
													<td><?php echo $k->childqty; ?></td>
													<td><?php echo $k->amount; ?></td>
													
													
													<td class="center hidden-phone"><a href="#" onclick="deleteresortid(<?php echo $k->bookingid; ?>)">Update</a></td>

													
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

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