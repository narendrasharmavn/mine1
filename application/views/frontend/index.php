<?php
    $query = $this->db->query("SELECT * FROM tblsliders WHERE status=1");
?>
<style>
.search-results-autofill ul{
    list-style:none;

}


.category-headings{
    background-color: rgb(121, 121, 118);
    padding: 6px;
    /* border-radius: 2px; */
    border-top: 1px solid;
    border-bottom: 1px solid;
    text-align: left;
}

.list-items{
    text-align: left;

    padding: 6px 0px 2px 17px;
    background-color: #fffae9;
    

}
.list-items a { color: #2a3305 !important; }
.list-items:hover{
    background-color: #ffedb4;
}
.li:first-child:hover {
    background: black;
}
</style>

        <!-- Slider -->
    <div class="tp-banner-container">
      <!-- ForNext Slider -->
      <div id="jssor_1" style="position: relative; margin: 0 auto; top: 55px; left: 0px; width: 1300px; height: 500px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
            <div data-p="225.00" style="display: none;">
                <img data-u="image" src="<?php echo base_url(); ?>assets/sliderimages/2.jpg" />
                <div style="position: absolute; top: 180px; left: 230px; width: 480px; height: 120px; font-size: 50px; color: #ffffff; line-height:38px;">Some Text Comes Here</div>
                <div style="position: absolute; top: 300px; left: 330px; width: 480px; height: 120px; font-size: 30px; color: #ffffff; line-height: 38px;">Some Caption Comes Here</div>
               
                
            </div>
            <div data-p="225.00" style="display: none;">
                <img data-u="image" src="<?php echo base_url(); ?>assets/sliderimages/4.jpg" />
            </div>
            <div data-p="225.00" data-po="80% 55%" style="display: none;">
                <img data-u="image" src="<?php echo base_url(); ?>assets/sliderimages/8.jpg" />
            </div>
			<div data-p="225.00" data-po="80% 55%" style="display: none;">
                <img data-u="image" src="<?php echo base_url(); ?>assets/sliderimages/10.jpg" />
            </div>
            <a data-u="ad" href="http://www.jssor.com" style="display:none">Bootstrap Carousel</a>
        
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>
    <script>
        jssor_1_slider_init();
    </script>
    <div class="container margin_60" style="background:#ccc;">
    
    
    <div class="row">
        <!-- Carousel -->
        <div class="featured-overlay hidden-sm hidden-xs">
                                <a id="close-form" href="#" class="button close open-close-btn"><i class="icon_close_alt2"></i></a>
                                
                               <div class="featured-overlay-inner">
                                       <?php echo $this->session->flashdata('error-msg'); ?>
                                                <?php  

                                                    echo form_open('search-results',array('id'=>'searchform','method'=>'post','role' => 'search','class' => 'searchform'));
                                                ?>   
                                        <div class="search-field">
                                        
                                            <div class="destination-field">
                                             <div class="row">
                                             
                                       
                       
                        <input type="hidden" name="post_type" value="tour">
                         
                                             <div class="col-md-12">
                                                    <div class="form-group">
                                                        
                                                        <select class="form-control search-form-slider searchtype" id="searchtype" name="searchtype" required>
                                                            <option value="" selected="">Search For</option>
                                                            <option value="resortname" <?php echo  set_select('searchtype', 'resortname'); ?>>Resort Name</option>
                                                           <option value="eventname" <?php echo  set_select('searchtype', 'eventname'); ?>>Event Name</option>
                                                           <option value="places" <?php echo  set_select('searchtype', 'places'); ?>>Places</option>
                                                           
                                                         </select>
                                                         <span class="text-danger searchtypeerror"><?php echo form_error('searchtype'); ?></span>
                                                        </div>
                                                </div>
												<div class="col-md-12 datefield">
													<div class="form-group">
														
														<input class="form-control search-form-slider datepickerj" type="text" name="date" id="date" placeholder="Select date">
														<span class="text-danger datepickerjerror"><?php echo form_error('date'); ?></span>
													</div>
												</div>
                                                <div class="col-md-12">
<div class="form-group">
      <!-- /btn-group -->
     <input type="text" class="form-control search-form-slider1" style="height:35px;font-size:14px;" name="searchterm" id="searchterm" placeholder="Resorts, Events or Places " value="<?php echo set_value('searchterm'); ?>" autocomplete="off" required>
                                    
    </div><!-- /input-group -->
<span class="text-danger searchtermerror"><?php echo form_error('searchterm'); ?></span>
                                    <span class="search-results-autofill"></span>
                               
                            </div>
                            
                            <div class="col-md-12 col-sm-3 col-xs-6">
                                <div class="form-group">
                                   
                                
                                    <button type="submit" class="btn_1 green searchnowbutton"><i class="icon-search"></i>Search now</button>
                                </div>
                            </div>
                                                </div>
                                                
                                            </div>
                                        </div>                                            
                                         
                                    </form><!-- /form.location-search -->

                                </div><!-- /.featured-overlay-inner -->
                            </div>
                            
        <div id="carousel-example-generic" class="carousel slide col-md-9 hidden-lg hidden-md" data-ride="carousel">
        
            <!-- Indicators -->
            <ol class="carousel-indicators">
            <?php
            $i=0;
            foreach ($query->result() as $k) {
                if($i==1){
                    ?>

                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;  ?>" class="active"></li>

                    <?php
}else{
    ?>
<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;  ?>" ></li>
    <?php
}

$i++;
            }
            ?>
               
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
            $i=0;
            foreach ($query->result() as $k) {
                if($i==1){
                    ?>

                    <div class="item active">
                    <img src="<?php echo base_url(); ?>/assets/sliderimages/<?php echo $k->image; ?>" alt="<?php echo $k->image; ?>">
                                        <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>Welcome to <strong><?php echo $k->title; ?></strong></span>
                            </h2>
                            <br>
                            <h3>
                                <span><?php echo $k->subtitle; ?></span>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-danger btn-sm btn-min-block" href="<?php echo $k->link; ?>"><?php echo $k->name; ?></a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>

                    <?php
}else{
    ?>
<div class="item">
                    <img src="<?php echo base_url(); ?>/assets/sliderimages/<?php echo $k->image; ?>" alt="<?php echo $k->image; ?>">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>Welcome to <strong><?php echo $k->title; ?></strong></span>
                            </h2>
                            <br>
                            <h3>
                                <span><?php echo $k->subtitle; ?></span>
                            </h3>
                            <br>
                            <div class="">
                                <a class="btn btn-danger btn-sm btn-min-block" href="<?php echo $k->link; ?>"><?php echo $k->name; ?></a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>
    <?php
}

$i++;
            }
            ?>

              
                
                
            </div>
            <!-- Controls 
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>-->
        </div><!-- /carousel -->
        </div>
    </div>
    <!-- End Slider -->
    </div>
    <!-- End Slider -->

       

       
<div class="banner colored hidden-lg hidden-md">
<div class="container">

                                        <?php echo $this->session->flashdata('error-msg'); ?>
                                                <?php  

                                                    echo form_open('search-results',array('class' => 'searchform','id'=>'search-tour-form','method'=>'post','role' => 'search'));
                                                ?>
                       
                        <input type="hidden" name="post_type" value="tour">
                        <div class="main_title">
                             <h2 style="color:white;">Search 4 Holiday</h2>
                            
                        </div>
                       
                        <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    
                                    <select class="form-control searchtype" name="searchtype" required>
                                        <option value="" selected="">Search For</option>
                                        <option value="resortname" <?php echo  set_select('searchtype', 'resortname'); ?>>Resort Name</option>
                                       <option value="eventname" <?php echo  set_select('searchtype', 'eventname'); ?>>Event Name</option>
                                       <option value="places" <?php echo  set_select('searchtype', 'places'); ?>>Places</option>
                                       
                                     </select>
                                     <span class="text-danger"><?php echo form_error('searchtype'); ?></span>
                                    </div>
                            </div>
                            <div class="form-group">
                                   
                                    <input type="text" class="form-control search-form-slider" name="searchterm" id="searchterm" placeholder="Enter Keywords" value="<?php echo set_value('searchterm'); ?>" required>
                                    <span class="text-danger searchtermerror"><?php echo form_error('searchterm'); ?></span>
                                    <span class="search-results-autofill"></span>
                                </div>
                            
                        
                            <div class="col-md-12 datefield">
                                <div class="form-group">
                                    
                                    <input class="form-control search-form-slider datepickerj" type="text" name="date" placeholder="Select date">
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-6">
                                <div class="form-group">
                                   
                                
                                    <button type="submit" class="btn_1 green searchnowbutton"><i class="icon-search"></i>Search now</button>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            
                            
            </div>
                        </div><!-- End row -->
            </div>
<?php

if (count($events->result())>0) {
  ?>

    <div class="container margin_60">
    
        <div class="main_title">
            <h2>Latest Events</h2>
           
        </div>

        
        
        <div class="row">

        <?php

            foreach ($events->result() as $k) {
                                             // echo $k->eventid."<br>";
                $eventtitleurl = str_replace(" ", "-", $k->eventname);

                                              ?>
<div class="col-md-3 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="tour_container  events-thumb">
                    <div class="img_container">
                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                        <img src="<?php echo base_url().'assets/eventimages/'.$k->photoname; ?>" alt="Image" style="min-height:200px;" class="img-responsive">
                        
                        <div class="short_info">
                            <i class="icon_set_1_icon-44"></i><?php echo $k->eventname; ?>
							

                        </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3>
                            <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> "> 
                           
                            
                                <?php echo $k->eventname; ?>
                                
                          
                            </a>
							
                        </h3>
						<p style="padding: 5px;"><?php echo $k->description; ?></p>
                      <!--  <div class="rating">
                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                        </div> end rating -->
                        
                      <!--   <div class="wishlist">
                            <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                        </div>End wish list-->
                    </div>
                </div><!-- End box tour -->
            </div><!-- End col-md-4 -->


                                              <?php
                    }

        ?>
        
                 
        </div><!-- End row -->
        <p class="text-center add_bottom_30">
            <a href="<?php echo site_url().'eventsall' ?>" class="btn_1 green medium"><i class="icon-eye-7"></i>View all Events  </a>
        </p>
        
        <hr>
        
        

         <?php

           # code...
}

?>


<?php
$query = $this->db->query("SELECT * FROM tblplaces WHERE status=1 ORDER BY plid desc limit 4");

if (count($query->result())>0) {
    



?>
    
    
            <div class="main_title">
                <h2>Other <span>Popular</span> Places in Hyderabad</h2>
                
            </div>

            <div class="row">
                <?php 
                    
                    foreach ($query->result() as $k) {
                       $plid = $k->plid;
                       $placename = $k->place;
                       //echo $placename."<br>";
                       $pdescription = $k->description;
                       //echo $pdescription."<br>";
                       $getplacepic = $this->db->query("SELECT * FROM tblplacesphotos WHERE plid='$plid'");
                       $rows = $getplacepic->row(); 
                       $photoname = $rows->photoname;
                       //echo $photoname."<br>";
                       $placetitleurl = str_replace(" ", "-", $k->place);
                    
                ?>
                <div class="col-md-3 col-sm-6 text-center places-thumb">
                    <p>
                        <a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><img src="<?php echo base_url(); ?>/assets/places/<?php echo $photoname; ?>" alt="Pic" width="800" height="450" style="min-height: 200px;" class="img-responsive"></a>
                  </p>
                  <div class="place_title">
                    <h3><a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><?php echo $placename; ?></a></h3>
</div>                   
                   <p style="padding: 5px;">
                        <?php echo $pdescription; ?>
                    </p>
                </div>
                
                <?php } ?>
            </div><!-- End row -->

            <p class="text-center add_bottom_30">
            <a href="<?php echo site_url().'placesall' ?>" class="btn_1 green medium"><i class="icon-eye-7"></i>View all Places  </a>
        </p>

           
            
            
        </div><!-- End container -->
    </div><!-- End white_bg -->
   
    
    
    <?php
}
     include 'footer.php';
      ?>

<div id="toTop"></div><!-- Back to top button -->

<?php
     include 'scripts.php';
      ?>

<script type="text/javascript">

$('document').ready(function(){
    

   $( ".datepickerj" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});

    var searchType = $('.searchtype').val();
    if (searchType=="eventname") {
        $('.datefield').show();
    } else {
        $('.datefield').hide();    
    }


    


});


$('.searchtype').on('change',function(){
    //alert(this.value);
    if (this.value=="eventname") {
        $('.datefield').show();
        $(".datefield").rules("add", "required");
    } else {
        $('.datefield').hide();
        $(".datefield").rules("remove", "required"); 
    }

});


$('.search-form-slider1').on('keyup',function () {
    if (this.value.length>=3) {

var searchtype = $('#searchtype').val();

        $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/autofillsearch")?>',
        data: {
           searchtype:searchtype,
           searchterm: this.value

        },
        success: function(res) {

                console.log(res);
                
                $('.search-results-autofill').html(res);
        },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                 
                }
        });
       



    }else{
        $('.search-results-autofill').html('');
    }
});
/*

$('.searchnowbutton').click(function(event) {
    var searchType = $('.searchtype').val();
    var searchterm = $('.searchterm').val();
    var datepickerj = $('.datepickerj').val();

    //alert(datepickerj);
    
    
});


*/

function myFunctionFocusOut(){
    $('.search-results-autofill').html('');
}




$("#search-book-toggle").click(function(){
    $(".featured-overlay").toggle();
	
	//$("#li-search-book-toggle").css("background-color":"#ebd6bb");
});

</script>

        </body>

</html>