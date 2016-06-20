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
								            echo form_open_multipart('Admin/updateVendorsData',array('class' => 'form-horizontal'));
								        ?>

								         <?php echo $this->session->flashdata('success'); ?> 
								         <?php
								            $id = $_GET['id']; 
											//echo $id;
											$query = $this->db->query("SELECT * FROM tblvendors WHERE vendorid='$id'");
											$rows = $query->row(); 
											//$name = $rows->itemname;
											
											
								         ?>
											

							               <?php echo $this->session->flashdata('success'); ?> 
										 
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 col-xs-5 control-label pull-left">Vendor Name</label>
								                <div class="col-sm-7 col-xs-7">
								                  <input type="text" class="form-control" name="vname" id="fname" placeholder="Enter vendor name" value="<?php echo $rows->vendorname; ?>">
												  <span class="text-danger"><?php echo form_error('vname'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Contact Person</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="cperson" id="fname" placeholder="Enter contact person name" value="<?php echo $rows->contact_person; ?>">
												  <span class="text-danger"><?php echo form_error('cperson'); ?></span>
								                </div>
								               
							                </div>
											
											<div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 1</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="address1" id="fname"><?php echo $rows->Address1; ?></textarea>
												  <span class="text-danger"><?php echo form_error('address1'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Address 2</label>
								                <div class="col-sm-7">
								                  <textarea class="form-control" name="address2" id="fname"><?php echo $rows->Address2; ?></textarea>
												  <span class="text-danger"><?php echo form_error('address2'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor city</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="city" id="fname" placeholder="Enter city" value="<?php echo $rows->city; ?>">
												  <span class="text-danger"><?php echo form_error('city'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Pincode</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="pincode" id="fname" placeholder="Enter Pincode" value="<?php echo $rows->pincode; ?>">
												  <span class="text-danger"><?php echo form_error('pincode'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Landline</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="landline" id="fname" placeholder="Enter Landline" value="<?php echo $rows->landline; ?>">
												  <span class="text-danger"><?php echo form_error('landline'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Mobile</label>
								                <div class="col-sm-7">
								                  <input type="text" class="form-control" name="mobile" id="fname" disabled placeholder="Enter Mobile" value="<?php echo $rows->mobile; ?>">
												  <span class="text-danger"><?php echo form_error('mobile'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Vendor Email</label>
								                <div class="col-sm-7">
								                  <input type="email" class="form-control" name="email" id="fname" disabled placeholder="Enter Email" value="<?php echo $rows->email; ?>">
												  <span class="text-danger"><?php echo form_error('email'); ?></span>
								                </div>
								               
							                </div>

							                <div class="form-group" style="margin-right: 442px;">
								                <label for="inputEmail3" class="col-sm-5 control-label pull-left">Website</label>
								                <div class="col-sm-7">
								                	<input type="hidden" name="vendorid" value="<?php echo $_GET['id']; ?>">
								                  <input type="text" class="form-control" name="websitelink" id="fname" placeholder="Website Link" value="<?php echo $rows->website; ?>">
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

	    //Height Script// 

	      function roundit(which){
	        return Math.round(which*100)/100
	      }
	      
	      function roundit(which){
	        return Math.round(which*100)/100
	      }

	      function convercms(phval)
	      {
	      ///var cms= (phval/0.032808).toFixed(2);;

	      ///var cms= phval*30.48;

	      with (document.register_form){
	      cms=roundit(height.value*30.48);
	      document.getElementById('hgtcms').innerHTML =cms+" cms";

	      }
	      }

	      function convert_CMtoFT(cms)
	      {
	        var inch_val = Math.round(cms * 0.393701);
	        ///alert(inch_val);
	        var tot_inches = inch_val/12;
	        
	        var ft = Math.floor(tot_inches);
	        var inch_val = inch_val%12;
	        /*var str_tot_inch = tot_inches.toString();
	        var arr = str_tot_inch.split('.');
	        var ft = arr[0];
	        var inch = arr[1];
	        
	        var inch_dec = inch.substring(0,1);
	        var inches = new Number(inch_dec);
	        var inch_val = inches+1;*/
	        
	        
	        if(inch_val<10)
	        {
	          var ft_inch = ft+'.0'+inch_val;
	        }
	        
	        else 
	        {
	          var ft_inch = ft+'.'+inch_val;
	        }
	        ///var inch = Math.round(arr[1]);
	        
	         var heightlistbox = document.getElementById("height");
	       
	        for(var x=0;x < heightlistbox.length  ; x++)
	        {
	           
	           if(heightlistbox.options[x].value == ft_inch)
	           {
	        
	            heightlistbox.options[x].selected = true;
	            return ;
	           }
	        }
	      }

	      function convert_FTtoCM(ip)
	      {
	        var arr = ip.split('.');
	        var ft = arr[0];
	        var inch = arr[1];
	        var f_dig = inch.substring(0,1);
	        if(f_dig==0)
	        {
	          inch = inch.substring(1);
	        }
	        var inches = new Number(inch);
	        var tot_inch = (12*ft )+ inches;
	        ///alert(ft+'--'+inch+'--'+tot_inch);
	        var cms = tot_inch * 2.54;
	        cms = Math.round(cms);
	        
	        ///alert(cms);
	        
	         var cmslistbox = document.getElementById("CMS")
	       
	        for(var x=0;x < cmslistbox.length  ; x++)
	        {
	           
	           if(cmslistbox.options[x].value == cms)
	           {
	        
	            cmslistbox.options[x].selected = true;
	            return ;
	           }
	        }
	      }
	      
	      
	    //Ends Height Script// 


	    // States Select Option Starts//

	    function ajaxFunction(){
	        var country = document.getElementById("country").value;
	        //alert(country);
	     
	      	$.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/ajaxcountry")?>',
		      data: {country:country},
		      success: function(res) {
		      //alert(res); 
		      $('#states').html(res);
		      }
		     });  
	    }

	    function ajaxC(id){
	        var uid = id;
	        var country = document.getElementById("country").value;
	        //alert(country);
	     
	     
	      	$.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/ajaxcountry")?>',
		      data: {country:country,uid:uid},
		      success: function(res) {
		      //alert(res); 
		      $('#states').html(res);
		      }
		     });  
	    }

	    // States Select Option Ends//

	    // districts Select Option Starts//


	    function ajaxState(){
	    	
	        var state = document.getElementById("states").value;
	        //alert(state);
	        $.ajax({
	      type: "POST",
	      url: '<?php echo site_url("admin/ajaxstates")?>',
	      data: {state:state},
	      success: function(res) {
	      //alert(res); 
	      $('#districts').html(res);
	      }
	      });  
	    }


	    function ajaxS(id){
	    	var uid = id;
	        var state = document.getElementById("states").value;
	        //alert(state);
	        $.ajax({
	      type: "POST",
	      url: '<?php echo site_url("admin/ajaxstates")?>',
	      data: {state:state,uid:uid},
	      success: function(res) {
	      //alert(res); 
	      $('#districts').html(res);
	      }
	      });  
	    }

	    // district Select Option Ends//

	    // mandal select option starts //

	    function ajaxMandals()
	    {
	        var district = document.getElementById("districts").value;
	        //alert(district);
	        $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/ajaxmandals")?>',
		      data: {district:district},
		      success: function(res) {
		      //alert(res); 
		      $('#mandals').html(res);
		      }
		    });  
	    }

	    function ajaxM(id)
	    {
	    	var uid = id;
	        var district = document.getElementById("districts").value;
	        //alert(district);
	        $.ajax({
		      type: "POST",
		      url: '<?php echo site_url("admin/ajaxmandals")?>',
		      data: {district:district,uid:uid},
		      success: function(res) {
		      //alert(res); 
		      $('#mandals').html(res);
		      }
		    });  
	    }

	    // mandal select option ends //

	    // birthstar select option starts //
        
         function getAjaxRaasi(birthstar)
	      {
	        //alert(birthstar);
	        $.get("ajax_get_raasi1",{ birth_star_id:birthstar },function(response){
	        var raasi=response.trim();
	        var raasilistbox=document.getElementById("raasi");
	        for(var x=0;x < raasilistbox.length; x++)
	        {  
	          if(raasilistbox.options[x].value==raasi)
	          {
	            raasilistbox.options[x].selected = true;
	            return ;
	          }
	        }
	        });
	      }



	    // birthstar select option ends //

	    // education select option starts //

	    function ajaxEducation()
	    {
	      var edtype = document.getElementById("edtype").value;
	      
	      //alert(edtype);
	      $.ajax({
	      type: "POST",
	      url: '<?php echo site_url("admin/ajaxeducation")?>',
	      data: {
	             edtype:edtype
	             
	            },
	      success: function(res) {
	      //alert(res); 
	      $('#education').html(res);
	      }
	      }); 
	    }

	    function ajaxE(id)
	    {
	      var uid = id;
	      var edtype = document.getElementById("edtype").value;
	      
	      //alert(edtype);
	      $.ajax({
	      type: "POST",
	      url: '<?php echo site_url("admin/ajaxeducation")?>',
	      data: {
	             edtype:edtype,
	             uid:uid
	            },
	      success: function(res) {
	      //alert(res); 
	      $('#education').html(res);
	      }
	      }); 
	    }

	    // education select option ends //

	    // hiding fields //

	    function hideFields()
	    {
	    	var religion=$("#religion").val();
	    	//alert(religion);
	    	if(religion=='Christian' || religion=='Muslim - Shia' || religion=='Muslim - Sunni' || religion=='Muslim - Others')
	    	{
                 $('#hgothram').hide();
                 $('#hbstar').hide();
                 $('#hpadam').hide();
	    	}else{
	    		$('#hgothram').show();
                $('#hbstar').show();
                $('#hpadam').show();
	    	}
	    }

	    // hiding fields //

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