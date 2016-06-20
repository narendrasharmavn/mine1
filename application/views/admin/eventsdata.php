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
						<h2>Events Information</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Data</span></li>
								<li><span>Events</span></li>
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
						
								<h2 class="panel-title">Events Data</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Vendor Name</th>
											<th>Event name</th>
											<th>Location </th>
											<th>Time</th>
											<th>Date</th>
											<th>Event type</th>
											<th>Cost</th>
											
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
											<td><?php echo $k->eventname; ?></td>
											<td><?php echo $k->location; ?></td>
											<td><?php echo $k->time; ?></td>
											<td><?php echo $k->date; ?></td>
											<td><?php echo $k->eventtype; ?></td>
											<td><?php echo $k->cost; ?></td>
											
											
											
											<td><a href="<?php echo site_url(); ?>/admin/addeventphotos/<?php echo $k->eventid; ?>">Add Pics to this Event</a></td>
											<td class="center hidden-phone">
												<a href="<?php echo site_url(); ?>/admin/editeventdata/<?php echo $k->eventid; ?>" target="_blank"  name="edit" id="edit" value="edit">
													Edit
												</a>
											</td>
											<td class="center hidden-phone"><a href="#" onclick="deleteeventid(<?php echo $k->eventid; ?>)">Delete</a></td>

											
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</section>
						
<script type="text/javascript">
   function deleteeventid(id)
   {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/deleteeventid")?>',
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