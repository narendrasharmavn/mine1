
    <!--Checkout Starts-->
    
        <div class="container" style="margin-top:65px;min-height:450px;">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-8 col-xs-12">
                        <h3 style="color: #ffffff;background-color: #2474b7; padding:20px;">Share Your Contact Details</h3>
                        <form class="form-horizontal" action="<?php echo base_url().'merchant/';  ?>submit.php" method="post" id="payment-form" style="background-color:#eee; padding:25px;">

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
                                    echo '<input type="text" name="customername" class="form-control" id="customername" placeholder="Enter Your name" required>';
                                 }else{
                                    ?>
                                    <input type="text" name="customername" class="form-control" id="customername" placeholder="Enter Your name" value="<?php
                                    echo $this->session->userdata('holidayCustomerName');
                                       ?>" required>

                                    <?php
                                 }

                                ?>
                                
                              </div>
                              <div class="form-group">
                                <label for="exampleInputName2">Mobile</label> &nbsp; &nbsp;
                                <?php
                                 if (!$this->session->userdata('holidayCustomerName')) {
                                    echo '<input type="tel" name="udf3" class="form-control" id="mobile" placeholder="Enter Your mobile">';
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
                                    echo '<input type="email" name="udf2" class="form-control" id="email" onchange="emailvalidation()"  placeholder="abcd@example.com">';

                                 }else{
                                    ?>
                                    <input type="email" name="udf2" class="form-control" id="email" placeholder="abcd@example.com" onchange="emailvalidation()" value="<?php echo $this->session->userdata('holidayEmail');  ?>">

                                    <?php
                                 }

                                ?>
                                
                              </div> &nbsp; &nbsp;
                              <?php
                              if ($this->session->userdata('holidayEmail')) {
                                 echo '<button type="submit" class="btn btn-primary">Pay</button>';
                                 echo '<input type="hidden" name="sessioncheck" value="yes" >';
                                 echo '<button type="button" id="cancel" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancel</button>';
                              }else{
                                echo '<button type="submit" id="pay" class="btn btn-primary">Pay</button>
								                 <button type="button" id="cancel" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancel</button>';
                                    echo '<input type="hidden" name="sessioncheck" value="no" >';
                              }
                              ?>
  
                          <input type="hidden" name="currenturl" value="<?php echo $this->session->userdata('currenturl'); ?>">
              
                            </form>


                            <!--otp here -->

                            <form class="form-horizontal" method="post" id="otp-form" style="background-color:#eee; padding:25px;">
                              <?php
                                 if (!$this->session->userdata('holidayCustomerName')) {
                                  ?>

                              <div class="form-group otp-view">
                                <label for="exampleInputName2" class="control-label">Enter OTP here</label> 
                                
                                
                                    <input type="text" name="otp" class="form-control" id="customername" placeholder="Enter Your OTP" required>
                                    <span class="otp-error error"></span>
                                    <button type="button" class="btn btn-danger otp-check">Check My OTP</button>
                                    <button type="button" class="btn btn-danger re-enter-details">Edit Details</button>
                                
                                
                              </div>
                              <?php

                           }  
                            ?>
                            </form>
                            <!--otp here -->
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
     $kidsmealprice = $this->session->userdata('kidsmealprice');
     $ticketcost = $adultpriceperticket+$childpriceperticket+$kidsmealprice;
     $servicetax = $this->session->userdata('servicetax');
     $swachhbharath = $this->session->userdata('swachhbharath');
     $kkcess = $this->session->userdata('kkcess');
     $taxes = floatval($servicetax+$swachhbharath+$kkcess);
      ?>
      
    </td>
  </tr>
  <tr><td width="150">Ticket Cost </td><td width="15"> : </td><td>Rs.<?php echo  $ticketcost;  ?></td></tr>
	<tr><td width="150">Internet & Handling Charges</td><td width="15"> : </td><td>Rs. <?php echo $this->session->userdata('internetcharges');  ?></td></tr>
  <tr><td width="150">Taxes </td><td width="15"> : </td><td>Rs.<?php echo  $taxes;  ?></td></tr>
	<tr><td width="150">Date of Visit</td><td width="15"> : </td><td><?php echo $this->session->userdata('dateofvisit');  ?></td></tr>
	<tr style="font-weight: bold;font-size: 20px;"><strong><td width="150">Total</td><td width="15"> : </td><td>Rs. <?php echo $this->session->userdata('totalcost');  ?></td></strong></tr>
