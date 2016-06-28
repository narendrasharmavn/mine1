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
        <h4 class="modal-title">Search 4 Holiday</h4>
      </div>
      <div class="modal-body">
        
                                        <?php echo $this->session->flashdata('error-msg'); ?>
                                                <?php  

                                                    echo form_open('search-results',array('id'=>'search-tour-form','method'=>'post','role' => 'search'));
                                                ?>
                       
                        <input type="hidden" name="post_type" value="tour">
                       
                        <div class="row">
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <select class="form-control" id="searchtype" name="searchtype">
                                        <option value="" selected="">Search For</option>
                                        <option value="resortname" <?php echo  set_select('searchtype', 'resortname'); ?>>Resort Name</option>
                                       <option value="eventname" <?php echo  set_select('searchtype', 'eventname'); ?>>Event Name</option>
                                       <option value="places" <?php echo  set_select('searchtype', 'places'); ?>>Places</option>
                                       
                                     </select>
                                     <span class="text-danger"><?php echo form_error('searchtype'); ?></span>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   
                                    <input type="text" class="form-control" name="searchterm" placeholder="Enter Keywords" value="<?php echo set_value('searchterm'); ?>">
                                    <span class="text-danger"><?php echo form_error('searchterm'); ?></span>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                        
                            <div class="col-md-4 datefield">
                                <div class="form-group">
                                    
                                    <input class="form-control" id="datepickerj" type="date" name="date" placeholder="Select date">
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-6">
                                <div class="form-group">
                                   
                                
                                    <button type="submit" class="btn_1 green"><i class="icon-search"></i>Search now</button>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            
                            
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <h3>Need help?</h3>
                    <a href="tel://004542344599" id="phone">+91 1231313131</a>
                    <a href="#" id="email_footer">help@book4holiday.com</a>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                         <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 col-sm-3">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="#">Kids Day Out</a></li>
                        <li><a href="#">Adventutre</a></li>
                        <li><a href="#">Day Events</a></li>
                         <li><a href="#">Places</a></li>
                         <li><a href="#">Book Zoo Tickets</a></li>
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
        $('.anim img').attr('src','<?php echo base_url(); ?>/assets/anim/elephant.gif');
    }else if($i==2){
        $('.anim img').attr('src','<?php echo base_url(); ?>/assets/anim/squirrel-acorns.gif');
    }else{
        $i=0;
        $('.anim img').attr('src','<?php echo base_url(); ?>/assets/anim/ani.gif');
    }
    

    $i++;
}, 5000);

</script>    
