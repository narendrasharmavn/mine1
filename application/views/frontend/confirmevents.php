
    <!--Checkout Starts-->
    
        <div class="container" style="margin-top:65px;min-height:450px;">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-8 col-xs-12">
                        <h3 style="color: #ffffff;background-color: #2474b7; padding:20px;">Share Your Contact Details</h3>
                        
                        <form class="form-inline" action="<?php echo base_url().'merchant/';  ?>submit.php" method="post" id="payment-form" style="background-color:#eee; padding:25px;">

                        <input type="hidden" name="amount" class=" form-control" placeholder="Password" value="<?php echo $this->session->userdata('totalcost') ?>" readonly>
                                    <INPUT TYPE="hidden" NAME="udf1" value="NSE">
                                    <INPUT TYPE="hidden" NAME="udf4" value="NSE">
                                    
                                    <INPUT TYPE="hidden" NAME="product" value="NSE">
                                    <INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

                                    <INPUT TYPE="hidden" NAME="clientcode" value="9654">
                                    <INPUT TYPE="hidden" NAME="AccountNo" value="85654125485412">

                                    <INPUT TYPE="hidden" NAME="ru" value="<?php echo site_url().'frontend/response'; ?>">
                                    <input type="hidden" name="bookingid" value="<?php echo  rand(10000,1000000); ?>"/>


                            <div id="errordiv"></div>
                            <div class="form-group">
                                <label for="exampleInputName2" class="control-label">Name</label> 
                                
                                <?php
                                 if (!$this->session->userdata('holidayCustomerName')) {
                                    echo '<input type="tel" name="customername" class="form-control" id="customername" placeholder="Enter Your name" required>';
                                 }else{
                                    ?>
                                    <input type="tel" name="customername" class="form-control" id="customername" placeholder="Enter Your name" value="<?php
                                    echo $this->session->userdata('holidayCustomerName');
                                       ?>" required>

                                    <?php
                                 }

                                ?>
                                
                              </div>
                              <div class="form-group">
                                <label for="exampleInputName2" class="control-label">Mobile</label> 
                                
                                <?php
                                 if (!$this->session->userdata('holidayCustomerName')) {
                                    echo '<input type="tel" name="udf3" class="form-control" id="mobile" placeholder="Enter Your mobile" required>';
                                 }else{
                                    ?>
                                    <input type="tel" name="udf3" class="form-control" id="mobile" placeholder="Enter Your mobile" value="<?php
                                    echo $this->db->get_where('tblcustomers' , array('customer_id' =>$this->session->userdata('holidayCustomerId')))->row()->number;
                                       ?>" required>

                                    <?php
                                 }

                                ?>
                                
                              </div> &nbsp; &nbsp;
                              <div class="form-group">
                                <label for="exampleInputEmail2">Email</label> &nbsp; &nbsp;
                                <?php
                                 if (!$this->session->userdata('holidayCustomerName')) {
                                    echo '<input type="email" name="udf2" class="form-control" id="email" placeholder="abcd@example.com" required>';
                                 }else{
                                    ?>
                                    <input type="email" name="udf2" class="form-control" id="email" placeholder="abcd@example.com" value="<?php echo $this->session->userdata('holidayEmail');  ?>" required>

                                    <?php
                                 }

                                ?>
                                
                              </div> &nbsp; &nbsp;
                              <?php
                              if ($this->session->userdata('holidayEmail')) {
                                 echo '<button type="submit" class="btn btn-primary">Pay</button>';
                                 echo '<input type="hidden" name="sessioncheck" value="yes" >';
                                 echo '<button type="button" id="cancel" class="btn btn-danger">Cancel</button>';
                              }else{
                                echo '<button type="submit" id="pay" class="btn btn-primary">Pay</button>
								<button type="button" id="cancel" class="btn btn-danger">Cancel</button>';
                echo '<input type="hidden" name="sessioncheck" value="no" >';
                              }
                              ?>
                              
                            </form>
                            <form class="otp-form">

                                <div class="form-group">
                                <label for="exampleInputName2" class="control-label">Mobile</label> 
                               
                                    <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter OTP here" required>
                                
                                  <button type="submit" id="otp" class="btn btn-primary">Check OTP</button>

                                
                              </div>

                            </form>
                    </div>
                    <div class="col-md-4 col-xs-12" style="margin-top:20px;">
                        <h3 style="color:#3b0032;">ORDER SUMMARY</h3>
                            			
