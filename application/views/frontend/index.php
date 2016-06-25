<?php
    $query = $this->db->query("SELECT * FROM tblsliders WHERE status=1");




?>

    <!-- Slider -->
    <div class="tp-banner-container">
      <!-- ForNext Slider -->
    <div class="container-fluid">
    <div class="row">
        <!-- Carousel -->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<div class="featured-overlay">
                                <a id="close-form" href="#" class="button close open-close-btn"><i class="icon_close_alt2"></i></a>
								<div class="main_titlee">
                             <h3 style="color:white;">Search 4 Holiday</h3>
                            
                        </div>
							   <div class="featured-overlay-inner">
                                       <?php echo $this->session->flashdata('error-msg'); ?>
                                                <?php  

                                                    echo form_open('search-results',array('id'=>'searchform','method'=>'post','role' => 'search'));
                                                ?>   
                                        <div class="search-field">
                                        
                                            <div class="destination-field">
                                             <div class="row">
											 
                                       
                       
                        <input type="hidden" name="post_type" value="tour">
                        
												<div class="col-md-12">
													<div class="form-group">
														
														<select class="form-control search-form-slider" id="searchtype" name="searchtype">
															<option value="" selected="">Select with</option>
															<option value="resortname" <?php echo  set_select('searchtype', 'resortname'); ?>>Resort Name</option>
														   <option value="eventname" <?php echo  set_select('searchtype', 'eventname'); ?>>Event Name</option>
														   <option value="places" <?php echo  set_select('searchtype', 'places'); ?>>Places</option>
														   
														 </select>
														 <span class="text-danger"><?php echo form_error('searchtype'); ?></span>
														</div>
												</div>
												<div class="col-md-12">
                                <div class="form-group">
                                   
                                    <input type="text" class="form-control search-form-slider" name="searchterm" placeholder="Type your search terms" value="<?php echo set_value('searchterm'); ?>">
                                    <span class="text-danger"><?php echo form_error('searchterm'); ?></span>
                                </div>
                            </div>
                            
                        
                            <div class="col-md-12 datefield">
                                <div class="form-group">
                                    
                                    <input class="form-control search-form-slider" id="datepickerj" type="text" name="date" placeholder="Select date">
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-3 col-xs-6">
                                <div class="form-group">
                                   
                                
                                    <button type="submit" class="btn_1 green"><i class="icon-search"></i>Search now</button>
                                </div>
                            </div>
												</div>
												
                                            </div>
                                        </div>                                            
                                         
                                    </form><!-- /form.location-search -->
                                     
<link rel="stylesheet" type="text/css" href="http://50.116.106.227/~thenordi/demo/themeforest/wordpress/traveline/wp-content/plugins/dopbsp/templates/default/css/jquery.dop.frontend.BSPSearch.css">
<script type="text/JavaScript">
    jQuery(document).ready(function(){
        jQuery("#DOPBSPSearch1").DOPBSPSearch({"availability":{"data":{"enabled":false,"max":10,"min":1},"text":{"title":"No book items"}},"currency":{"data":{"code":"USD","position":"before","sign":"&#36;","text":[]}},"days":{"data":{"first":1,"multipleSelect":true},"text":{"names":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"shortNames":["Su","Mo","Tu","We","Th","Fr","Sa"]}},"hours":{"data":{"ampm":true,"definitions":[{"value":"00:00"},{"value":"01:00"},{"value":"02:00"},{"value":"03:00"},{"value":"04:00"},{"value":"05:00"},{"value":"06:00"},{"value":"07:00"},{"value":"08:00"},{"value":"09:00"},{"value":"10:00"},{"value":"11:00"},{"value":"12:00"},{"value":"13:00"},{"value":"14:00"},{"value":"15:00"},{"value":"16:00"},{"value":"17:00"},{"value":"18:00"},{"value":"19:00"},{"value":"20:00"},{"value":"21:00"},{"value":"22:00"},{"value":"23:00"}],"enabled":false,"multipleSelect":true},"text":[]},"ID":"1","months":{"data":[],"text":{"names":["January","February","March","April","May","June","July","August","September","October","November","December"],"shortNames":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]}},"pluginURL":"http:\/\/50.116.106.227\/~thenordi\/demo\/themeforest\/wordpress\/traveline\/wp-content\/plugins\/dopbsp\/","price":{"data":{"enabled":false,"max":"20","min":"20"},"text":[]},"search":{"data":{"dateType":2,"enabled":true,"language":"en","template":"default"},"text":{"checkIn":"Check in","checkOut":"Check out","hourEnd":"Finish at","hourStart":"Start at","title":"!"}},"sort":{"data":[],"text":{"name":"Name","price":"Price","title":"Sort by"}},"URL":"http:\/\/50.116.106.227\/~thenordi\/demo\/themeforest\/wordpress\/traveline\/wp-admin\/admin-ajax.php","view":{"data":{"default":false,"gridEnabled":true,"listEnabled":true,"mapEnabled":false,"results":1},"text":{"grid":"Grid view","list":"List view","map":"Map view"}}});
    });
