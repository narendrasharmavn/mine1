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

	body { font-size: 14px;
		   font-family: calibri;
		   /*transform: rotate(90deg);
		   -webkit-transform: rotate(90deg);
		   -moz-transform: rotate(90deg);
           -o-transform: rotate(90deg);
           -ms-transform: rotate(90deg);*/     }
	
	#printableArea { margin-top: 30px; }
	
	table { padding:5px; }	
	
	a { color:#006400;
	    text-decoration: none; }
	
	a:hover { color:#0099cc; 
	          text-decoration: none; } 
	
	.table-one { width: 750px; 
				 height: 400px;
				 background-color: #eee;
				 border-radius: 8px; }
	
	.table-title { color: #006400;
				   margin-left:20px; 
				   font-size: 35px;	}
	
	.table-img { width: 300px;
                 height: 75px;
				 margin-left:55px; }
	
	.tdtextsize { font-size: 18px; } 
	
	.table-rowone { border-bottom:1px dashed #ccc; }
	
	.table-classone { margin-top: 8px;
					  
					  margin-left: 50px;
					  float:left;}
	
	.table-classtwo { margin-top: 8px;
					  
					  margin-right: 40px;
					  float:right;	}

	.table-classthree { 
					  margin-bottom: 8px;
					  margin-left: 50px;
					  float:left;}
	
	.main-table { margin-bottom: 10px; } 
	
	.table-row1 { margin-left: 50px; 
				  float: left; }
	
	.table-row2 { margin-left: 70px;
				  float: right;	}
	
	.table-row3 { margin-left: 154px;
				  float: right;	}
	
	.table-row4 { background-color:#dcdcdc; }	
	
	.table-row5 { color: #006400; text-align: center; }
	
	.table-row6 { text-align: center; }


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
    echo form_open('staff/securitydashboard',array('id'=>'myForm','method'=>'post'));
?>

								        		<div class="form-group">
												  <label class="col-md-4 control-label" for="textinput">Ticket Number</label>  
												  <div class="col-md-4">
												  <input id="tckno" name="ticketnumber" type="text"  placeholder="Enter / Scan Ticket No." class="form-control input-md" onblur="gettktnumber()">
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


 	$tckno=$this->input->post('ticketnumber');
        $dt = date('Y-m-d');
        $vendorid = $this->session->userdata('vendorid');
        
        //$query = "SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND dateofvisit='date(now())' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'";
        $getflag = $this->db->query("SELECT flag FROM tblbookings WHERE ticketnumber='$tckno' AND vendorid='$vendorid' AND dateofvisit='$dt' AND booking_status='booked' AND payment_status='paid' AND visitorstatus='absent'");
       
        
        if($getflag->num_rows()>0)
        {
            $vdata = array(
              'visitorstatus'=>'visited',
              'flag' => '1'
            );
            $this->db->update('tblbookings', $vdata, array('ticketnumber' => $tckno));
            //echo "true";
            echo '<div class="alert alert-success text-center">Ticket Valid</div>';
          
        }else{
            //echo "false";
            echo '<div class="alert alert-danger text-center">Ticket Invalid</div>';
            
        } 



 	$tckno = $this->input->post('ticketnumber');
 	$vid = $this->session->userdata('vendorid');
    $dt = date('Y-m-d');
 	$getflag = $this->db->query("SELECT * FROM tblbookings WHERE ticketnumber='$tckno' AND dateofvisit='$dt' AND vendorid='$vid' AND booking_status='booked' AND payment_status='paid' AND visitorstatus!='absent'");
 	
 	//echo "<h1>amar ".$getflag->num_rows()."</h1>";
 	if($getflag->num_rows()>0)
 	{
 	?>
 
<!-- Pradeep code start -->
 	<div id="printableArea">
		<table align="center" class="table-one">
				<tr>
					<td>
						<table class="table-rowone">
							<tr>
								<td width="375px">
									<h2 class="table-title"><b>Book4Holiday</b></h2>
								</td>
								<td width="375px">
									
									<svg id="bcTarget" class="table-img"></svg>
									
									<input type="hidden" id="ticketnumber" value="<?php echo $this->input->post('ticketnumber'); ?>">
								</td>
							</tr>
						</table>
						
						<table width="325px" class="table-classone">
							<tr>
								<td class="tdtextsize"> <b> Customer Name </b> </td>
								<td class="tdtextsize"> : </td>
								<td class="tdtextsize"> 
								    <?php 
										$tckno = $this->input->post('ticketnumber');
										//echo $tckno;
										$userid = $this->db->get_where('tblbookings' , array('ticketnumber' => $tckno ))->row()->userid;   
										//echo $userid;
										$customername = $this->db->get_where('tblcustomers' , array('customer_id' => $userid ))->row()->name;   
										echo $customername; 
								    ?>
							    </td>
							</tr>
							<tr>
								<td class="tdtextsize"> <b> Mobile </b> </td>
								<td class="tdtextsize"> : </td>
								<td class="tdtextsize"> 
								     <?php $customernumber = $this->db->get_where('tblcustomers' , array('customer_id' => $userid ))->row()->number;   
						echo $customernumber; ?>
								</td>
							</tr>
							
						</table>
						<table width="325px" class="table-classtwo">
							<tr>
								<td class="tdtextsize"> <b> Date Of Visit </b> </td>
								<td class="tdtextsize"> : </td>
								<td class="tdtextsize"> <?php
								$dt =  $this->db->get_where('tblbookings' , array('ticketnumber' => $tckno ))->row()->dateofvisit;
								echo date("d-m-Y", strtotime($dt));
								 ?> </td>
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
			            <td class="tdtextsize"><b>Event Name</b></td>
			            <?php 
			            }else{
			                $name = $resortname;
			            ?>
			            <td class="tdtextsize"><b>Place of Visit</b></td>
			            <?php 
			                }

			               //echo "<b>".$name."</b>";

			            ?>
			            
						<td>:</td> 
						<td class="tdtextsize"> &nbsp; <?php echo $name; ?></td>
					</tr>
						
						</table>
						<table width="700px" class="table-classthree">
						   	<tr>
								<td class="tdtextsize"> <b> Address </b> </td>
								<td class="tdtextsize"> : </td>
								<td class="tdtextsize"> 
								    <?php
								$dt =  $this->db->get_where('tblresorts' , array('resortid' => $resortid ))->row()->location;
								echo $dt;
								 ?>
								</td>
							</tr>
						</table>
						<table width="700px" align="center" border="1" class="main-table">
						<tr class="table-row4">
								
								<th class="tdtextsize">Packages</th>
								<th class="tdtextsize">Details</th>
								<th class="tdtextsize">Total</th>
							</tr>
							<?php
				    $query = $this->db->query("SELECT * from tblbookings WHERE ticketnumber='$tckno' ORDER BY bookingid DESC");
                    foreach ($query->result() as $k) {	
                    //echo "booking id is: ".$k->bookingid."<br>";		
				?>
			    	<tr>
			      		<td class="tdtextsize">
			      			<?php
								$packagename = $this->db->get_where('tblpackages' , array('packageid' =>$k->packageid))->row()->packagename; 
								echo $packagename;
						    ?>
						</td>
			      		<td class="tdtextsize">
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
						    Child: <span><?php echo $k->childqty;   ?></span>
                            

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
			      		<td class="tdtextsize"><?php 

								 		echo "Rs. ".$this->db->get_where('tblpayments' , array('ticketnumber' =>$tckno))->row()->totalcost;

								 		  ?></td>
			      	</tr>
			    <?php } ?>
						</table>
						
						<table align="center">
							<tr class="table-row5">
								<td class="tdtextsize"><b>
Book4holiday
A unit of Adepto Geoinformatics Pvt. Ltd.
8-2-686/K/21, S-1, III rd Floor
Ashok Asha Abode,Behind Fortune Hotel
Road no.12, Banjara Hills, Hyderabad – 500 034
								</b> </td>
							</tr>
							<tr class="table-row5">
								<td class="table-row6 tdtextsize">Ph: 040 -23393131 | info@adeptogeoit.com </td>
							</tr>
							<tr class="table-row5">
								<td class="table-row6 tdtextsize"> www.book4holiday.com </td>
							</tr>
						</table>
					</td>
				</tr>
		</table>	
	</div>
	
	<div>&nbsp;</div>
	
	<center>
		<div class="col-xs-12 col-md-12 col-lg-12">
			<button type="button" class="btn btn-success" onclick="printDiv('printableArea')">Print Ticket</button>
		</div>
	</center>

	<!-- Pradeep code end -->
    
        <?php 

}

}






         ?>


    





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
    JsBarcode("#bcTarget", $('#ticketnumber').val(), {
  
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
/*
$('#tkno').blur(function(){
	event.preventDefault();
    getTicket();
});*/

function gettktnumber()
{
    document.getElementById("myForm").submit();
}

function gettcktno()
{
    document.getElementById("myScan").submit();
}

</script>
			
<script type="text/javascript">

    

    function getTicket()
    {
    	var ticketno=$('#tkno').val();
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
	    alert(ticketno);
	   
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
<script type="text/javascript">
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>


