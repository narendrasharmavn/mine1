

<div id="position" style="margin-top:57px;">
                    <div class="container"><ul><li><a href="<?php echo site_url().'home';?>" title="Home">Home</a></li><li class="active">Booking Confirmation Tour</li></ul></div>
                </div>

<div class="container margin_60">
            <div class="">
                                <div class="post-content">
                                        <div class="row">
    <div class="col-md-8">

      

          <div class="form_title">
                <h3>
                    <strong><i class="icon-ok" aria-hidden="true"></i></strong>Your Orders
                </h3>
                <p>List Of Orders</p>
            </div>

        <div class="step">
            <?php
            $query = $this->db->query("SELECT * from tblbookings b LEFT JOIN tblpackages p ON b.packageid=p.packageid LEFT join tblcustomers c ON b.userid=c.customer_id WHERE b.userid='".$this->session->userdata('holidayCustomerId')."' and b.booking_status='booked' and b.payment_status='paid' ORDER BY b.date DESC");

            if(count($query->result())>0){

            

            ?>
           <table class="table table-striped confirm">
           <thead>
                <td><strong>Date</strong></td>
                <td><strong>Ticket Number</strong></td>
                <td><strong>Packagename</strong></td>
                <td><strong>Adults</strong></td>
                <td><strong>Child</strong></td>
                <td><strong>Amount Paid</strong></td>
                <td><strong>Print</strong></td>
           </thead>
            <tbody>
            <?php
            foreach ($query->result() as $k) {
                ?>
            <tr>
                
                <td><?php echo $k->date;   ?></td>
            
                
                <td><?php echo $k->ticketnumber;   ?></td>
           
                
                <td><?php echo $k->packagename;   ?></td>
            
                
                <td><span><?php echo $k->quantity;   ?></span></td>
                <td><span><?php echo $k->childqty;   ?></span></td>
                <td>Rs. <span><?php echo $k->amount;   ?></span></td>
           
                
                <td><a href="<?php echo site_url().'invoice/'.$k->bookingid ?>" target='_blank'>View Ticket</a></td>
            </tr>
            <?php 
        }
        ?>
           
            </tbody>
            </table>
            <?php


        }else{
            echo "<h3>No Orders Found</h3>";
        }


        ?>
        </div><!--End step -->

        
    </div><!--End col-md-8 -->

  <!--  <aside class="col-md-4">
    <div class="box_style_1">
        <h3 class="inner">Thank you!</h3>
                <p>Nihil inimicus ex nam, in ipsum dignissim duo. Tale principes interpretaris vim ei, has posidonium definitiones ut. Duis harum fuisset ut his, duo an dolor epicuri appareat.</p>
                <hr>
                    <a class="btn_full_outline" target="_blank" href="">View your invoice</a>
            </div>
    </aside>-->
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