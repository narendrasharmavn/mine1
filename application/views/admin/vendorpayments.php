                                                                                                              <?php
 include 'header.php'; 

 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Vendor Payments</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Vendor Payments</span></li>
								<li><span>payment's</span></li>
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
						
										<h2 class="panel-title">vendor Payments</h2>
									</header>
									
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/submitvendorpayments',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?>

								         	<div class="row">
						                        <div class="col-md-5 col-md-offset-1">

						                        	<div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Payment Date</label>
										                <div class="col-sm-7 col-xs-7">
										                  <input type="date" class="form-control" name="pdate" id="pdate" placeholder="Enter Payment Date" value="<?php echo set_value('pdate'); ?>">
														  <span class="text-danger"><?php echo form_error('pdate'); ?></span>
										                </div>
									                </div>

                                                    <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Payment Type</label>
										                <div class="col-sm-7 col-xs-7">
										                  <select class="form-control" name="paymenttype" id="paymenttype" >
										                  	<option value="">Select Vendor name</option>
																<option value="cheque">cheque</option>
																<option value="dd">DD</option>
																<option value="cash">Cash</option>
																<option value="neft">NEFT</option>
										                  </select>
														  <span class="text-danger"><?php echo form_error('paymenttype'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Cheque/Transaction Date</label>
										                <div class="col-sm-7 col-xs-7">
										                  <input type="date" class="form-control" name="ctdate" id="ctdate" placeholder="Enter Payment Date" value="<?php echo set_value('ctdate'); ?>">
														  <span class="text-danger"><?php echo form_error('ctdate'); ?></span>
										                </div>
									                </div>
                                                    
                                                    
						                        </div>
						                        <div class="col-md-5">

						                        	<div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Choose Vendor Name</label>
										                <div class="col-sm-7 col-xs-7">
										                  <select class="form-control" name="vendorid" id="fname" >
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
														  <span class="text-danger"><?php echo form_error('vname'); ?></span>
										                </div>
									                </div>

						                        	
                                                    <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Amount</label>
										                <div class="col-sm-7">
										                  <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" value="<?php echo set_value('amount'); ?>">
														  <span class="text-danger"><?php echo form_error('amount'); ?></span>
										                </div>
									                </div>

									                <div class="form-group">
										                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Cheque/Transaction Number</label>
										                <div class="col-sm-7">
										                  <input type="text" class="form-control" name="ctno" id="ctno" placeholder="Enter Cheque/Transaction Number" value="<?php echo set_value('ctno'); ?>">
														  <span class="text-danger"><?php echo form_error('ctno'); ?></span>
										                </div>
									                </div>

									                

                                                    <div>&nbsp;</div>
									                <div>&nbsp;</div>
			                                        <div>&nbsp;</div>
						                        </div>	
						                    </div>									 

											<center>
			                                	<div class="form-group">
													<label class="col-md-3 control-label"></label>
													<div class="col-md-6 col-xs-11">
														<button type="submit"  class="btn btn-primary hidden-xs">Submit</button>
													</div>
												</div>
			                                </center>											
										</form>
										<div>&nbsp;</div>
			                            <div>&nbsp;</div>

			                            <h2 class="panel-title">vendors Payment Data</h2>
			                            <hr>
			                            <div>&nbsp;</div>
			                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
											<thead>
												<tr>
													<th>Vendor Name</th>
													<th>Payment Type</th>
													<th>Payment Date </th>
													<th>Transaction Number</th>
													<th>Transaction Date</th>
													<th>Amount</th>

													
													<th class="hidden-phone">Edit</th>
													<th class="hidden-phone">Delete</th>
													
												</tr>
											</thead>
											<tbody>
												<?php 
												
													
                                                    
													foreach ($vpayments->result() as $k) {
														# code...
													
													
												?>
												<tr>
													<td><?php echo $k->vendorname; ?></td>
													<td><?php echo $k->paymentdate; ?></td>
													<td><?php echo $k->paymenttype; ?></td>
													<td><?php echo $k->transactionnumber; ?></td>
													<td><?php echo $k->transactiondate; ?></td>
													<td><?php echo $k->amount; ?></td>
													
													
													
													
													
													<td class="center hidden-phone">
														<a href="<?php echo site_url(); ?>admin/editvendorpayment/<?php echo $k->vpid; ?>" target="_blank"  name="edit" id="edit" value="edit">
															Edit
														</a>
													</td>
													<td class="center hidden-phone"><a href="#" onclick="deletevendorpayment(<?php echo $k->vpid; ?>)">Delete</a></td>

													
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>


	<script type="text/javascript">
    function deletevendorpayment(id)
   {
   	    var uid = id;
   	    //alert(uid);
   	    if (confirm("Are You Sure You Want To Delete") == true) {
	        
            $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("vendor/deletevendorpayment")?>',
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