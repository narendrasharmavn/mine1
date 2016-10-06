<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Bookings</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Bookings</span></li>
								
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
						                <h2>Bookings</h2>
										
									</header>
									
									<div class="panel-body">
										<?php

								            echo form_open_multipart('Admin/vbookings',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         
											
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">From Date</label>
								                <div class="col-sm-7">
								                  <input type="text" id="fromdate" name="fromdate" class="form-control" required>
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">To Date</label>
								                <div class="col-sm-7">
								                  <input type="text" name="todate" id="todate" class="form-control" required>
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Select Vendor</label>
								                <div class="col-sm-7">
								                  <select class="form-control" id="vendorid" name="vendorid">
								                  	<option value="">Select Vendor name</option>
								                  	<?php
													foreach ($vendors->result() as $k) {
															//echo $k->vendorid."<br>";
														?>
														<option value="<?php echo $k->vendorid ?>"><?php echo $k->vendorname; ?></option>

														<?php
													}
													?>
								                  	
								                  </select>
												  <span class="text-danger"><?php echo form_error('pname'); ?></span>
								                </div>
								               
							                </div>
							                                                      
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="button" class="btn btn-primary getvbookings" id="getvbookings">Get</button>
													<button type="reset"  class="btn btn-danger">Cancel</button>
												</div>
											</div>
												
										</form>
                                
                                <div>&nbsp;</div>
	                            <div>&nbsp;</div>

										
                                        
			                            <h2 class="panel-title">Bookings</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Ticket No.</th>
													<th>Booking Date</th>
													<th>Package Name</th>
													<th>Customer Name</th>
													<th>Adults</th>
													<th>Children</th>
													<th>Price</th>
													
													
												</tr>
											</thead>
											<tbody id="vbookings">
												
												<tr >
													<td><?php echo $vendorb->ticketnumber; ?></td>
													<td>
														<?php echo
										$this->db->get_where('tblpackages' , array('packageid' =>$vendorb->packageid))->row()->packagename;
														  ?>
													</td>
													<td><?php echo $vendorb->name; ?></td>
													<td><?php echo $vendorb->quantity; ?>
													<br><?php echo $vendorb->childqty; ?>
													</td>
													<td><?php echo $vendorb->childqty; ?></td>
													<td><?php echo $vendorb->amount; ?></td>
													
													
													

													
												</tr>
												

											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script language="text/javascript">

	    
	    function getvendorDetails()
	    {
	    	var vendorid = $('#vendorid').val();
	    	//alert(vendorid);
           
	    	window.location.href='<?php echo site_url("admin/vbookings")?>/'+vendorid;
            
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
    $(document).ready(function(){
       /*
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
    });*/


      $('#fromdate').datepicker({
        dateFormat: "dd-mm-yy"
    });

       $('#todate').datepicker({
        dateFormat: "dd-mm-yy"
    });



		$.get('<?php echo site_url("admin/onloadvbookings")?>', function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            //console.log(data);
            $('#vbookings').html(data);
        });
    });

    $(".getvbookings").click(function(){
		var vendorid = $('#vendorid').val();
    	//alert(vendorid);
        var fromdate = $('#fromdate').val();
    	//alert(fromdate);
    	var todate = $('#todate').val();
        $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/getvbookings")?>',
		      data: {
		      	        fromdate:fromdate,
		                todate:todate,
		                vendorid:vendorid
		            },
		      success: function(res) {
		      //alert(res); 
		      console.log(res);
		      
		      $('#vbookings').html(res);
		      }
		      
	    });
    });

 </script>