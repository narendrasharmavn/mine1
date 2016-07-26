<style>
    .alert{
        background-color: #2875b8;
        color:black;
    }



</style>

<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        <div class="text-center">

                        </div>
                       

                        <?php      
                            
                             echo $this->session->flashdata('reg-error-msg'); 

                                echo form_open('register-error',array('name'=>'registerform','method'=>'post','id' => 'register-form'));
                            ?>
                            <div id="errordiv"></div>
                                <div class="form-group">
                                    Register For This Site
                                </div>
                                <div class="form-group">
                                    <label>Name<span style="color:red;">*</span></label>
                                    <input type="text" name="name" class=" form-control" placeholder="Name" value="<?php echo set_value('name'); ?>" required>
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email<span style="color:red;">*</span></label>
                                    <input type="email" name="email" class=" form-control" placeholder="Email" value="<?php echo set_value('email'); ?>" required>
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Mobile<span style="color:red;">*</span></label>
                                    <input type="tel" name="mobile" class=" form-control" placeholder="Mobile" value="<?php echo set_value('mobile'); ?>" required>
                                    <span class="text-danger"><?php echo form_error('mobile'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Password<span style="color:red;">*</span></label>
                                    <input type="password" name="password" class=" form-control" placeholder="Password" required >
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password<span style="color:red;">*</span></label>
                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
                                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                                </div>
                                
                            
      
                                <button type="submit" class="btn_1 green btn_full">Create an account</button>
                                

                                
                            </form>
                            <form id="otp-form">

                            <div class="otp-view">
                                    <div class="form-group">
                                        <label>OTP<span style="color:red;">*</span></label>
                                        <input type="text" name="otp" class="form-control" placeholder="Enter your OTP here" required>
                                        <span class="text-danger otp-error"><?php echo form_error('otp'); ?></span>
                                    </div>

                                    <button type="button" class="btn_1 green btn_full check_otp">Check OTP</button>
                                    
                            </div>
        
                            </form>
                            <button type="button" class="btn_1 green re-enter-details otp-view">Re-enter details again</button>

                            <br>Already a member? <a href="<?php echo site_url().'login'; ?>">Login</a>
                        
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


      <script>
  $("document").ready(function(){

    $(".otp-view").hide();

    jQuery.validator.addMethod( 'passwordMatch', function(value, element) {
    
    // The two password inputs
    var password = $("input[name='password']").val();
    var confirmPassword = $("input[name='cpassword']").val();

    // Check for equality with the password inputs
    if (password != confirmPassword ) {
        return false;
    } else {
        return true;
    }

}, "Your Passwords Must Match");

        $("#register-form").validate({
      
     
        // Specify the validation rules
        rules: {
           email: {
                required: true,
                email: true
            },
            name: {
                required: true
            },
            mobile: {
                required: true,
                number:true,
                minlength:10,
                maxlength:10
            },
            password: {
                required: true,
                minlength:6
            },
            cpassword: {
                required: true,
                passwordMatch: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            email: {
                required: 'Email Cannot be Blank',
                email: 'Please provide us a valid Email address'
            },
            name: {
                required: 'Name cannot be Blank'
            },
            mobile: {
                required: 'Mobile cannot be blank',
                number:'Mobile number should contain numbers',
                minlength:'Mobile should be 10 digit',
                maxlength:'Mobile should be 10 digit'
            },
            password: {
                required: 'Password field cannot be blank',
                minlength:'Password should be minimum 6 digits'
            },
            cpassword: {
                required: 'Confirm password fields cannot be blank',
                passwordMatch: 'Password and confirm password should match'
            }
        },
        
        
        submitHandler: function(form) {
                //form.submit();

//ajax code


$.ajax({
        type: "POST",
        url: '<?php echo site_url("register-error")?>',
        data: {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            mobile: $('input[name="mobile"]').val()
              },
        success: function(res) {

                if (res.trim()=="true") {
                    //console.log("inside true "+res.trim());
                    $('.otp-view').show();
                    $('#register-form').hide();
                    $('#errordiv').html('We have sent an OTP to your mobile. Please check and input it');
                } else if(res.trim()=="false") {
                    //console.log("inside false "+res.trim());
                     $('#errordiv').html('Email Id or Phone Number exists with us. Please use a different one');
                }else{
                    console.log(res);
                }        //$('#email').html(res);
        },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                 
                }
        });


//ajax code
       



          }
        
    });

        
    });






$('.check_otp').on('click', function() {
    var pattern = /^\d+$/;

    if ($('input[name="otp"]').val()=='') {
        $('.otp-error').html('OTP cannot be blank');
    }else if(!pattern.test($('input[name="otp"]').val())){
         $('.otp-error').html('OTP should contain only numbers');
    }else{
        $('.otp-error').html('');
                //ajax code

    $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/registerconfirm")?>',
        data: {
            name: $('input[name="name"]').val(),
                    email: $('input[name="email"]').val(),
                    mobile: $('input[name="mobile"]').val(),
                    password:$('input[name="password"]').val(),
                    otp: $('input[name="otp"]').val()

        },
        success: function(res) {
            //console.log($.trim(res));
            if ($.trim(res)=="true") {
                window.location.href="<?php echo site_url().'login'; ?>";
            }else if($.trim(res)=="false11-book"){
                 $('.otp-error').text('OTP is wrong. Please try again');
                 console.log('OTP is wrong. Please try again');
            }else{
                console.log("else part "+res);
            }

                              //$('#email').html(res);
        },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                 
                }
        });


//alert("all clear");
                //ajax code

          }

    });

$('.re-enter-details').on('click', function() {
    //hide otp and show form
    $('.otp-view').hide();
    $('#register-form').show();
});

      </script>

</html>