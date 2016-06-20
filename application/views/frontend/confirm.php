<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        
                        

                        <?php      

                        //get customer mobile
                        $query = $this->db->query("SELECT * from tblcustomers WHERE username='".$this->session->userdata('holidayEmail')."'");
      
                                        $row = $query->row();
                                        $mobile =  $row->number;
                            
                             echo $this->session->flashdata('error-msg'); 

                               
                            ?>
                            <form action="<?php echo base_url().'merchant/';  ?>submit.php" method="post">
                            
                                <div class="form-group">
                                   Confirmation of Booking
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="udf2" class="form-control" placeholder="Confirm Password" value="<?php echo $this->session->userdata('holidayEmail') ?>" readonly>
                                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>

                                </div>

                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" name="udf3" class="form-control" placeholder="Confirm Password" value="<?php echo $mobile; ?>" readonly>
                                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>

                                </div>

                                <div class="form-group">
                                    <label>Resort Name</label>
                                    <input type="text" name="udf4" class=" form-control" placeholder="Name" value="<?php echo $resortResults->resortname; ?>" readonly>
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Package Name</label>
                                    <input type="email" name="udf1" class="form-control" placeholder="Email" value="<?php echo $resortResults->packagename; ?>" readonly>
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Number Of Tickets</label>

                                    <?php
                                        //echo $this->session->userdata('numberofadults')+;
                                    ?>
                                    <input type="number" name="mobile" class=" form-control" placeholder="Mobile" value="<?php echo ($this->session->userdata('numberofadults'))+($this->session->userdata('numberofchildren')); ?>" readonly>
                                    <span class="text-danger"><?php echo form_error('mobile'); ?></span>
                                </div>
                                
                                

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="amount" class=" form-control" placeholder="Password" value="<?php echo $this->session->userdata('totalcost') ?>" readonly>

                                    <INPUT TYPE="hidden" NAME="product" value="NSE">
                                    <INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

                                    <INPUT TYPE="hidden" NAME="clientcode" value="9654">
                                    <INPUT TYPE="hidden" NAME="AccountNo" value="85654125485412">

                                    <INPUT TYPE="hidden" NAME="ru" value="<?php echo site_url().'/frontend/response'; ?>">
                                    <input type="hidden" name="bookingid" value="525456"/>

                                    <span class="text-danger"><?php echo form_error('newpassword'); ?></span>
                                </div>

                               
                                
                                <button type="submit" class="btn_full">Pay</button>
                               
                            </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <div id="toTop"></div><!-- Back to top button -->

       <?php
     include 'scripts.php';
      ?>

      </body>

</html>