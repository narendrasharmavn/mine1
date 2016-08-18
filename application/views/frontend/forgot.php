<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                    <?php echo $this->session->flashdata('error-msg'); ?>
                        
                        <?php       

    echo form_open('forgotpassword',array('id'=>'editstates','method'=>'post'));
?>
                                <div id="errordiv"></div>
                                <div class="form-group">
                                    Enter your Registered Email. You will new receive password to your Registered Mobile Number                                </div>
                                <div class="form-group">
                                    <label>E-mail <span style="color:red;">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter E-mail" value="<?php echo set_value('email'); ?>" >
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <button type="submit" class="btn_full">Get New Password</button>
                                
                                <br>
                                <div style="text-align:center">
                                    <a href="<?php echo site_url().'login'; ?>" class="underline">Sign In | </a>
                                    <a href="<?php echo site_url().'register'; ?>" class="underline">Register</a>
                                </div>
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

        $("#editstates").validate({
      
    
        // Specify the validation rules
        rules: {
           email: {
                required: true,
                email: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            email: {
                required: "Email address cannot be blank",
                email: 'Please enter valid email address'
            }
        },
        
        
        submitHandler: function(form) {
                form.submit();
          }
        
    });

        
    });
      </script>

</html>