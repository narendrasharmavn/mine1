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
                            
                             echo $this->session->flashdata('error-msg'); 

                                echo form_open('register-error',array('name'=>'registerform','method'=>'post'));
                            ?>
                            
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

</html>