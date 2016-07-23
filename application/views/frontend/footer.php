<div class="anim hidden-sm hidden-xs hidden-lg">
<!--<blockquote class="oval-thought">
        <p>Hi.. How can I help you :-)</p>
      </blockquote>-->
<img src="<?php echo base_url(); ?>/assets/anim/ani.gif" data-toggle="modal" data-target="#myModal" style="height:200px;"/></div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url(); ?>/assets/images/offer.png"/ style="width:100%;">
                                   
      </div>
     <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <h3>Need help?</h3>
                    <a href="tel://004542344599" id="phone">+91 1231313131</a>
                    <a href="mailto:help@book4holiday.com" id="email_footer">help@book4holiday.com</a>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="<?php echo site_url().'login'; ?>">Sign In</a></li>
                        <li><a href="<?php echo site_url().'register'; ?>">Register</a></li>
                         <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 col-sm-3">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="#">Kids Day Out</a></li>
                        <li><a href="#">Adventutre</a></li>
                        <li><a href="#">Day Events</a></li>
                         <li><a href="<?php echo site_url().'placesall' ?>">Places</a></li>
                         <li><a href="<?php echo site_url().'resorts/zoo/1'; ?>">Book Zoo Tickets</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-3">
                    <h3>Quick Links</h3>
                    <ul>
                     <li><a href="#">Terms and conditions</a></li>
                        <li><a href="#">Payment Policy</a></li>
                        <li><a href="#">Cancellation Policy</a></li>
                        <li><a href="#">Return Policy</a></li>
                         <li><a href="#">Shipping Policy</a></li>
                    </ul>
                </div>
            </div><!-- End row -->
            <div class="row">
                <div class="col-md-12">
                    <div id="social_footer">
                        <ul>
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-google"></i></a></li>
                            <li><a href="#"><i class="icon-instagram"></i></a></li>
                            <li><a href="#"><i class="icon-pinterest"></i></a></li>
                            <li><a href="#"><i class="icon-vimeo"></i></a></li>
                            <li><a href="#"><i class="icon-youtube-play"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        </ul>
                        <p>© Book4Holiday 2016</p>
                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    </footer><!-- End footer -->


<script type="text/javascript">
    
    $i=0;
    window.setInterval(function(){
    
    if ($i==1) {
        $('.anim img').attr('src','<?php echo base_url(); ?>/assets/anim/ani.gif');
    }else if($i==2){
        $('.anim img').attr('src','<?php echo base_url(); ?>/assets/anim/ani.gif');
    }else{
        $i=0;
        $('.anim img').attr('src','<?php echo base_url(); ?>/assets/anim/ani.gif');
    }
    

    $i++;
}, 5000);

</script>    
