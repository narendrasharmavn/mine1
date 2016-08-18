<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>OutStanding Reports</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>OutStanding Reports</span></li>
								<li><span>Reports</span></li>
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
						                <h2>OutStanding Reports</h2>
										
									</header>
									
									<div class="panel-body">
										
                                
                                
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													
													<th>Vendor Name</th>
													<th>Amount Recieved</th>
													<th>I/H charges</th>
													<th>Amount Paid</th>
													<th>Balance</th>
													
													
												</tr>
											</thead>
											<tbody>
												<?php
												//echo count($transactions->result()); 
												$selectvendors=$this->db->query("select * from tblvendors");
												foreach ($selectvendors -> result() as $resv) {

													$getsum=$this->db->query("select sum(t.amountreceived) as amountrecieved, sum(t.servicecharges) as servicecharges,sum(t.amountpaid) as amountpaid,v.vendorname FROM `tbltransactions` t,tblvendors v where t.vendorid='$resv->vendorid' and v.vendorid='$resv->vendorid';");
													# code...
													//echo "select sum(t.amountrecieved) as amountrecieved, sum(t.servicecharges) as servicecharges,sum(t.amountpaid) as amountpaid,v.vendorname FROM `tbltransactions` t,tblvendors v where t.vendorid='$resv->vendorid';";
													$gsum = $getsum->row();

													# code...
													
														$getbalance = $this->db->query("SELECT balance FROM tbltransactions  where vendorid='$resv->vendorid'  ORDER BY tid desc limit 1");
														//echo "SELECT balance FROM tbltransactions  where vendorid='$resv->vendorid'  ORDER BY tid desc limit 1";
														$gb = $getbalance->row();
													if($getbalance->num_rows()>0)
													{
													?>

													<tr>
													
													<td>
														<?php 
														echo $gsum->vendorname;
														  ?>
													</td>
													<td><?php echo $gsum->amountrecieved; ?></td>
													<td><?php echo $gsum->servicecharges; ?></td>
													<td><?php echo $gsum->amountpaid; ?></td>
													<td> <?php
														echo $gb->balance;
													
													?>
												</td>
													
													
												</tr>





													<?php
												}
										} 
										?>
													

													
												</tr>





													<?php
												



												?>
												
												

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
	    	window.location.href='<?php echo site_url("admin/outstandingreports")?>/'+vendorid;

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