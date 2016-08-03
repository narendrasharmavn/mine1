 <section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url() ?>assets/frontend/img/slide_hero_2.jpg" data-natural-width="1400" data-natural-height="500">
                    <div class="parallax-content-1">
                        <div class="animated fadeInDown">
                        <h1 class="page-title">Booking Confirmation Tour</h1>
                                                </div>
                    </div>
                </section>

<div id="position">
                    <div class="container"><ul><li><a href="<?php echo base_url(); ?>" title="Home">Home</a></li><li class="active">Response</li></ul></div>
                </div>

<div class="container margin_60">
            <div class="">
                                <div class="post-content">
                                        <div class="row">
    <div class="col-md-8">

       <?php
       echo $responsestatus." status<br>";
       if ($responsestatus=="Ok") {
           ?>
           <div class="form_title">
                <h3><strong><i class="icon-ok"></i></strong>Thank you!</h3>
                <p>Your Booking Order is Confirmed Now.</p>
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
            <table class="table confirm">
            <tbody>
            <tr>
                <td><strong>Name</strong></td>
                <td><?php echo $this->session->userdata('holidayCustomerName');   ?></td>
            </tr>
            <tr>
                <td><strong>Email Id</strong></td>
                <td><?php echo $this->session->userdata('holidayEmail');   ?></td>
            </tr>
                        <tr>
                <td><strong>Package Name</strong></td>
                <td><?php echo$this->db->get_where('tblpackages' , array('packageid' =>$this->session->userdata('packageid')))->row()->packagename;
                    ?></td>
            </tr>
            <tr>
                <td><strong>Adults</strong></td>
                <td><?php echo $this->session->userdata('numberofadults');     ?></td>
            </tr>
            <tr>
                <td><strong>Childs</strong></td>
                <td><?php echo $this->session->userdata('numberofchildren');     ?></td>
            </tr>
                        <tr>
                <td><strong>TOTAL COST</strong></td>
                <td>Rs. <span><?php echo $this->session->userdata('totalcost');     ?></span></td>
            </tr>
            </tbody>
            </table>
        </div><!--End step -->
    </div><!--End col-md-8 -->

    <aside class="col-md-4">
    <div class="box_style_1">
        <h3 class="inner">Thank you!</h3>
                <p>You can view all your transactions in 'Myorders' section of your account.</p>
                <hr>
                    <a class="btn_full_outline" target="_blank" href="">View your invoice</a>
            </div>
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