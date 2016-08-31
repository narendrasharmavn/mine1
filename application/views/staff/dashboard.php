<style type="text/css">
 
  @media print
  {    
      #printbtn
      {
          display: none !important;
      }
      #formhide
      {
      	display: none !important;
      }

      .header{
      	display: none !important;
      }
      

  }

  	body { 
		   font-family: calibri; }
	
	a { color:#006400;
	    text-decoration: none; }
	
	a:hover { color:#0099cc; 
	          text-decoration: none; } 
	
	.maintable { width: 750px;
				 height: 255px;
				 background-color: #eee;
				 border-radius: 20px;
				 margin-top: 50px; }
	
	#headertxt { color:#006400; }			 
	
	.maintable1 { border-bottom: 1px solid #ccc; }	
	
	.maintable2 { padding-top: 10px;
		          padding-bottom: 10px; }		 
	
	.img-barcode { margin-top: 10px; 
	               float: right; }
	
	.subtable { color:black; font-weight: bold; font-size: 12px;}

	.fsubtable { font-size: 12px; }

	
	.tablepara1 { font-weight: bold; }               
	
	.tablepara { /*font-size: 11px; */} 
	
	.thead-default { color:black; background-color: #ddd; }

	.maintable3 { text-align: center;
	              border-top: 1px solid #ccc;
	              padding-top: 10px; }
	
	.footertxt { color:#006400; } 

	.hideticket { display: none !important; } 
</style>

<?php 
error_reporting(0);
include 'header.php'; 
?>


				<section role="main" class="content-body" style="margin-top:10px;margin-left:0px !important;">
				

					<!-- start: page -->
					<div class="row">
					</div>
						<div class="row">
						
						<div class="col-md-12 col-lg-12 col-xl-6">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body" style="min-height:450px;">
											<div class="widget-summary">
											<div class="form-horizontal" id="formhide">
												<?php 
										            echo form_open_multipart('staff/dashboard',array('class' => 'form-horizontal', 'id' => 'myForm'));
										        ?>
										        <?php 
										           $email = $this->session->userdata('email');
										           $vendorid = $this->session->userdata('vendorid');
										           $usertype=$this->session->userdata('usertype');
										           if($usertype=='booking')
										           {
										        ?>
								        		<div class="form-group">
												  <label class="col-md-4 control-label" for="textinput">Ticket Number</label>  
												  <div class="col-md-4">
												  <input id="tckno" name="ticketnumber" type="text" minlength=10  placeholder="Enter / Scan Ticket No." class="form-control input-md" onblur="gettktnumber()">
												  </div>
												  <div class="col-md-4">
												  	<!--<input id="submit" name="submit" type="button" value="Submit" class="btn btn-primary">-->
												    <button type="submit" name="update" class="btn btn-primary">Submit</button>
												  </div>
												</div>
												</form>
												<!-- Button -->
												
								        	</div>
								        </br>
								        	<div class="row">
								        	

<div class="container" style="width:706.771653543px;height:309.921259843px;">
 <?php
 if($this->input->post('ticketnumber'))
 {
 	//echo $this->input->post('ticketnumber');
 	?>
    
    <div class="col-xs-12 col-md-12 col-lg-12 maintable1">
		<div class="col-xs-12 col-md-4 col-lg-4">
			<h5 id="headertxt"><b>Book4Holiday</b></h5>
		</div>
		<div class="col-xs-12 col-md-8 col-lg-8">

			<svg id="bcTarget"></svg>
			<p class="pull-left hideticket"><b>Ticket Number # </b><span id="ticketnumber"><?php echo $this->input->post('ticketnumber'); ?></span></p>
		</div>
	</div>

    <div class="col-xs-12 col-md-12 col-lg-12 maintable2">
			<div class="col-xs-12 col-md-5 col-lg-5">
				<table>
					<tr>
						<td class="subtable">Custmer Name</td>
						<td>:</td> 
						<td class="fsubtable"> &nbsp; <?php 
						$tckno = $this->input->post('ticketnumber');
						//echo $tckno;
						$userid = $this->db->get_where('tblbookings' , array('ticketnumber' => $tckno ))->row()->userid;   
						//echo $userid;
						$customername = $this->db->get_where('tblcustomers' , array('customer_id' => $userid ))->row()->name;   
						echo $customername; ?></td>
					</tr>
					<tr>
						<td class="subtable">Mobile No</td>
						<td>:</td> 
						<td class="fsubtable"> &nbsp; <?php $customernumber = $this->db->get_where('tblcustomers' , array('customer_id' => $userid ))->row()->number;   
						echo $customernumber; ?></td>
					</tr>
				</table>
			</div>

			<div class="col-xs-12 col-md-7 col-lg-7">
				<table>
					<tr>
						<td class="subtable">Date of Visit</td>
						<td>:</td> 
						<?php 
							$dov = $this->db->get_where('tblbookings' , array('ticketnumber' => $tckno ))->row()->dateofvisit;   
						?>
						<td class="fsubtable"> &nbsp; <?php echo date("d-m-Y", strtotime($dov)) ;?></td>
					</tr>
					<tr>
						
						<?php 
			               $packageid = $this->db->get_where('tblbookings' , array('ticketnumber' =>$tckno))->row()->packageid;
			               
			               $eventid = $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->eventid;
			               
			               $eventname = $this->db->get_where('tblevents' , array('eventid' =>$eventid))->row()->eventname;

			               $resortid = $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->resortid;
			               
			               $resortname = $this->db->get_where('tblresorts' , array('resortid' =>$resortid))->row()->resortname;
			               $name="";
			               if ($eventname!='') {
			                 $name = $eventname;
			            ?>
			            <td class="subtable">Event Name</td>
			            <?php 
			            }else{
			                $name = $resortname;
			            ?>
			            <td class="subtable">Resort Name</td>
			            <?php 
			                }

			               //echo "<b>".$name."</b>";

			            ?>
			            
						<td>:</td> 
						<td class="fsubtable"> &nbsp; <?php echo $name; ?></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="col-xs-12 col-md-12 col-lg-12">
			<table class="table">
			  	<thead class="thead-default fsubtable">
			    	<tr>
				    	
				      	<th>Packages</th>
				      	<th>Details</th>
				      	<th>Total</th>
				    </tr>
			  	</thead>
			  	<tbody class="fsubtable">
			    <?php
				    $query = $this->db->query("SELECT * from tblbookings WHERE ticketnumber='$tckno' ORDER BY bookingid DESC");
                    foreach ($query->result() as $k) {	
                    //echo "booking id is: ".$k->bookingid."<br>";		
				?>
			    	<tr>
			      		<td>
			      			<?php
								$packagename = $this->db->get_where('tblpackages' , array('packageid' =>$k->packageid))->row()->packagename; 
								echo $packagename;
						    ?>
						</td>
			      		<td>
			      			<?php 
								if ($k->quantity!=0) {
									?>
		
							    Adults: <span><?php
								 echo $k->quantity;
								    ?></span>  

									<?php
									
								}

								

								 if ($k->childqty!=0) {
							?>
						    | Child: <span><?php echo $k->childqty;   ?></span>
                            

							<?php
								 }

								 $kidsmealqty =  $this->db->get_where('tblpayments' , array('ticketnumber' =>$tckno))->row()->noofkidsmeal;
								if ($kidsmealqty!=0) {


								   ?>
                            | Kids Meal: <span><?php echo $kidsmealqty;   ?></span>
								   <?php
									
								}

								 ?>
			      		</td>
			      		<td><?php 

								 		echo "Rs. ".$this->db->get_where('tblpayments' , array('ticketnumber' =>$tckno))->row()->totalcost;

								 		  ?></td>
			      	</tr>
			    <?php } ?>
			    </tbody>
			</table>
		</div>

		<div class="col-xs-12 col-md-12 col-lg-12 maintable3">
			<div class="col-xs-12 col-md-6 col-lg-6">
				<span class="footertxt"><b>Address:</b> G-3, Royal Enclave, Madhapur, Hyderabad. </span>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<span class="footertxt">+91 40 2345 6789/0</span>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<span class="footertxt"><a href="https://accounts.google.com/" target="_blank">info@book4holiday.com</a></span>
			</div>	
		</div>
	    <center>
	    	<button class="btn btn-primary" onclick="print()" id="printbtn">Print</button>
	    </center>
        
<?php } ?>
</div>
<?php }else { ?>

<!--Security Dashboard -->

<section class="panel panel-featured-left panel-featured-primary">
	<div class="panel-body">
		<div class="widget-summary">
		<div class="form-horizontal">
           
    		<div class="form-group">
			  <label class="col-md-4 control-label" for="textinput">Ticket Number</label>  
			  <div class="col-md-4">
			  <input id="tckno" name="tckno" type="text" minlength=20  placeholder="Enter / Scan Ticket No." class="form-control input-md">
			  </div>
			  <div class="col-md-4">
			    <button type="button" id="update" name="update"  class="btn btn-primary" onclick="getTicket()">Submit</button>
			  </div>
			</div>
			
			<!-- Button -->
    	</div>
    </br>
    	<div class="row">
    	
		<p id="ticketdata"></p>
	</div>
	<!--<div class="col-md-4">
			    <button type="button" id="update" name="update" onclick="updateticket(),getTicketdata()" class="btn btn-success">Update</button>
			  </div>-->

		</div>
	</div>
</section>

<!--Security Dashboard -->

<?php } ?>

    





										</div>
										<!--<div class="col-md-4">
												    <button type="button" id="update" name="update" onclick="updateticket(),getTicketdata()" class="btn btn-success">Update</button>
												  </div>-->

											</div>
										</div>
									</section>
								</div>
							</div>
						</div>	
					</div>		
							
							
				</section>

<?php
    include 'footer.php';
?>

<script src = "<?php echo base_url(); ?>assets/js/barcodejquery.js"></script>
<script type="text/javascript">

$('document').ready(function(){
    $('#ticketdate-display').text($('#dateofvisit').val());
    JsBarcode("#bcTarget", $('#ticketnumber').text(), {
  
  lineColor: "black",
  width:1,
  height:20,
  
});
    
});


$('#searchtype').on('change',function(){
    if(this.value=='eventname'){
        $('.datefield').show();
    }else{
        $('.datefield').hide();
    }

});


function printfunction(){
	window.print();
}

function gettktnumber()
{
    document.getElementById("myForm").submit();
}

</script>
			
<script type="text/javascript">

    

    function getTicket()
    {
    	var ticketno=$('#tckno').val();
	    //alert(ticketno);
	    $.ajax({
	    type: "POST",
	    url: '<?php echo site_url("staff/updateticket")?>',
	    data: {
	        ticketno:ticketno

	    },
	    success: function(res) {
	    	  console.log(res);
              if (res.trim()=="true") { 
              	$('#tckno').val('');
              	$('#ticketdata').html("Visited");
              }else {
              	console.log(res);
                $('#ticketdata').html("Invalid");
              }
	                   
	    },
	            error: function (xhr, ajaxOptions, thrownError) {
	              console.log(xhr.status);
	              console.log(thrownError);
	              console.log(xhr.responseText);
	            }
	    });

    }
    /*
	document.getElementById('tckno').onkeydown = function(e){
	if(e.keyCode == 13){   
		
	    var ticketno=$('#tckno').val();
	    //alert(ticketno);
	   
	    $.ajax({
	    type: "POST",
	    url: '<?php echo site_url("staff/updateticket")?>',
	    data: {
	        ticketno:ticketno

	    },
	    success: function(res) {
	    	  console.log(res);
                
	            if (res.trim()=="true") {
	                //alert("updated");
	                $('#tckno').val('');
	                $('#ticketdata').html("Visited");
					
	            } else{
	            	//alert("Failed");
	            	$('#ticketdata').html("Invalid");
	                console.log(res);
	            }        //$('#email').html(res);
	    },
	            error: function (xhr, ajaxOptions, thrownError) {
	             // alert(xhr.status);
	              //alert(thrownError);
	              //alert(xhr.responseText);
	            }
	    });
       
	}
	}*/

	
</script>


		