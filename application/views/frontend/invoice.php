

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
						<strong>Ticket Date:</strong><br>
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
									<td class="text-center"><strong>Description</strong></td>
									<td class="text-right"><strong>Amount Paid</strong></td>
								</tr>
							</thead>
							<tbody>
							<?php
							
							foreach ($bookingsResults->result() as $k) {
								?>
									
							<tr>
								<td class="">
								<?php 
								echo $k->packagename;
								  ?>
								  	
								  </td>
								<td class="text-center">
								Adults: <span><?php echo $k->quantity;   ?></span>

								Child: <span><?php echo $k->childqty;   ?></span>
								<input type="hidden" id="dateofvisit" value="<?php echo $k->dateofvisit;   ?>">

								</td>
								<td class="text-right">Rs. <?php echo $k->amount;   ?></td>
							</tr>
								

								<?php
							}
							 ?>

						
									
								
															</tbody>
						</table>
						<button class="btn btn-primary" onclick="printfunction()" id="printbtn">Print</button>
					</div>
				</div>
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
