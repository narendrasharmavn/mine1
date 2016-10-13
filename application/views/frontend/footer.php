
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <h3>Need help?</h3>
                    <a href="tel://004542344599" id="phone">
<?php 
echo $this->db->get_where('organization' , array('id' =>1))->row()->phonenumber;
  ?>
                    </a>
                    <a href="mailto:help@book4holiday.com" id="email_footer">
<?php 
echo $this->db->get_where('organization' , array('id' =>1))->row()->emailaddress;
  ?>
                    </a>
                    <!--<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Googleplayss.png" class="img-responsive footcopy"></a>-->
                </div>
                <div class="col-md-3 col-sm-3">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <!--<li><a href="#">FAQ</a></li>-->
                        <li><a href="<?php echo site_url().'login'; ?>">Sign In</a></li>
                        <li><a href="<?php echo site_url().'register'; ?>">Register</a></li>
                        <!--<li style="visibility: hidden; margin-bottom: 5px;"><a href="">Register</a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Windowplayss.png" class="img-responsive footcopy"></a></li>-->
                    </ul>
                </div>
                
                <div class="col-md-3 col-sm-3">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="<?php echo site_url().'kidsdayout' ?>" class="show-submenu">Kids Dayout </a></li>
                        <li><a href="<?php echo site_url().'adventure' ?>" class="show-submenu">Activities and Recreation </a></li>
                        <li><a href="javascript:void(0);" class="show-submenu">Day Events </a></li>
                        <li><a href="<?php echo site_url().'resorts/zoo/1'; ?>">Book Zoo Tickets</a></li>
						<li><a href="<?php echo site_url().'shopping' ?>">Shopping & Fashion </a></li>
                        <li><a href="<?php echo site_url().'weddings' ?>">Weddings & Banquets</a></li>
                        <li><a href="<?php echo site_url().'nightlife' ?>">Night Life</a></li>
                        <li><a href="<?php echo site_url().'placesall' ?>">Things to Do</a></li>
                        
                    </ul>
                </div>
                <div class="col-md-2 col-sm-3">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo site_url().'terms' ?>">Terms and conditions</a></li>
                        <li><a href="<?php echo site_url().'payment-policy' ?>">Payment Policy</a></li>
                        <li><a href="<?php echo site_url().'cancellation-policy' ?>">Cancellation Policy</a></li>
                        
                         <li><a href="<?php echo site_url().'privacy-policy' ?>">Privacy Policy</a></li>
						 <li><a href="<?php echo site_url().'contact' ?>">Contact Us</a></li>
                         <!--<li style="visibility: hidden;"><a href="">Contact Us</a></li>
                         <li> <span style="font-size: 15px;"> © Book4Holiday 2016 </span> </li>-->
                    </ul>
                </div>

                <div class="row">
                <div class="col-xs-12 col-md-12">
                    <center>
                    <div class="footcopy">
                        <div class="col-xs-12 col-md-2"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Googleplayss.png" class="img-responsive footcopy"></a></div> 
                        <div class="col-xs-12 col-md-2"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Windowplayss.png" class="img-responsive footcopy"></a></div> 
                        <div class="col-xs-12 col-md-5" style="visibility: hidden;"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Appleplayss.png" class="img-responsive footcopy"></a></div>  
                        <div class="col-xs-12 col-md-3"> <span style="font-size: 15px;"> © Book4Holiday 2016 </span> </div>
                    </div>
                    </center>
                </div>
            </div>
            </div><!-- End row -->
     
            <!--<div class="row">
                <div class="col-xs-12 col-md-12">
                    <center>
                    <div id="social_footer" class="footcopy">
                        <div class="col-xs-12 col-md-3"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Googleplayss.png" class="img-responsive footcopy"></a></div> 
                        <div class="col-xs-12 col-md-3"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Windowplayss.png" class="img-responsive footcopy"></a></div> 
                        <div class="col-xs-12 col-md-3"><a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/Appleplayss.png" class="img-responsive footcopy"></a></div>  
                        <div class="col-xs-12 col-md-3"> <span style="font-size: 15px;"> © Book4Holiday 2016 </span> </div>
                    </div>
                    </center>
                </div>
            </div>--><!-- End row -->
        </div><!-- End container -->
    </footer><!-- End footer -->

    <script type="text/javascript">
        $('.indexmyhome').css('display','-webkit-inline-box');
        $('.indexmyhome').css('display','-moz-inline-box');
        $('.indexmyhome').css('display','-o-inline-box');
		
		$("#aaa").click(function(){
			$(".menu-two").css('display','none');
			$(".menu-one").css('display','inline-block');
			});
			$("#bbb").click(function(){
				// alert("hello");
				$(".menu-two").css('display','inline-block');
				$(".menu-one").css('display','none');
		});
    </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84967719-1', 'auto');
  ga('send', 'pageview');

</script>
   
