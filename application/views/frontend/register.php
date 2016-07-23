<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
<style>
    .alert{
        background-color: #2875b8;
        color:black;
    }

</style>
<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LewvSUTAAAAAD8SQuVQ45j2WgB6fM59artFNFAF'
        });
      };
    </script>
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
                                <div class="g-recaptcha" data-sitekey="6LewvSUTAAAAAD8SQuVQ45j2WgB6fM59artFNFAF"></div>
      
                                <button type="submit" class="btn_full">Create an account</button>
                                <br>Already a member? <a href="<?php echo site_url().'login'; ?>">Login</a>
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


      <script>
  $("document").ready(function(){

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
                form.submit();
          }
        
    });

        
    });
      </script>

</html>