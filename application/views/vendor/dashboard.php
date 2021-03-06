<?php 
include 'header.php'; 
?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
						
						<div class="col-md-6 col-lg-12 col-xl-6">
							<div class="row">
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
											<div class="form-horizontal">
												<?php 
								            	
								        		?>
								        		<div class="form-group">
												  <label class="col-md-4 control-label" for="textinput">Ticket Number</label>  
												  <div class="col-md-4">
												  <input id="tckno" name="tckno" type="text" minlength=20  placeholder="Enter / Scan Ticket No." class="form-control input-md">
												  </div>
												  <div class="col-md-4">
												    <button type="submit" id="update" name="update" onclick="getTicketdata(),updateticket()" class="btn btn-primary">Update</button>
												  </div>
												</div>

												<!-- Button -->
												
								        	</div>
								        </br>
								        	<div class="row">
								        	<table class="table table-bordered">
												<tbody id="ticketdata">
													
												</tbody>
											</table>
										</div>
										<!--<div class="col-md-4">
												    <button type="button" id="update" name="update" onclick="updateticket(),getTicketdata()" class="btn btn-success">Update</button>
												  </div>-->

											</div>
										</div>
									</section>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-users"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Total Bookings Today</h4>
														<?php
                                                            $vendorid = $this->session->userdata('vendorid');
														    $gettotalbookingstoday = $this->db->query("SELECT * FROM tblbookings WHERE vendorid='$vendorid' AND date >= CURDATE()");
														    $processedResults = $gettotalbookingstoday->num_rows();

														?>
														<div class="info">
															<strong class="amount"><?php echo $processedResults;  ?></strong>
															<span class="text-primary"></span>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase"></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-secondary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Total Amount Recieved</h4>
														<?php
                                                           
														    $vendorid = $this->session->userdata('vendorid');
														    $gettotalbookingstoday = $this->db->query("SELECT * FROM tblbookings WHERE vendorid='$vendorid' AND date >= CURDATE()");
														    foreach ($gettotalbookingstoday->result() as $k) {
														    	$bookingid = $k->bookingid;
														    	$gettotalcollectionstoday = $this->db->query("SELECT sum(totalcost) as totalcost FROM tblpayments WHERE bookingid='$bookingid' and status='paid' and transactiontime>=date_format(now(),'%Y-%m-%d')");
														        $gctResults = $gettotalcollectionstoday->row();
														        $gtbt = $gctResults->totalcost;
														        $gtbt = round($gtbt, 2);
                                                                $gtbt = sprintf("%.2f", $gtbt);
														    
														 ?>   
														    
														<div class="info">
															<strong class="amount"><?php echo $gtbt;  ?></strong>
														</div>
                                                        <?php } ?>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase"></a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							
				</section>
			</div>
<script type="text/javascript">
	document.getElementById('tckno').onkeydown = function(e){
	if(e.keyCode == 13){   
		
	    var ticketno=$('#tckno').val();
	    //alert(ticketno);
	    $.ajax({
	    type: "POST",
	    url: '<?php echo site_url("vendor/updateticket")?>',
	    data: {
	        ticketno:ticketno

	    },
	    success: function(res) {

	            if (res.trim()=="true") {
	                //alert("updated");
	                $('#tckno').val('');
					getTicketdata();
	            } else{
	            	//alert("Failed");
	                console.log(res);
	            }        //$('#email').html(res);
	    },
	            error: function (xhr, ajaxOptions, thrownError) {
	             // alert(xhr.status);
	              //alert(thrownError);
	              //alert(xhr.responseText);
	            }
	    });
        getTicketdata();
	}
	}

	function getTicketdata()
	{
		var ticketno=$('#tckno').val();
	    //alert(ticketno);

	    $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("vendor/getticketdata")?>',
		      data: {
		      	        ticketno:ticketno
		            },
		      success: function(res) {
		      //alert(res); 
		      console.log(res);
		      
		      $('#ticketdata').html(res);
		      }
		      
	    });


	    


	}
</script>


		<!-- Vendor -->
		<script src="<?php echo base_url(); ?>assets/assets/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="<?php echo base_url(); ?>assets/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		
		<script src="<?php echo base_url(); ?>assets/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url(); ?>assets/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url(); ?>assets/assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="<?php echo base_url(); ?>assets/assets/javascripts/dashboard/examples.dashboard.js"></script>
	</body>
</html>