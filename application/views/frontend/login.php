<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        <div class="text-center">
                            
                        </div>
                        
                        
                          <?php      
                            
                             echo $this->session->flashdata('error-msg'); 
                             echo $this->session->flashdata('register-success'); 
                                echo form_open('login_error',array('name'=>'registerform','method'=>'post', 'id' => 'login-form'));
                            ?>
                          <div id="errordiv"></div>
                 <div class="form-group">
                                    <center><h3>Sign In</h3></center>
                  </div>
                                <div class="form-group">
                                    <label>Email<span style="color:red;">*</span></label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>" >
                                    <span class="text-danger email-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Password<span style="color:red;">*</span></label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" >
                                    <span class="text-danger password-danger"><?php echo form_error('password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="rememberme" tabindex="3" value="forever" id="rememberme" class="pull-left"> <label for="rememberme" class="pl-8">Remember my details</label>
                                    <div class="small pull-right"><a href="<?php echo site_url().'forgot-password'; ?>">Forgot password?</a></div>
                                </div>
                                <button type="submit" class="btn_1 green btn_full">Sign in</button>
                                <input type="hidden" name="redirect_to" value="">
                                                                    <br>Don't have an account? 
                                    <a href="<?php echo site_url().'register'; ?>" class="">Register</a>
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

        $("#login-form").validate({
     
   framework: 'bootstrap',
   icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
    
        // Specify the validation rules
        rules: {
           email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            email: {
                required: "Email address cannot be blank",
                email: 'Please enter valid email address'
            },
            password: "Please enter a password"
        },
        
        
        submitHandler: function(form) {
                form.submit();
          }
        
    });

        
    });
      </script>

</html>