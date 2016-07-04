<section id="hero" class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div id="login">
                    <?php echo $this->session->flashdata('error-msg'); ?>
                        
                        <?php       

    echo form_open('forgot-password',array('id'=>'editstates','method'=>'post'));
?>
                           
                                <div class="form-group">
                                    Please enter your registered email. We will send you the password to your Registered Mobile Number                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter E-mail" value="<?php echo set_value('email'); ?>" required>
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                                <button type="submit" class="btn_full">Get New Password</button>
                                
                                <br>
                                <div style="text-align:center">
                                    <a href="<?php echo site_url().'login'; ?>" class="underline">Login</a>
                                    <a href="<?php echo site_url().'register'; ?>" class="underline">Sign Up</a>
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

</html>