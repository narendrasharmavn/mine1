<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        
                        

                        <?php      
                            
                             echo $this->session->flashdata('error-msg'); 

                                echo form_open('myaccount-update',array('name'=>'registerform','method'=>'post'));
                            ?>
                            
                                <div class="form-group">
                                    Your Account Details
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class=" form-control" placeholder="Name" value="<?php echo $userdetails->name; ?>">
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class=" form-control" placeholder="Email" value="<?php echo $userdetails->username; ?>" disabled>
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="number" name="mobile" class=" form-control" placeholder="Mobile" value="<?php echo $userdetails->number; ?>" disabled>
                                    <span class="text-danger"><?php echo form_error('mobile'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="newpassword" class=" form-control" placeholder="Password" value="" >

                                    <span class="text-danger"><?php echo form_error('newpassword'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>

                                </div>

                               <div class="form-group">
                                    <input type="checkbox" name="updatepassword" tabindex="3" value="0" <?php echo set_checkbox("updatepassword", "0") ?> id="rememberme" class="pull-left"> <label for="rememberme" class="pl-8">Check this to update password</label>
                                    
                                </div>
                                
                                <button type="submit" class="btn_full">Update</button>
                               
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