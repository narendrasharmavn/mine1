<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                        <div class="text-center">

                        </div>
                       

                        <?php      
                            
                             echo $this->session->flashdata('error-msg'); 

                                echo form_open('Frontend/register',array('name'=>'registerform','method'=>'post'));
                            ?>
                            
                                <div class="form-group">
                                    Register For This Site
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class=" form-control" placeholder="Name" value="<?php echo set_value('name'); ?>">
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class=" form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="number" name="mobile" class=" form-control" placeholder="Mobile" value="<?php echo set_value('mobile'); ?>">
                                    <span class="text-danger"><?php echo form_error('mobile'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class=" form-control" placeholder="Password" >
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="cpassword" class=" form-control" placeholder="Confirm Password">
                                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                                </div>
                                
                                <button type="submit" class="btn_full">Create an account</button>
                                <br>Already a member? <a href="<?php echo site_url().'/frontend/loginForm'; ?>">Login</a>
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