</table>
                    </div>
                </div>
            </div>
        </div>      
        <div>&nbsp;</div>
    <!--Checkout Ends-->

    <!-- set up the modal to start hidden and fade in and out -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Do you really want to cancel the booking?
      </div>
      <!-- dialog buttons -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">Close</button>
        <button type="button" class="btn btn-warning cancel-booking">OK</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Pop up ends here -->
    
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

  $('.otp-view').hide();

  jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 
    
    // Setup form validation on the #register-form element
    $("#payment-form").validate({
        // Specify the validation rules
        rules: {
          customername:{
          required:  true,
          lettersonly:true
          },
           udf2: {
                required:true,
                email: true
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
          required:  'Name cannot be blank',
          lettersonly:'Name should contain only letters'
          },
            udf2: {
              required:'Email Address cannot be blank',
              email:'Please enter valid email address'
            },
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
              var name = $('input[name="customername"]').val();
              var email = $('#email').val()
              //alert(session_check);
              if (session_check=="yes") {
                form.submit();
              }else{

                //ajax submit

                    $.ajax({
                    type: "POST",
                    url: '<?php echo site_url("frontend/nosessionhandlerOTPCheckResorts")?>',
                    data: {
                        name:name,
                        mobile:mobile,
                        email:email

                    },
                    success: function(res) {
                        console.log(res);
                        //hide show particular divs
                        $('.otp-view').show();
                        $('#payment-form').hide();
                        
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




$('.otp-check').on('click', function() {
    var pattern = /^\d+$/;
    var otp = $('input[name="otp"]').val();

    if(otp==''){
      $('.otp-error').text('OTP cannot be blank');
    }else if(!pattern.test($('input[name="otp"]').val())){
      $('.otp-error').text('OTP should contain only numbers');
    }else{
          //ajax code
          $('.otp-error').text('');
          $.post('<?php echo site_url("frontend/nosessionhandler")?>',
          {
              name:$('input[name="customername"]').val(),
              mobile:$('input[name="udf3"]').val(),
              email:$('input[name="udf2"]').val(),
              otp:$('input[name="otp"]').val()
          },
          function(data, status){
             
             if (data.trim()=="true") {
              document.getElementById("payment-form").submit();
             }else if(data.trim()=="false"){
              $('.otp-error').text('OTP is wrong');
             }else{
              console.log(data);
             }
          });


          //end ajax code

    }


});



$('.re-enter-details').on('click', function() {
    //hide otp and show form
    $('.otp-view').hide();
    $('#payment-form').show();
});



$('.close-modal').on('click', function() {
    
    $('#myModal').modal('hide')
});

$('.cancel-booking').on('click', function() {
    
    var currenturl = $('input[name="currenturl"]').val();

    var urlToRedirect =' <?php echo base_url(); ?>';

    currenturl = urlToRedirect+currenturl;

    window.location.href=currenturl;

});


function emailvalidation()
    {
        var useremail = $('#email').val();
        //alert(useremail);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url()."emailvalidation/"?>example.php',
            data: {
                useremail:useremail
            },
            success: function(res) {
                console.log('validation email : '+res);
                if($.trim(res)=='bool(true)')
                {
                    console.log('email is valid');
                    $('#errordiv').html('Email is valid');
                    //document.getElementById("emailvalidation").style.color = "green";
                }else{
                   console.log('email is not valid');
                   $('#errordiv').html('Email is not valid');
                   //document.getElementById("emailvalidation").style.color = "red";
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
            }          
        });
    }



</script>

        </body>

</html>