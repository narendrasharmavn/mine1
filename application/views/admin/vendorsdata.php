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
						<h2>Vendor's Information</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Data</span></li>
								<li><span>Vendors</span></li>
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
						
								<h2 class="panel-title">Vendors Data</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Vendor Name</th>
											<th>Contact Person</th>
											<th>Address 1 </th>
											<th>City</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Landline</th>
											<th>Website</th>
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
											<td><?php echo $k->vendorname; ?></td>
											<td><?php echo $k->contact_person; ?></td>
											<td><?php echo $k->Address1; ?></td>
											<td><?php echo $k->city; ?></td>
											<td><?php echo $k->email; ?></td>
											<td><?php echo $k->mobile; ?></td>
											<td><?php echo $k->landline; ?></td>
											<td><?php echo $k->website; ?></td>
											
											
											<td><a href="addvendorphotos/<?php echo $k->vendorid; ?>">Add Pics to this vendor</a></td>
											<td class="center hidden-phone">
												<a href="editvendorsdata?id=<?php echo $k->vendorid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deletevendorid(<?php echo $k->vendorid; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</section>
						
<script type="text/javascript">
   function deletevendorid(id)
   {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deletevendorid")?>',
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