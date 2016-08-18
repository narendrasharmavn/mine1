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
						<h2>Packages Information</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Data</span></li>
								<li><span>Packages</span></li>
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
						
								<h2 class="panel-title">Packages Data</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Package Name</th>
											<th>Description</th>
											<th>Amount </th>
											<th>Service Tax</th>
											<th>Package Type</th>
											<th>Package Tags</th>
											<th>Created By</th>
											<th>Created On</th>
											
											

											
											
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
											<td><?php echo $k->packagename; ?></td>
											<td><?php echo $k->description; ?></td>
											<td><?php echo $k->adultprice; ?></td>
											<td><?php echo $k->servicetax; ?></td>
											<td><?php echo $k->packagetype; ?></td>
											<td><?php echo $k->packagetags; ?></td>
											<td><?php echo $k->createdby; ?></td>
											<td><?php echo $k->createdon; ?></td>
											
											
											
											
											
											
											<td class="center hidden-phone">
												<a href="editpackagedata?id=<?php echo $k->packageid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deleteresortid(<?php echo $k->packageid; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</section>
						
<script type="text/javascript">
   function deleteresortid(id)
   {
   	    var uid = id;
   	    //alert(uid);
   	    
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("vendor/deletepackageid")?>',
		      data: {
		             
		             uid:uid
		            },
		      success: function(res) {
		      alert(res); 
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