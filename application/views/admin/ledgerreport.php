<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>General Ledger Reports</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>General Ledger Reports</span></li>
								
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
						                <h2>General Ledger Reports</h2>
										
									</header>
									
									<div class="panel-body">
										<?php

								            echo form_open_multipart('Admin/ledgerreport',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">From Date</label>
								                <div class="col-sm-7">
								                  <input type="text" style="cursor:default;background:white;" readonly class="form-control" name="fromdate" id="fromdate">
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">To Date</label>
								                <div class="col-sm-7">
								                  <input type="text" style="cursor:default;background:white;" readonly class="form-control" name="todate" id="todate">
												  <span class="text-danger"><?php echo form_error('todate'); ?></span>
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
													<button type="button" class="btn btn-primary getledger" id="getledger">Get</button>
													<button type="reset"  class="btn btn-danger">Cancel</button>
												</div>
											</div>
							                                                      
											
												
										</form>
                                
                                <div>&nbsp;</div>
	                            <div>&nbsp;</div>

										
                                        
			                            <h2 class="panel-title">General Ledger Reports Data</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Transaction Date</th>
													<th>Amount Recieved</th>
													<th>Amount Paid</th>
													<th>Balance</th>
													
													
												</tr>
											</thead>
											<tbody id="gledger">
												
													
												

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

 <script type="text/javascript">
 var $j = jQuery.noConflict();
 $("document").ready(function(){
         $("#fromdate").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function () {
            var dt2 = $('#todate');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            //minDate of dt2 datepicker = dt1 selected day
            dt2.datepicker('setDate', minDate);
            //sets dt2 maxDate to the last day of 30 days window
            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
            //same for dt1
            $(this).datepicker('option', 'minDate', minDate);
        }
    });

       $('#todate').datepicker({
        dateFormat: "dd-mm-yy"
    });
    });

    $(".getledger").click(function(){

 	    
		var fromdate = $('#fromdate').val();
    	//alert(fromdate);
    	var todate = $('#todate').val();
    	var vendorid = $('#vendorid').val();
    	//alert(todate);
        
        $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/getledger")?>',
		      data: {
		                fromdate:fromdate,
		                todate:todate,
		                vendorid:vendorid
		            },
		      success: function(res) {
		      //alert(res); 
		      $('#gledger').html(res);
		      }
	    });

    });
 </script>