<?php 
include 'header.php';
?>
  <!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

			

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Payments Information</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Data</span></li>
								<li><span>Payments</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					
						
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">Payments Data</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Booking Id</th>
											<th>Customer Id</th>
											<th>Transaction Id </th>
											<th>Transaction Date</th>
											<th>Amount</th>
											<th>Response</th>
											<th>Quantity</th>
											<th>Booking Status</th>
											<th>Payment Status</th>
											<th>Ticket Number</th>
											<th>Package Name</th>
											
											
											
											
										</tr>
									</thead>
									<tbody>
										<?php 
										
											

											foreach ($results->result() as $k) {
												# code...
											
											
										?>
										<tr>
											<td><?php echo $k->bookingid; ?></td>
											<td><?php echo $k->customerid; ?></td>
											<td><?php echo $k->transaction_id; ?></td>
											<td><?php echo $k->transdate; ?></td>
											<td><?php echo $k->amount; ?></td>
											<td><?php echo $k->response; ?></td>
											<td><?php echo $k->quantity; ?></td>
											<td><?php echo $k->booking_status; ?></td>
											<td><?php echo $k->payment_status; ?></td>
											<td><?php echo $k->ticketnumber; ?></td>
											<td><?php echo $k->packagename; ?></td>
											
											
											
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</section>
						
<script type="text/javascript">
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