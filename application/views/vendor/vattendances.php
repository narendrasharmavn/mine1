<?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Attendees</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Attendees</span></li>
								
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
						                <h2>Attendees</h2>
										
									</header>
									
									<div class="panel-body">
                                        <?php

								            echo form_open_multipart('vendor/vattendances',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         
											
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">From Date</label>
								                <div class="col-sm-7">
								                  <input type="text" style="cursor:default;background:white;" readonly id="fromdate" name="fromdate" class="form-control" required>
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">To Date</label>
								                <div class="col-sm-7">
								                  <input type="text" style="cursor:default;background:white;" readonly name="todate" id="todate" class="form-control" required>
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                
								                <div class="col-sm-7">
								                  <?php $vendorid = $this->session->userdata('vendorid'); ?>
								                  <input type="hidden" name="vendorid" id="vendorid" class="form-control" value="<?php echo $vendorid; ?>" required>
												  <span class="text-danger"><?php echo form_error('fromdate'); ?></span>
								                </div>
								               
							                </div>
							                                                      
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="button" class="btn btn-primary getvattendances" id="getvattendances">Get</button>
													<button type="reset"  class="btn btn-danger">Cancel</button>
												</div>
											</div>
												
										</form>
                                
                                <div>&nbsp;</div>
	                            <div>&nbsp;</div>

										
                                        
			                            <h2 class="panel-title">Attendees</h2>
			                            <hr>
			                            
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Ticket No.</th>
													<th>Package Name</th>
													<th>Customer Name</th>
													<th>Adults</th>
													<th>Children</th>
													<th>Price</th>
													
													
												</tr>
											</thead>
											<tbody id="vattendances">
												
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">

	    

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
            //$(this).datepicker('option', 'minDate', minDate);
        }
    });*/

      $('#fromdate').datepicker({
        dateFormat: "dd-mm-yy"
    });

       $('#todate').datepicker({
        dateFormat: "dd-mm-yy"
    });




		$.get('<?php echo site_url("vendor/onloadvattendances")?>', function(data, status){
            //alert("Data: " + data + "\nStatus: " + status);
            //console.log(data);
            $('#vattendances').html(data);
        });
    });

    $(".getvattendances").click(function(){
		var vendorid = $('#vendorid').val();
    	//alert(vendorid);
        var fromdate = $('#fromdate').val();
    	//alert(fromdate);
    	var todate = $('#todate').val();
    	
        $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("vendor/getvattendances")?>',
		      data: {
		      	        fromdate:fromdate,
		                todate:todate,
		                vendorid:vendorid
		            },
		      success: function(res) {
		      //alert(res); 
		      console.log(res);
		      
		      $('#vattendances').html(res);
		      }
		      
	    });
         
    });
</script>