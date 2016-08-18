<div id="position">
                    <div class="container"><ul><li><a href="<?php echo base_url(); ?>" title="Home">Home</a></li><li class="active">Response</li></ul></div>
                </div>

<div class="container margin_60">
            <div class="">
                                <div class="post-content">
                                        <div class="row">
    <div class="col-md-8">

       <?php
       //echo $responsestatus." status<br>";
       if ($responsestatus=="Ok") {
           ?>
           <div class="form_title">
                <h3><strong><i class="icon-ok"></i></strong>Thank you!</h3>
                <p>Your Booking Order is Confirmed.</p>
            </div>

           <?php
       } else {
          ?>

          <div class="form_title">
                <h3>
                    <strong><i class="fa fa-times-circle" aria-hidden="true"></i></strong>OOPS ! Sorry Something went wrong
                </h3>
                <p>Your Transaction Failed</p>
            </div>

          <?php
       }
       
       ?>


        <div class="step">
            
           <table class="table confirm">
            <tbody>
            <tr>
                <td><strong>Bank Transaction</strong></td>
                <td><?php echo $banktransaction;   ?></td>
            </tr>
            <tr>
                <td><strong>Transaction Id</strong></td>
                <td><?php echo $transaction_id;   ?></td>
            </tr>
            <tr>
                <td><strong>Transaction Date</strong></td>
                <td><?php echo $transdate;   ?></td>
            </tr>
            <tr>
                <td><strong>Transaction Amount</strong></td>
                <td>Rs. <span><?php echo $amount;   ?></span></td>
            </tr>
            <tr>
                <td><strong>Billing Email</strong></td>
                <td><?php echo $billingemail;   ?></td>
            </tr>
           
            </tbody>
            </table>
        </div><!--End step -->

        <div class="form_title">
            <h3><strong><i class="icon-tag-1"></i></strong>Booking summary</h3>
            <p>Your booking details</p>
        </div>
        <div class="step">
            <table class="table table-bordered" style="font-size:14px;line-height: 1.5em;background-color: transparent;">
<tr>
    <td width="150">Package Name
    </td>
   
    <td class="tdrt">
    <?php

    $packageidarray = $this->session->userdata('packageIdArray');
    echo '<ol>';
    for($i=0;$i<count($packageidarray);$i++){
      $packageid =  $packageidarray[$i];
      echo '<li style="text-align:left;">'.$this->db->get_where('tblpackages' , array('packageid' =>$packageid))->row()->packagename.'</li>';
    }
 echo '</ol>';

     //echo $this->db->get_where('tblpackages' , array('packageid' =>$this->session->userdata('packageid')))->row()->packagename;
     $adultpriceperticket = $this->session->userdata('calculatedadultprice');
     $childpriceperticket = $this->session->userdata('calculatedchildprice');
     $kidsmealprice = $this->session->userdata('kidsmealprice');
     $ticketcost = $adultpriceperticket+$childpriceperticket+$kidsmealprice;
     $servicetax = $this->session->userdata('servicetax');
     $swachhbharath = $this->session->userdata('swachhbharath');
     $kkcess = $this->session->userdata('kkcess');
     $taxes = floatval($servicetax+$swachhbharath+$kkcess);
      ?>
      
    </td>
  </tr>
  <tr><td width="150">Adult Tickets </td><td class="tdrt">Rs.<?php echo  $adultpriceperticket;  ?></td></tr>
  <tr><td width="150">Child Tickets </td><td class="tdrt">Rs.<?php echo  $childpriceperticket;  ?></td></tr>
  <tr><td width="150">Kid Meal Ticket </td><td class="tdrt">Rs.<?php echo  $kidsmealprice;  ?></td></tr>
  <tr><td width="150">TotalTicket Cost </td><td class="tdrt">Rs.<?php echo  $ticketcost;  ?></td></tr>
  </table>
<table class="table table-bordered" style="font-size:12px;line-height: 1.5em;background-color: transparent;">
    <tr><td width="150">Internet & Handling Charges</td><td class="tdrt">Rs. <?php echo $this->session->userdata('internetcharges');  ?></td></tr>
  <tr><td width="150">Taxes </td><td class="tdrt">Rs.<?php echo  $taxes;  ?></td></tr>
    <tr><td width="150">Date of Visit</td><td class="tdrt"><?php
   echo date("d-m-Y", strtotime($this->session->userdata('dateofvisit')));  ?></td></tr>  
   <?php	
	   $tckno=$this->session->userdata('ticketnumber');   
	   $total = $this->db->get_where('tblpayments' , array('ticketnumber' => $tckno ))->row()->amount;   
   ?>   
    <tr style="font-weight: bold;font-size: 20px;"><strong><td width="150">Total</td><td class="tdrt">Rs. <?php echo $total;  ?></td></strong></tr>
</table>
        </div><!--End step -->
    </div><!--End col-md-8 -->

    <aside class="col-md-4">
     <?php
       //echo $responsestatus." status<br>";
       if ($responsestatus=="Ok") {

        ?>
        <div class="box_style_1">
            <h3 class="inner">Thank you!</h3>
                    <p>You can view all your transactions in 'Myorders' section of your account.</p>
                    <hr>
                        <a class="btn_full_outline" target="_blank" href="<?php echo base_url().'index.php/invoice/'.$this->session->userdata('ticketnumber'); ?>">View your invoice</a>
        </div>
        <?php
        }else{

            ?><!--
     <div class="box_style_1">
            <h3 class="inner">Transaction Failed :-(</h3>
                    <p>Something went wrong!</p>
                  
                        
        </div>-->

            <?php

            } ?>
    </aside>
</div><!--End row -->                                                       </div>
                            </div>
        </div>              
    

    <!-- content ends here --> 
    
 <?php
     include 'footer.php';
      ?>

<div id="toTop"></div><!-- Back to top button -->

<?php
     include 'scripts.php';
     
      ?>
     </body>

</html>