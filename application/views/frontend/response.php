<div id="position">
                    <div class="container"><ul><li><a href="<?php echo base_url(); ?>" title="Home">Home</a></li><li class="active">Response</li></ul></div>
                </div>

                <?php
              $ticketnumber= $this->session->userdata('ticketnumber');
                ?>

<div class="container margin_60">
            <div class="">
                                <div class="post-content">
                                        <div class="row">
    <div class="col-md-5">

       <?php
       
       if ($responsestatus=="Ok") {
           ?>
           <div class="form_title">
                <h3><strong><i class="icon-ok"></i></strong>Thank you!</h3> <br>
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
		
		<?php
       //echo $responsestatus." status<br>";
       if ($responsestatus=="Ok") {

        ?>
        <div class="thxorder">
           
           <?php if($this->session->userdata('holidayCustomerName')){
            ?>
            <p style="font-size:18px; font-family: calibri; font-weight:bold; text-align:center;">You can view all your transactions in 'MY ORDERS' section of your account.</p>

            <?php } ?>

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
        
    </div><!--End col-md-8 -->

    <aside class="col-md-4">
    
		<div class="form_title">
            <h3><strong><i class="icon-tag-1"></i></strong>Booking summary</h3> <br>
            <p>Your booking details</p>
        </div>
        <div class="step">
            <table class="table table-bordered" style="font-size:12px;line-height: 1.5em;background-color: transparent; width:400px;">
            <tr>
              <td colspan="2" style="font-size:14px;text-align:center;font-weight:bold;">

              <?php 
               $packageid = $this->db->get_where('tblbookings' , array('ticketnumber' =>$ticketnumber))->row()->packageid;

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

               echo $name;

              ?>
                  
              </td>
            </tr>
<tr>
    <td width="150" align="center" style="font-size:14px;text-align:center;font-weight:bold;">Package Name
    </td>
   
    <center>
	<td class="tdrt" align="right" style="font-size:14px; text-align:center !important; font-weight:bold;">
    <?php

     echo $this->db->get_where('tblpackages' , array('packageid' =>$this->session->userdata('packageid')))->row()->packagename;

     
     $adultpriceperticket = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->adultpriceperticket;
     $childpriceperticket = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->childpriceperticket;
     $kidsmealprice = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->kidsmealprice;
     $ticketcost = $adultpriceperticket+$childpriceperticket+$kidsmealprice;
     $servicetax = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->servicetax;
     $swachhbharath = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->swachhbharath;
     $kkcess = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->krishkalyancess;
     $taxes = $servicetax+$swachhbharath+$kkcess;
     //echo "servicetax".$servicetax."<br>";
     //echo "swachhbharath".$swachhbharath."<br>";
     //echo "kkcess".$kkcess."<br>";
      ?>
      
    </td>
	</center>
	
  </tr>

  <tr><td width="150">Adult Tickets </td><td class="tdrt">Rs.<?php echo  $adultpriceperticket;  ?></td></tr>
  <?php
  if ($childpriceperticket!=0) {
    ?>

    <tr><td width="150">Child Tickets </td><td class="tdrt">Rs.<?php echo  $childpriceperticket;  ?></td></tr>


    <?php
    
  }

  if ($kidsmealprice!=0) {
    ?>
    <tr><td width="150">Kids Meal Price </td><td class="tdrt">Rs.<?php echo  $kidsmealprice;  ?></td></tr>
    <?php
    
  }
    ?>
  
  
  <tr><td width="150">Total Ticket Cost </td><td class="tdrt">Rs.<?php echo  $ticketcost;  ?></td></tr>
</table>
<table class="table table-bordered" style="font-size:12px;line-height: 1.5em;background-color: transparent; width:400px;">
    <tr><td width="150">Internet & Handling Charges</td><td class="tdrt">Rs. <?php echo $this->session->userdata('internetcharges');  ?></td></tr>
  <tr><td width="150">Taxes </td><td class="tdrt">Rs.<?php echo  $taxes;  ?></td></tr>
    <tr><td width="150">Date of Visit</td><td class="tdrt"><?php
   echo date("d-m-Y", strtotime($this->session->userdata('dateofvisit')));  ?></td></tr>   
   <?php	
	   $tckno=$this->session->userdata('ticketnumber');   
	   $total = $this->db->get_where('tblpayments' , array('ticketnumber' =>$ticketnumber))->row()->totalcost;
   ?>   
    <tr style="font-weight: bold;font-size: 20px;"><strong><td width="150">Total</td><td class="tdrt">Rs. <?php echo $total;  ?></td></strong></tr>
</table>
        </div><!--End step -->	
	
	
	
	
	
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
     //clear session values

     /*
    
     $this->session->unset_userdata('packageid');
      $this->session->unset_userdata('totalcost');
      $this->session->unset_userdata('adultpriceperticket');
      $this->session->unset_userdata('childpriceperticket');
      $this->session->unset_userdata('kidsmealprice');
      $this->session->unset_userdata('numberofadults');
      $this->session->unset_userdata('numberofchildren');
      $this->session->unset_userdata('kidsmealqty');
      $this->session->unset_userdata('servicetax');
      $this->session->unset_userdata('internetcharges');
      $this->session->unset_userdata('swachhbharath');
      $this->session->unset_userdata('kkcess');
      $this->session->unset_userdata('vendorid');
      $this->session->unset_userdata('dateofvisit');
      $this->session->unset_userdata('currenturl');

      */
    
      ?>
     </body>

</html>