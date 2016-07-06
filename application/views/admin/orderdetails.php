<?php 
include 'header.php';
?>
  <!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

			
										<?php 
								            echo form_open_multipart('Admin/updateOrderStatusToDelivered',array('class' => 'form-horizontal'));
								        ?>
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Items</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Tables</span></li>
								<li><span>Advanced</span></li>
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
						
								<h2 class="panel-title">Order Details Report</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Order ID</th>
											<th>Customer Name</th>
											<th>Customer Mobile</th>
											<th>Items</th>
											<th>Total Items </th>
											<th>Amount</th>
											<th>Address</th>
											<th>Date</th>
											<th>Status</th>
											
											<th class="hidden-phone">Check Items</th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php 
										
											
											foreach ($query->result() as $k) {
												# code...
											
											
										?>
										<tr>
											<td><?php echo $k->oid; ?></td>
											<td><?php echo $k->name; ?></td>
											<td><?php echo $k->phone; ?></td>
											<td><?php echo $k->items; ?></td>
											<td><?php echo $k->totalitems; ?></td>
											<td><?php echo $k->amount; ?></td>
											<td><?php echo $k->address; ?></td>
											<td><?php echo date("F jS, Y h:i:s",strtotime($k->dt));	?></td>
											<td><?php echo $k->status; ?></td>
											
											
											
											<td class="center hidden-phone">
												<!--<a href="editTiffinItems?id=<?php echo $k->oid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>-->
													<input type="checkbox" class="form-control" name="orderids[]" value="<?php echo $k->oid; ?>">
											</td>
											
											

											
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</section>
						
						<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="submit"  class="btn btn-primary hidden-xs">Submit</button>
												</div>
											</div>	
						</form>
						
<script type="text/javascript">
   function deletetiffinid(id)
   {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deletetiffinid")?>',
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