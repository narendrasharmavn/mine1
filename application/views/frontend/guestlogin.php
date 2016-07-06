<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        <div class="text-center">
                            
                        </div>
                        

                          <?php      
                            
                             echo $this->session->flashdata('error-msg'); 
                             echo $this->session->flashdata('success'); 
                                echo form_open('guestlogin_error',array('name'=>'registerform','method'=>'post'));
                            ?>
                          
                                <div class="form-group">
                                    Please login to your guest account.   
                                </div>

                                <div class="form-group">
                                    
                                    <input type="hidden" name="name" class=" form-control" placeholder="Name" value="guest">
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="number" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo set_value('mobile'); ?>">
                                    <span class="text-danger"><?php echo form_error('mobile'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    
                                    <input type="hidden" name="password" class="form-control" value="1234" >
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="rememberme" tabindex="3" value="forever" id="rememberme" class="pull-left"> <label for="rememberme" class="pl-8">Remember my details</label>
                                    <div class="small pull-right"><a href="<?php echo site_url().'forgot-password'; ?>">Forgot password?</a></div>
                                </div>
                                <button type="submit" class="btn_full">Login</button>
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

</html>