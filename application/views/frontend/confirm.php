
     
    <!--Checkout Starts-->
    
        <div class="container" style="margin-top:65px;">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-8 col-xs-12">
                        <h3 style="color:#fff; background-color:#3cf; padding:20px;">Share Your Contact Details</h3>
                        <form class="form-inline" action="<?php echo base_url().'merchant/';  ?>submit.php" method="post" style="background-color:#eee; padding:25px;">

                        <input type="hidden" name="amount" class=" form-control" placeholder="Password" value="<?php echo $this->session->userdata('totalcost') ?>" readonly>
                                    <INPUT TYPE="hidden" NAME="udf3" value="NSE">
                                    <INPUT TYPE="hidden" NAME="udf4" value="NSE">
                                    
                                    <INPUT TYPE="hidden" NAME="product" value="NSE">
                                    <INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

                                    <INPUT TYPE="hidden" NAME="clientcode" value="9654">
                                    <INPUT TYPE="hidden" NAME="AccountNo" value="85654125485412">

                                    <INPUT TYPE="hidden" NAME="ru" value="<?php echo site_url().'frontend/response'; ?>">
                                    <input type="hidden" name="bookingid" value="<?php echo  rand(10000,1000000); ?>"/>


                            
                              <div class="form-group">
                                <label for="exampleInputName2">Mobile</label> &nbsp; &nbsp;
                                <?php
                                 if (!$this->session->userdata('holidayCustomerName')) {
                                    echo '<input type="text" name="udf1" class="form-control" id="exampleInputName2" placeholder="Enter Your mobile">';
                                 }else{
                                    ?>
                                    <input type="text" name="udf1" class="form-control" id="exampleInputName2" placeholder="Enter Your mobile" value="<?php
                                    echo $this->db->get_where('tblcustomers' , array('customer_id' =>$this->session->userdata('holidayCustomerId')))->row()->number;
                                       ?>">

                                    <?php
                                 }

                                ?>
                                
                              </div> &nbsp; &nbsp;
                              <div class="form-group">
                                <label for="exampleInputEmail2">Email</label> &nbsp; &nbsp;
                                <?php
                                 if (!$this->session->userdata('holidayCustomerName')) {
                                    echo '<input type="email" name="udf2" class="form-control" id="exampleInputEmail2" placeholder="abcd@example.com">';
                                 }else{
                                    ?>
                                    <input type="email" name="udf2" class="form-control" id="exampleInputEmail2" placeholder="abcd@example.com" value="<?php echo $this->session->userdata('holidayEmail');  ?>">

                                    <?php
                                 }

                                ?>
                                
                              </div> &nbsp; &nbsp;
                              <button type="submit" class="btn btn-primary">CONTINUE</button>
                            </form>
                    </div>
                    <div class="col-md-4 col-xs-12" style="background-color:#eee; margin-top:20px;">
                        <h3 style="color:#3cf;">ORDER SUMMARY</h3>
                            <ul style="list-style:none;">
                                <li>
                                    <div>
                                        <h4><?php echo $resortResults->resortname;   ?></h4>
                                            <address><?php echo $resortResults->location;   ?></address>
                                            <span>Adults(Per Person Rs.<?php echo $this->session->userdata('adultpriceperticket');  ?>) : <?php echo $this->session->userdata('numberofadults');  ?> ticket</span><br>
                                            <span>Children Ticket(Per child Rs.<?php echo $this->session->userdata('childpriceperticket');  ?>) : <?php echo $this->session->userdata('numberofchildren');  ?> ticket</span><br>
                                            <span>Service Tax: Rs. <?php echo $this->session->userdata('servicetax');  ?></span><br>
                                            <span>Date of Visit : <?php echo $this->session->userdata('dateofvisit');  ?><br><span><b><?php echo $this->session->userdata('numberofadults')+$this->session->userdata('numberofchildren');  ?> &nbsp; Ticket</b></span>
                                            </span>
                                    </div>
                                </li>
                                <li>
                                    <div>Sub Total : <span style="float:right;"><b>Rs. <?php echo $this->session->userdata('totalcost');  ?></b></span></div>




                                </li>
                                
                            </ul>
                    </div>
                </div>
            </div>
        </div>      
        <div>&nbsp;</div>
    <!--Checkout Ends-->
    
   <?php
    include 'footer.php';
      ?>

<div id="toTop"></div><!-- Back to top button -->

<?php

     include 'scripts.php';
      ?>


<script type="text/javascript">

$('document').ready(function(){
    //alert("hello");
    $('#datepickerj').datepick({dateFormat: 'yyyy-mm-dd'});
    //$('#inlineDatepicker').datepick({onSelect: showDate});
    //$('#datetimepicker4').datetimepicker();

    var searchType = $('#searchtype').val();
    if (searchType=="eventname") {
        //$('.datefield').show();
        $('#datepickerj').prop('disabled', false);
        //$(this).text(enable ? 'Disable' : 'Enable'). 
        //siblings('.is-datepick').datepick(enable ? 'enable' : 'disable'); 
        //$(".datefield").attr("enabled", "enabled"); 
        
    } else {
        $('.datefield').show();
         //$(".datefield").attr("disabled", "disabled");
         $('#datepickerj').prop('disabled', true);
    }
});


$('#searchtype').on('change',function(){
    //alert(this.value);
    if(this.value=='eventname'){
       // $('.datefield').show();
       //  $(".datefield").attr("enabled", "enabled");
       $('#datepickerj').prop('disabled', false);
    }else{
       // $('.datefield').show();
        // $(".datefield").attr("disabled", "disabled");
        $('#datepickerj').prop('disabled', true);
    }

});



</script>

        </body>

</html>