</script>

                                </div><!-- /.featured-overlay-inner -->
                            </div>
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
                                <a class="btn btn-theme btn-sm btn-min-block" href="<?php echo $k->link; ?>"><?php echo $k->name; ?></a><a class="btn btn-theme btn-sm btn-min-block" href="#">Register</a></div>
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
                                <a class="btn btn-theme btn-sm btn-min-block" href="<?php echo $k->link; ?>"><?php echo $k->name; ?></a><a class="btn btn-theme btn-sm btn-min-block" href="#">Register</a></div>
                        </div>
                    </div><!-- /header-text -->
                </div>
    <?php
}

$i++;
            }
            ?>

              
                
                
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div><!-- /carousel -->
        </div>
    </div>
    <!-- End Slider -->
    </div>
    <!-- End Slider -->

       
<div class="banner colored">
<div class="container">

                               
                        </div><!-- End row -->
            </div>
<?php

if (count($events->result())>0) {
  ?>

    <div class="container margin_60">
    
        <div class="main_title">
            <h2>Latest Events</h2>
            <p>Happening in Your City</p>
        </div>

        
        
        <div class="row">

        <?php

            foreach ($events->result() as $k) {
                                             // echo $k->eventid."<br>";
                $eventtitleurl = str_replace(" ", "-", $k->eventname);

                                              ?>
<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="tour_container">
                    <div class="img_container">
                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                        <img src="<?php echo base_url().'assets/eventimages/'.$k->photoname; ?>" alt="Image" width="800" height="533" class="img-responsive">
                        
                        <div class="short_info">
                            <i class="icon_set_1_icon-44"></i><?php echo $k->eventname; ?>

                        </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3>
                            <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> "> 
                            <strong>
                            
                                <?php echo $k->eventname; ?>
                                
                            </strong> tour
                            </a>
                        </h3>
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
            <a href="<?php echo site_url().'eventsall' ?>" class="btn_1 medium"><i class="icon-eye-7"></i>View all Events  </a>
        </p>
        
        <hr>
        
         </div><!-- End container -->

         <?php

           # code...
}

?>


<?php
$query = $this->db->query("SELECT * FROM tblplaces WHERE status=1 ORDER BY plid desc limit 4");

if (count($query->result())>0) {
    



?>
    
    <div class="white_bg">
        <div class="container margin_60">
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
                <div class="col-md-3 col-sm-6 text-center">
                    <p>
                        <a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><img src="<?php echo base_url(); ?>/assets/places/<?php echo $photoname; ?>" alt="Pic" width="800" height="450" style="min-height: 200px;" class="img-responsive"></a>
                  </p>
                    <h4><a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><?php echo $placename; ?></a></h4>
                    <p>
                        <?php echo $pdescription; ?>
                    </p>
                </div>
                
                <?php } ?>
            </div><!-- End row -->

            <p class="text-center add_bottom_30">
            <a href="<?php echo site_url().'placesall' ?>" class="btn_1 medium"><i class="icon-eye-7"></i>View all Places  </a>
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
    //alert("hello");
    $('#datepickerj').datepick({dateFormat: 'yyyy-mm-dd'});
    //$('#inlineDatepicker').datepick({onSelect: showDate});
    //$('#datetimepicker4').datetimepicker();

    var searchType = $('#searchtype').val();
    if (searchType=="eventname") {
        //$('.datefield').show();
        $('#datepickerj').prop('disabled', false);
        //$(this).text(enable ? 'Disable' : 'Enable'). 
        //siblings('.is-datepick').datepick(enable ? 'enable' : 'disable'); 
        //$(".datefield").attr("enabled", "enabled"); 
        
    } else {
        $('.datefield').show();
         //$(".datefield").attr("disabled", "disabled");
         $('#datepickerj').prop('disabled', true);
    }
});


$('#searchtype').on('change',function(){
    //alert(this.value);
    if(this.value=='eventname'){
       // $('.datefield').show();
       //  $(".datefield").attr("enabled", "enabled");
       $('#datepickerj').prop('disabled', false);
    }else{
       // $('.datefield').show();
        // $(".datefield").attr("disabled", "disabled");
        $('#datepickerj').prop('disabled', true);
    }

});



</script>

        </body>

</html>