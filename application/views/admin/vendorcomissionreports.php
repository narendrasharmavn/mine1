<?php
    include 'header.php'; 
?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Vendor Commission Report</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Vendor Commission Report</span></li>
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
						                <h2>Vendor Commission Report</h2>
										
									</header>
									
									<div class="panel-body">
										<?php

								            echo form_open_multipart('Admin/vbookings',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         
											


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">From Date</label>
								                <div class="col-sm-7">
								                  <input type="date" id="fromdate" name="fromdate" class="form-control" required>
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">To Date</label>
								                <div class="col-sm-7">
								                  <input type="date" name="todate" id="todate" class="form-control" required>
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Select Vendor</label>
								                <div class="col-sm-7">
								                  <select class="form-control" id="vendorid" name="vendorid" required>
								                  	<option value="">Select Vendor name</option>
								                  	<?php
													foreach ($vendors->result() as $k) {
															//echo $k->vendorid."<br>";
														?>
														<option value="<?php echo $k->vendorid ?>"><?php echo $k->vendorname; ?></option>

														<?php
													}
													?>
													<option value="all">All</option>
								                  	
								                  </select>
												  <span class="text-danger"><?php echo form_error('pname'); ?></span>
								                </div>
								               
							                </div>


		                                	<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="button"  class="btn btn-primary getvcommission" id="getvcommission">Get</button>
													<button type="reset"  class="btn btn-danger">Cancel</button>
												</div>
											</div>
			                               

		                                	
			                                                                  
										</form>
                                
                                <div>&nbsp;</div>
	                            <div>&nbsp;</div>

										
                                        
			                            <h2 class="panel-title">Vendor Commission Report</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Vendor Name</th>
													<th>Transaction Date</th>
													<th>Amount Recieved</th>
													<th>I/H Charges</th>
													
													
													
												</tr>
											</thead>
											<tbody id="vcommission">
												
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
	    	var fromdate = $('#fromdate').val();
	    	var todate = $('#todate').val();
	    	//alert(vendorid);
	    	window.location.href='<?php echo site_url("admin/vendorcomissionreports")?>/'+vendorid+'/'+fromdate+'/'+todate;

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

<script type="text/javascript">
    $(document).ready(function(){
		$.get('<?php echo site_url("admin/loadvendorcommissionreport")?>', function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            //console.log(data);
            $('#vcommission').html(data);
        });
    });

    $(".getvcommission").click(function(){

 	    
		var fromdate = $('#fromdate').val();
    	//alert(fromdate);
    	var todate = $('#todate').val();
    	var vendorid = $('#vendorid').val();
    	//alert(todate);
        
        $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/getvendorcommissionreport")?>',
		      data: {
		                fromdate:fromdate,
		                todate:todate,
		                vendorid:vendorid
		            },
		      success: function(res) {
		      //alert(res); 
		      $('#vcommission').html(res);
		      }
	    });

    });
</script>