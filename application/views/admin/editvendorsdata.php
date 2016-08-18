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
								<li><span>Edit Vendor Data</span></li>
								
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
						
										<h2 class="panel-title">Vendor Edit</h2>
									</header>
									<div class="panel-body">
										
										<?php 
								            echo form_open_multipart('Admin/updateVendorsData',array('class' => 'form-horizontal','id' => 'editvendors'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         <?php
								            $id = $_GET['id']; 
											//echo $id;
											$query = $this->db->query("SELECT * FROM tblvendors WHERE vendorid='$id'");
											$rows = $query->row(); 
											//$name = $rows->itemname;
											$bookingtype = $rows->bookingtype;
											
											
								         ?>
											

							               <?php echo $this->session->flashdata('success'); ?> 
										 
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Vendor Name *</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="text" class="form-control" name="vname" placeholder="Enter vendor name" value="<?php echo $rows->vendorname; ?>">
												  <!--<span class="text-danger"><?php echo form_error('vname'); ?></span>-->
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Contact Person *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="cperson"  placeholder="Enter contact person name" value="<?php echo $rows->contact_person; ?>">
												  <!--<span class="text-danger"><?php echo form_error('cperson'); ?></span>-->
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 1 *</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="address1"><?php echo $rows->Address1; ?></textarea>
												  <span class="text-danger"><?php echo form_error('address1'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 2</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="address2" ><?php echo $rows->Address2; ?></textarea>
												  <span class="text-danger"><?php echo form_error('address2'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Booking Type *</label>
								                <div class="col-sm-7">
								                    <select name="btype" id="btype" class="form-control">
							         				    <option value="" <?php if($bookingtype == '' ) { echo "Selected";}?>>Select Booking Type</option>
							         				    <option value="singlecheckout" <?php if($bookingtype == 'singlecheckout' ) { echo "Selected";}?>>Single Package Booking</option>
							         				    <option value="multicheckout" <?php if($bookingtype == 'multicheckout' ) { echo "Selected";}?>>Multi Package Booking</option>
							         					
													</select>
												    <span class="text-danger"><?php echo form_error('btype'); ?></span>
								                </div>
								               
							                </div>

                                             <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Kids Meal</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="kidsmeal" id="kidsmeal" placeholder="Enter kidsmeal" value="<?php echo $rows->kidsmealprice; ?>">
												  <span class="text-danger"><?php echo form_error('kidsmeal'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor city *</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="city" placeholder="Enter city" value="<?php echo $rows->city; ?>">
												  <span class="text-danger"><?php echo form_error('city'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Pincode</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode" value="<?php echo $rows->pincode; ?>">
												  <span class="text-danger"><?php echo form_error('pincode'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Landline</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="landline" placeholder="Enter Landline" value="<?php echo $rows->landline; ?>">
												  <span class="text-danger"><?php echo form_error('landline'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Mobile*</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="mobile" disabled placeholder="Enter Mobile" value="<?php echo $rows->mobile; ?>">
												  <span class="text-danger"><?php echo form_error('mobile'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Email*</label>
								                <div class="col-sm-7">
								                  <input type="email" class="form-control" name="email" disabled placeholder="Enter Email" value="<?php echo $rows->email; ?>">
												  <span class="text-danger"><?php echo form_error('email'); ?></span>
								                </div>
								               
							                </div>


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Password</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="password" disabled placeholder="Enter Password" value="<?php echo $rows->password; ?>">
												  <span class="text-danger"><?php echo form_error('password'); ?></span>
								                </div>
								               
							                </div>


							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Website</label>
								                <div class="col-sm-7">
								                	<input type="hidden" name="vendorid" value="<?php echo $_GET['id']; ?>">
								                  <input type="text" class="form-control" name="websitelink" placeholder="Website Link" value="<?php echo $rows->website; ?>">
												  <span class="text-danger"><?php echo form_error('websitelink'); ?></span>
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

	    
	 


	    // check email id is available starts //

	    function check_email()
	    {
	        var lemail=$("#email").val();
	        //alert(lemail);
	        $.ajax({
	        type: "POST",
	        url: '<?php echo site_url("admin/checkemail")?>',
	        data: {lemail:lemail},
	        success: function(res) {
	        //alert(res); 
	        $('#email').html(res);
	        }
	        });  

	        
	    }

	    // check email id is available ends // 




	</script>
						
								
<?php
 include 'footer.php'; 

 ?>

 <script type="text/javascript">

    $(document).ready(function(){
		//alert("hellow");
		// we call the function
		 var url = window.location.href;
		 var res = url.split("?id="); 
         var id = res[1];
         //alert(id);
        
		
       
		$("#editvendors").validate({
    
        // Specify the validation rules
        rules: {
            vname: "required",
			cperson : "required",
			address1 : "required",
			btype: "required",
			city : "required",
			email : "required",
			mobile: "required"
		},
        
        // Specify the validation error messages
        messages: {
            vname: "Please enter your first name",
            cperson: "Please enter Contact Person",
            address1: "Please enter atleast one address",
            btype: "Please Selct Booking Type",
            city: "Please enter City",
            email: "Please enter Email ID",
            mobile: "Please enter Mobile Number"
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });


		 

    });

 </script>