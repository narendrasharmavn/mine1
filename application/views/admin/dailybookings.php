<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Daily Bookings</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Daily Bookings</span></li>
								
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
						                <h2>Daily Bookings</h2>
										
									</header>
									
									<div class="panel-body">
										
                                
                               
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
												<?php 
												 $getdailybookings = $this->db->query("SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.bookingid=p.bookingid left join tblcustomers c ON p.customerid=c.customer_id WHERE b.date >= CURDATE()");
												 foreach ($getdailybookings->result() as $vendorb) {
												?>
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
													
													
													

													
												</tr>
												<?php } ?>

											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

	    

	    
	</script>
						
								
<?php
 include 'footer.php'; 

 ?>