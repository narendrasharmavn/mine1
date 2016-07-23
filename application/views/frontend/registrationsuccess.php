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
                            
                             echo $this->session->flashdata('error-msg'); 

                                echo form_open('register-error',array('name'=>'registerform','method'=>'post'));
                            ?>
                            
                                <div class="form-group">
                                    Successfully Registered Please Login <a href="<?php echo site_url().'login'; ?>">Here</a>
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