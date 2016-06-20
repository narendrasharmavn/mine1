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
						<h2>Resorts Information</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Data</span></li>
								<li><span>Resorts</span></li>
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
						
								<h2 class="panel-title">Resorts Data</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Vendor Name</th>
											<th>Resort Name</th>
											<th>Location </th>
											<th>Description</th>
											<th>Created By</th>
											<th>Created On</th>
											<th>Updated By</th>
											<th>Updated On</th>
											

											
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
											<td><?php echo $k->resortname; ?></td>
											<td><?php echo $k->location; ?></td>
											<td><?php echo $k->description; ?></td>
											<td><?php echo $k->createdby; ?></td>
											<td><?php echo $k->createdon; ?></td>
											<td><?php echo $k->updatedby; ?></td>
											<td><?php echo $k->updatedon; ?></td>
											
											
											
											
											<td><a href="<?php echo site_url(); ?>/admin/addresortphotos/<?php echo $k->resortid; ?>">Add Pics to this Event</a></td>
											<td class="center hidden-phone">
												<a href="<?php echo site_url(); ?>/admin/updateresorts/<?php echo $k->resortid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deleteresortid(<?php echo $k->resortid; ?>)">Delete</a></td>

											
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
		      url: '<?php echo site_url("admin/deleteresortid")?>',
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