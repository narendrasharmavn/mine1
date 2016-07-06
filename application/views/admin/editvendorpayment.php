<?php
 include 'header.php'; 
 ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Edit</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Edit Vendor Payments</span></li>
								
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Vendor Payments Edit</h2>
									</header>
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/updateVendorPayments',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         <?php
								            $id = $this->uri->segment(3, 0);
											//echo $id;
											$query = $this->db->query("SELECT * FROM tblvendorpayments WHERE vpid='$id'");
											$rows = $query->row(); 
											//$name = $rows->itemname;
							
								         ?>
                                         <input type="hidden" class="form-control" name="vpid" id="vpid"  value="<?php echo $rows->vpid; ?>">
								         <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Payment Date</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="date" class="form-control" name="paymentdate" id="paymentdate" placeholder="Enter event date" value="<?php echo $rows->paymentdate; ?>">
												  <span class="text-danger"><?php echo form_error('paymentdate'); ?></span>
								                </div>
								               
							              </div>
									
								         <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Choose Vendor Name</label>
								                <div class="col-sm-7 col-xs-7">
								                  <select class="form-control" name="vendorid" id="vendorid" >
								                  	<option value="" selected></option>
								                  	<?php
													foreach ($vendors->result() as $k) {
															//echo $k->vendorid."<br>"; eventsData
														?>
														<option value="<?php echo $k->vendorid ?>" <?php if($rows->vendorid == $k->vendorid) { echo "Selected";}?>><?php echo $k->vendorname; ?></option>

														<?php
													}
													?>
								                  	
								                  </select>
												  <span class="text-danger"><?php echo form_error('vname'); ?></span>
								                </div>
								               
							                </div> 
										 
											

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Payment Type</label>
								                <div class="col-sm-7 col-xs-7">
								                  <select class="form-control" name="paymenttype" id="paymenttype" >
								                  	<option value="">Select Vendor name</option>
														<option value="cheque" <?php if($rows->paymenttype == "cheque") { echo "Selected";}?>>cheque</option>
														<option value="dd" <?php if($rows->paymenttype == "dd") { echo "Selected";}?>>DD</option>
														<option value="cash" <?php if($rows->paymenttype == "cash") { echo "Selected";}?>>Cash</option>
														<option value="neft" <?php if($rows->paymenttype == "neft") { echo "Selected";}?>>NEFT</option>
								                  </select>
												  <span class="text-danger"><?php echo form_error('evenfromdate'); ?></span>
								                </div>
								               
							                </div>

											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Amount</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $rows->amount; ?>">
												  <span class="text-danger"><?php echo form_error('amount'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Cheque/Transaction Date</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="date" class="form-control" name="ctdate" id="ctdate" placeholder="Enter event date" value="<?php echo $rows->transactiondate; ?>">
												  <span class="text-danger"><?php echo form_error('ctdate'); ?></span>
								                </div>
								               
							                </div>

							                

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Cheque/Transaction Number</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="ctno" id="ctno"  value="<?php echo $rows->transactionnumber; ?>">
												  <span class="text-danger"><?php echo form_error('ctno'); ?></span>
								                </div>
								               
							                </div>                                  
											
											<div class="form-group">
												<label class="col-md-3 control-label"></label>
												<div class="col-md-6 col-xs-11">
													<button type="submit"  class="btn btn-primary hidden-xs">Update</button>
												</div>
											</div>	
										</form>
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

    $(document).ready(function(){
		// we call the function
		 var url = window.location.href;
		 var res = url.split("?id="); 
         var id = res[1];
         //alert(id);
        
		ajaxC(id);
        setTimeout(function(){
		  ajaxS(id);
		  setTimeout(function(){
		    ajaxM(id);
		    setTimeout(function(){
			   ajaxE(id);
			}, 2500);
		  }, 2500);
		}, 2500);
       
		


		 

    });

 </script>