     
    <!--Checkout Starts-->
    
        <div class="container" style="margin-top:65px;min-height:450px;">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-8 col-xs-12">
                        <h3 style="color: #ffffff;background-color: #2474b7; padding:20px;">Share Your Contact Details</h3>
                        <form class="form-inline" action="<?php echo base_url().'merchant/';  ?>submit.php" method="post" id="theForm" style="background-color:#eee; padding:25px;">

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
                                    echo '<input type="tel" name="udf1" class="form-control" id="mobile" placeholder="Enter Your mobile">';
                                 }else{
                                    ?>
                                    <input type="tel" name="udf3" class="form-control" id="mobile" placeholder="Enter Your mobile" value="<?php
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
                                    echo '<input type="email" name="udf2" class="form-control" id="email" placeholder="abcd@example.com">';
                                 }else{
                                    ?>
                                    <input type="email" name="udf2" class="form-control" id="email" placeholder="abcd@example.com" value="<?php echo $this->session->userdata('holidayEmail');  ?>">

                                    <?php
                                 }

                                ?>
                                
                              </div> &nbsp; &nbsp;
                              <?php
                              if ($this->session->userdata('holidayEmail')) {
                                 echo '<button type="submit" class="btn btn-primary">Pay</button>';
                              }else{
                                echo '<button type="button" id="pay" class="btn btn-primary">Pay</button>
								<button type="button" id="pay" class="btn btn-danger">Cancel</button>';
                              }
                              ?>
                              
                            </form>
                    </div>
                    <div class="col-md-4 col-xs-12" style="margin-top:20px;">
                        <h3 style="color:#3b0032;">ORDER SUMMARY</h3>
                            			
<table style="font-size:14px;line-height: 1.5em;background-color: transparent;">
	<tr><td width="150">Adults (<?php echo $this->session->userdata('numberofadults');  ?>)</td><td width="15"> : </td><td>Rs.<?php echo $this->session->userdata('adultpriceperticket')*$this->session->userdata('numberofadults');  ?></td></tr>
	<tr><td width="150">Children (<?php echo $this->session->userdata('numberofchildren');  ?>)</td><td width="15"> : </td><td>Rs.<?php echo $this->session->userdata('numberofchildren')*$this->session->userdata('childpriceperticket');  ?></td></tr>
	<tr><td width="150">Kid Meal (<?php echo $this->session->userdata('kidsmealqty');  ?>)</td><td width="15"> : </td><td>Rs.<?php echo $this->session->userdata('kidsmealqty')*$this->session->userdata('kidsmealprice');  ?></td></tr>
	<tr><td width="150">Internet Handling Charges</td><td width="15"> : </td><td>Rs. <?php echo $this->session->userdata('internetcharges');  ?></td></tr>
  <tr><td width="150">Service Tax</td><td width="15"> : </td><td>Rs. <?php echo $this->session->userdata('servicetax');  ?></td></tr>
	<tr><td width="150">Date of Visit</td><td width="15"> : </td><td><?php echo $this->session->userdata('dateofvisit');  ?></td></tr>
	<tr style="font-weight: bold;font-size: 20px;"><strong><td width="150">Total</td><td width="15"> : </td><td>Rs. <?php echo $this->session->userdata('totalcost');  ?></td></strong></tr>
</table>
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

 <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
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


$('#pay').on('click',function(){
    //alert("pay clicked");
    var mobile = $('#mobile').val();
    var email = $('#email').val()
    if($('#mobile').val()=='' || $('#email').val()==''){
        alert("fields are empty");
    }else if(mobile.length<10 || mobile.length>10){
        alert("Mobile number should be 10 digits");
    }else{
        
        //ajax submit

        $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/nosessionhandler")?>',
        data: {
            mobile:mobile,
            email:email

        },
        success: function(res) {
            if (res.trim()=="true") {
                document.getElementById('theForm').submit();
            }else{
                alert(res.trim());
            }
            
        },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                 
                }
        });

        //end of ajax submit


    }


});



</script>

        </body>

</html>