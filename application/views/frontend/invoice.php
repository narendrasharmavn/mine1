

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    <title>Book4Holiday</title>

    <script src="https://use.fontawesome.com/3ad883fb7d.js"></script>


  <!--  <script src="<?php echo base_url(); ?>/assets/frontend/fontawesome/fonts.js"></script>-->

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/frontend/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="<?php echo base_url(); ?>/assets/frontend/css/base.css" rel="stylesheet" type="text/css" media="all" >

    <!-- Google web fonts -->
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <!-- REVOLUTION SLIDER CSS -->
    <link href="<?php echo base_url(); ?>/assets/frontend/rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/extralayers.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/slider-pro.min.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/date_time_picker.css" rel="stylesheet" type="text/css" media="all" >
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>/assets/frontend/js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>/assets/frontend/js/theia-sticky-sidebar.js'></script>



    
      <script src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyA-hMJfrFKuq7zQy30m0GBdzKSMl9qcxIo"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/frontend/style.css">
    

</head>
<style type="text/css">
 
  @media print
  {    
      #printbtn
      {
          display: none !important;
      }
  }
</style>

<div class="container">
 

	<div class="row">
		<div class="col-xs-12">
			<div class="invoice-title">
				<h2>Invoice</h2><?php 
				
  ?><h3 class="pull-right">Ticket Number # <span id="ticketnumber"><?php echo $this->uri->segment(2, 0); ?></span></h3>
			</div>
			<svg id="bcTarget"></svg>
			<hr>
			<div class="row">
				<div class="col-xs-6">
					<address>
					<strong>Customer Name :</strong><br>
	
						<?php 
						$tckno = $this->uri->segment(2, 0);
						//echo $tckno;
						$userid = $this->db->get_where('tblbookings' , array('ticketnumber' => $tckno ))->row()->userid;   
						//echo $userid;
						$customername = $this->db->get_where('tblcustomers' , array('customer_id' => $userid ))->row()->name;   
						echo $customername; ?><br>
						
					</address>
				</div>
				<div class="col-xs-6 text-right">
					<address>
					<?php 
               $packageid = $this->db->get_where('tblbookings' , array('ticketnumber' =>$tckno))->row()->packageid;

               $eventid = $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->eventid;

               $eventname = $this->db->get_where('tblevents' , array('eventid' =>$eventid))->row()->eventname;

               $resortid = $this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->resortid;

               $resortname = $this->db->get_where('tblresorts' , array('resortid' =>$resortid))->row()->resortname;
               $name="";
               if ($eventname!='') {
                 $name = $eventname;
               }else{
                $name = $resortname;
               }

               echo "<b>".$name."</b>";

              ?>
					
					<br>
						<strong>Ticket Date</strong><br>
						<?php 
							$dov = $this->db->get_where('tblbookings' , array('ticketnumber' => $tckno ))->row()->dateofvisit;   
						?>
						<span><?php echo date("d-m-Y", strtotime($dov)) ;?></span>
						<br><br>
					</address>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><strong>Order summary</strong></h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<td><strong>Package Name</strong></td>
									<td class="text-center"><strong>Visitors</strong></td>
									<td class="text-right"><strong></strong></td>
								</tr>
							</thead>
							<tbody>
							<?php
							$query = $this->db->query("SELECT * from tblbookings WHERE ticketnumber='$tckno' ORDER BY bookingid DESC");

foreach ($query->result() as $k) {
												//echo "booking id is: ".$k->bookingid."<br>";

							
							
								?>
									
							<tr>
								<td class="">
								<?php
								$packagename = $this->db->get_where('tblpackages' , array('packageid' =>$k->packageid))->row()->packagename; 
								echo $packagename;
								  ?>
								  	
								  </td>
								<td class="text-center">
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


								   ?>
								

								
								<input type="hidden" id="dateofvisit" value="<?php echo $k->dateofvisit;   ?>">

								</td>
								
							</tr>
								

								<?php
							}
							 ?>

							 <?php 
								$kidsmealqty =  $this->db->get_where('tblpayments' , array('ticketnumber' =>$tckno))->row()->noofkidsmeal;
								if ($kidsmealqty!=0) {
									?>
									 <tr>
							 	<td>Kids Meal Qty</td>
							 	<td class="text-center">
									<?php  echo $kidsmealqty;  ?>
							 	</td>


							 </tr>


									<?php
									
								}

								 ?>
								 <tr>
								 	<td>
	
								 			Amount Paid
								 	</td>
								 	<td class="text-center">
								 		<?php 

								 		echo "Rs. ".$this->db->get_where('tblpayments' , array('ticketnumber' =>$tckno))->row()->totalcost;

								 		  ?>
								 	</td>
								 </tr>


							

						
									
								
															</tbody>
						</table>
						<button class="btn btn-primary" onclick="printfunction()" id="printbtn">Print</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<h2>Terms and Conditions of eTicket Purchase</h2>
			<hr>
			<div class="row">

<ol style="line-height: 1.5em; font-size: 14px;">
<li style="text-align: justify;">Your purchase entitles you to a visit to the Nehru Zoological Park once, within the validity period of the purchased ticket.</li>
<li style="text-align: justify;">Ticket Validity:
<ol>
<li>The ticket will be valid for visit to the Nehru Zoological Park for the purchased date.</li>
<li>The dates of visit cannot be changed and request your visit to be made within the validity period.</li>
<li>No requests for refunds or cancellations are possible</li>
</ol>
</li>
<li style="text-align: justify;">The availability of certain services such as (a) battery operated vehicles, (b) parking will be scheduled once you have entered the premises. There is no reservation policy on such resources and will be assigned on a first come first served basis.</li>
<li style="text-align: justify;">The person who purchased the tickets (Name as it appears on purchase record) may be requested to furnish proof of identity. Proofs of identity include a government issued ID bearing a photograph of the person, such as a Driver&rsquo;s License, Aadhar Card, PAN Card or Voter&rsquo;s Registration Card. Not being able to produce such an identification document on demand may be sufficient cause to disallow entry to the entire party.</li>
<li style="text-align: justify;">We as a merchant shall be under no liability whatsoever in respect of any loss or damage arising directly or indirectly out of the decline of authorization for any Transaction, on Account of the Cardholder having exceeded the preset limit &nbsp;mutually agreed by us with our acquiring bank &nbsp;from time to time.</li>
<li style="text-align: justify;">Please call customer care: &lt;&lt;Phone Number&gt;&gt; if you encounter any issues with the purchase.</li>
<li style="text-align: justify;">A person will be categorized as Child only if he is between 5 and 12 years of age. If a person is above 12 years of age he will be deemed adult.</li>
</ol>
			</div>
		</div>
	</div>

	</div>


    

<div id="toTop"></div><!-- Back to top button -->

<?php
     include 'scripts.php';
      ?>


<script type="text/javascript">

$('document').ready(function(){
    $('#ticketdate-display').text($('#dateofvisit').val());
    JsBarcode("#bcTarget", $('#ticketnumber').text(), {
  
  lineColor: "black",
  width:1,
  height:40,
  
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



</script>

        </body>

</html>