<table style="font-size:14px;line-height: 1.5em;background-color: transparent;">
  <tr>
    <td width="150">Package Name
    </td>
    <td width="15"> : 
    </td>
    <td>
    <?php

     echo $this->db->get_where('tblpackages' , array('packageid' =>$this->session->userdata('packageid')))->row()->packagename;
     
     $adultpriceperticket = $this->session->userdata('adultpriceperticket');
     $childpriceperticket = $this->session->userdata('childpriceperticket');
     $ticketcost = $adultpriceperticket+$childpriceperticket;
     $servicetax = $this->session->userdata('servicetax');
     $swachhbharath = $this->session->userdata('swachhbharath');
     $kkcess = $this->session->userdata('kkcess');
     $taxes = floatval($servicetax+$swachhbharath+$kkcess);
      ?>
      
    </td>
  </tr>
	<tr>
    <td width="150">Ticket Cost
    </td>
    <td width="15"> : 
    </td>
    <td>
    Rs.<?php echo $ticketcost;  ?>
      
    </td>
  </tr>
	
  <tr>
    <td width="150">
      Internet Handling Charges
    </td>
    <td width="15">
       :
    </td>
    <td>
      Rs. <?php echo $this->session->userdata('internetcharges');  ?>
    </td>
    
  </tr>
	
  <tr>
    <td width="150">
      Taxes
    </td>
    <td width="15">
       :
    </td>
    <td>
      Rs. <?php echo $taxes; ?>
    </td>

  </tr>

  
	<tr>
    <td width="150">
      Date of Visit
    </td>
    <td width="15">
       :
    </td>
    <td>
      <?php echo $this->session->userdata('dateofvisit');  ?>
    </td>
  </tr>
	<tr style="font-weight: bold;font-size: 20px;">
    <strong><td width="150">
      Total
    </td>
    <td width="15">
       :
    </td>
    <td>
      Rs. <?php echo $this->session->userdata('totalcost');  ?>
    </td></strong>
  </tr>
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


  
<script type="text/javascript">

$('document').ready(function(){
  $('.otp-form').hide();
    //alert("hello");
    // Setup form validation on the #register-form element
    $("#payment-form").validate({
      //by default the error elements is a <label>
     
      errorElement: "div",
      errorPlacement: function(error, element) {
     error.appendTo('div#errordiv');
     //console.log("error is : "+JSON.stringify(error));
     //alert(JSON.stringify(error));
     //console.log("element  is : "+JSON.stringify(element));
     //$('div#errordiv').html(error[0].innerHTML);
   },

    
        // Specify the validation rules
        rules: {
          customername:{
            required:true
          },
           udf2: {
                required: true
            },
            udf3: {
                required: true,
                number:true,
                minlength: 10,
                maxlength:10
            }
        },
        
        // Specify the validation error messages
        messages: {
          customername:{
            required:'Name cannot be blank'
          },
            udf2: "Please enter a valid email address",
            udf3: {
              required: 'Mobile number cannot be blank',
              number:'Please input only numbers',
              minlength:'Please enter valid Phone number',
              maxlength:'Please enter 10 digit mobile number'
            }
        },
        
        
        submitHandler: function(form) {
              var session_check = $('input[name="sessioncheck"]').val();
              var mobile = $('#mobile').val();
              var email = $('#email').val()
              //alert(session_check);
              if (session_check=="yes") {
                form.submit();
              }else{

                //ajax submit

                    $.ajax({
                    type: "POST",
                    url: '<?php echo site_url("frontend/nosessionhandlerevents")?>',
                    data: {
                        mobile:mobile,
                        email:email
                      },
                    success: function(res) {
                        if (res.trim()=="true") {
                            form.submit();
                        }else{
                           $('div#errordiv').html(res.trim());
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
               // 
          }
        
    });
    
});




/*

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
        url: '<?php echo site_url("frontend/nosessionhandlerevents")?>',
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
*/

 


</script>

        </body>

</html>