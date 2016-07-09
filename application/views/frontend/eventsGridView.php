<?php $last_id=0; ?>
<script type="text/javascript">
      //paste this code under head tag or in a seperate js file.
      // Wait for window load
      $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
      });
    </script>

<div class="row" style="margin-top:60px;">
                  <div class="se-pre-con"></div>  
                    
                </div>

    <!-- content starts here -->
    
   <!-- <section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url(); ?>assets/frontend/images/bg.jpg" data-natural-width="1400" data-natural-height="500">
        <div class="parallax-content-1">
                <div class="wpb_wrapper">
            <div>
    <h3>BELONG ANYWHERE</h3>
    <p>Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.</p>
    <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video"><i class="icon-play-circled2-1"></i></a>
</div>
        </div>
            </div>
    </section>-->
    
    <div class="container margin_60">
    <div class="row">
        <!--<aside class="col-lg-3 col-md-3">

        <div id="search_results"><?php //echo $totalrows; ?> Results found</div>
         
       <!--  <div id="modify_search">
            <a data-toggle="collapse" href="#collapseModify_search" aria-expanded="false" aria-controls="collapseModify_search" id="modify_col_bt"><i class="icon_set_1_icon-78"></i>Modify Search <i class="icon-plus-1 pull-right"></i></a>
            <div class="collapse" id="collapseModify_search">
                <div class="modify_search_wp">
                    <form role="search" method="get" id="search-tour-form" action="">
                        <input type="hidden" name="post_type" value="tour">
                        <div class="form-group">
                            <label>Search terms</label>
                            <input type="text" class="form-control" id="search_terms" name="s" placeholder="Type your search terms" value="">
                        </div>
                        <div class="form-group">
                            <label>Things to do</label>
                                                            <select class="form-control" name="tour_types">
                                    <option value="" selected="">All tours</option>
                                                                        <option value="30">Churces</option>
                                                                        <option value="34">City sightseeing</option>
                                                                        <option value="31">Eat &amp; Drink</option>
                                                                        <option value="32">Historic Buildings</option>
                                                                        <option value="33">Museum tours</option>
                                                                        <option value="29">Skyline tours</option>
                                                                    </select>
                                                    </div>
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Date</label>
                            <input class="date-pick form-control" data-date-format="mm/dd/yyyy" type="text" name="date" value="">
                        </div>
                        <div class="form-group">
                            <label>Adults</label>
                            <div class="numbers-row">
                                <input type="text" value="1" class="qty2 form-control" name="adults">
                            <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>
                        </div>
                        <div class="form-group add_bottom_30">
                            <label>Children</label>
                            <div class="numbers-row">
                                <input type="text" value="0" class="qty2 form-control" name="kids">
                            <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>
                        </div>
                        <button class="btn_1 green">Search again</button>
                    </form>
                </div>
            </div><!--End collapse 
        </div>

        -->

   

        <!--<div id="filters_col">
            <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Filters <i class="icon-plus-1 pull-right"></i></a>
            <div class="collapse in" id="collapseFilters">

                                                        <div class="filter_type">
                        <h6>Price</h6>
                        <ul class="list-filter price-filter" data-base-url="" data-arg="price_filter">
                                                                <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="price_filter[]" value="0" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>$0 - $50</label></li>
                                                                                                <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="price_filter[]" value="1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>$50 - $80</label></li>
                                                                                                <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="price_filter[]" value="2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>$80 - $100</label></li>
                                                                                                <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="price_filter[]" value="3" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>$100 +</label></li>
                                                                                    </ul>
                    </div>
                
                                <div class="filter_type">
                    <h6>Rating</h6>
                    <ul class="list-filter rating-filter" data-base-url="" data-arg="rating_filter">
                                                    <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="rating_filter[]" value="5" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div><span class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i>                        </span></label></li>

                                                    <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="rating_filter[]" value="4" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div><span class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>                      </span></label></li>

                                                    <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="rating_filter[]" value="3" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div><span class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>                        </span></label></li>

                                                    <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="rating_filter[]" value="2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div><span class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i>                      </span></label></li>

                                                    <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="rating_filter[]" value="1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div><span class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i>                        </span></label></li>

                                            </ul>
                </div>
                
                              
                
            </div><!--End collapse -->
        <!--</div><!--End filters col-->
        <!--</aside><!--End aside --><!--End aside -->

        <div class="col-lg-12 col-md-12">
            <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                        <select name="sort_date" id="sort_date"  onchange="showEventsDatePrice()">
                                <option value="" selected="">Sort by Date</option>
                                <option value="today">Today</option>
                                <option value="tomorrow">Tomorrow</option>
                                <option value="tweek">This Week</option>
                                <option value="nweek">Next Week</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                            <select name="sort_price" id="sort_price"  onchange="showEventsDatePrice()">
                                <option value="" selected="">Sort by Price</option>
                                <option value="0-100">0-100</option>
                                <option value="100-500">100-500</option>
                                <option value="500-1000">500-1000</option>
                                <option value="1000-5000">1000-5000</option>
                            </select>
                        </div>
                    </div>
                    <!--<div class="col-md-6 col-sm-6 hidden-xs text-right">
                        <a href="<?php //echo site_url().'/frontend/eventsGridView'; ?>" class="bt_filters" title="Grid View"><i class="icon-th"></i></a>
                        <a href="<?php //echo site_url().'/frontend/eventsListView'; ?>" class="bt_filters" title="List View"><i class="icon-list"></i></a>
                    </div>-->
                </div>
            </div><!--End tools -->
           <input type="hidden" id="sessionvalue" name="sessionvalue" value="0">
            <div class="tour-list row add-clearfix" id="results">
               
            <?php 
                    //echo "count is: ".count($getdata->result());
                    if(count($getdata->result())>0){
                    foreach ($getdata->result() as $k) {
                          //echo $k->eventname."<br>";
                         $eventtitleurl = str_replace(" ", "-", $k->eventname);
                    $sql = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql."<br>";


                 $query2 = $this->db->query($sql);
                 $row =$query2->row();
                          ?>
                          
        <div class="col-md-4 col-sm-4 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">

    
                  
                            <div class="tour_container">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> " target="_blank">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->photoname;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                        <i class="icon_set_1_icon-4"></i><?php echo $k->eventname;   ?> 
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 ><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                  <!--  <div class="rating">
                                        <i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small>
                                    </div> end rating -->
                                    <!--
                                                <div class="wishlist">
                                        <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
                                    </div> End wish list-->
                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->


                          <?php

                          $last_id = $k->eventid;
                    }
                }else{
                    echo '<div class="alert alert-danger" role="alert">No results over your choosen Criteria</div>';
                }

                     ?>
</div>
</div>
</div>
 </div><!-- End row -->

            <hr>

                <div class="text-center">
                <?php //echo $pagination; ?>
                   
                </div><!-- end pagination-->
                
        </div><!-- End col lg 9 -->
    </div><!-- End row -->
</div>
    
    
    <!--      <div class="post-content">
            <div class="post nopadding clearfix">
                            <div class="vc_row wpb_row vc_row-fluid white_bg margin_60 inner-container"><div class="container"><div class="row">
    <div class="col-sm-12 ">
             <div class="banner colored ">
<h4>Discover our Top tours <span class="">from $34</span></h4>
Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in.
<a class="btn_1 white" href="#">Read more</a></div><div class="vc_row wpb_row vc_inner row"><div class="text-center wpb_column col-sm-6 col-md-3"><div class="vc_column-inner "><div class="wpb_wrapper">
    <div>
            <p><a href="#"><img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/bus.jpg" alt="Pic"></a></p>
<h4><b>Sightseen tour</b> booking</h4>
<p>Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.</p>

    </div> </div></div></div><div class="text-center wpb_column col-sm-6 col-md-3"><div class="vc_column-inner "><div class="wpb_wrapper">
    <div>
            <p><a href="#"><img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/bus.jpg" alt="Pic"></a></p>
<h4><b>Sightseen tour</b> booking</h4>
<p>Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.</p>

    </div> </div></div></div><div class="text-center wpb_column col-sm-6 col-md-3"><div class="vc_column-inner "><div class="wpb_wrapper">
    <div>
            <p><a href="#"><img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/bus.jpg" alt="Pic"></a></p>
<h4><b>Sightseen tour</b> booking</h4>
<p>Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.</p>

    </div> </div></div></div><div class="text-center wpb_column col-sm-6 col-md-3"><div class="vc_column-inner "><div class="wpb_wrapper">
    <div>
            <p><a href="#"><img class="img-responsive" src="<?php echo base_url(); ?>assets/frontend/images/bus.jpg" alt="Pic"></a></p>
<h4><b>Sightseen tour</b> booking</h4>
<p>Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.</p>

    </div> </div></div></div></div>
    </div> 
</div></div></div><div class="vc_row wpb_row row">
    
</div><div class="vc_row wpb_row vc_row-fluid margin_60 inner-container"><div class="container"><div class="row">
    <div class="col-sm-12 ">
            
    <div>
            <div class="main_title">
<h2>Some <b>good</b> reasons</h2>
<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
</div>

    </div> <div class="vc_row wpb_row vc_inner row"><div class="wow zoomIn wpb_column col-sm-12 col-md-4" style="visibility: hidden; animation-name: none;"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="ct-icon-box  feature_home"><i class="icon_set_1_icon-41"></i>
<h3><b>+120</b> Premium tours</h3>
<p class="">Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.</p>
<a class="btn_1 outline" href="#">Read more</a></div></div></div></div><div class="wow zoomIn wpb_column col-sm-12 col-md-4" style="visibility: hidden; animation-name: none;"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="ct-icon-box  feature_home"><i class="icon_set_1_icon-30"></i>
<h3><b>+1000</b> Customers</h3>
<p class="">Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.</p>
<a class="btn_1 outline" href="#">Read more</a></div></div></div></div><div class="wow zoomIn wpb_column col-sm-12 col-md-4" style="visibility: hidden; animation-name: none;"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="ct-icon-box  feature_home"><i class="icon_set_1_icon-57"></i>
<h3><b>H24 </b> Support</h3>
<p class="">Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.</p>
<a class="btn_1 outline" href="#">Read more</a></div></div></div></div></div>
    <div>
            <hr>

    </div> 
    </div> 
</div></div></div>                                          </div><!-- end post -->
        </div>

     <?php
     include 'footer.php';
      ?>

<div id="toTop"></div><!-- Back to top button -->

<?php
     include 'scripts.php';
      ?>

        </body>

</html>
<script type="text/javascript">var last_id = <?php echo $last_id; ?>;</script>

<script type="text/javascript">
  var is_loading = false; // initialize is_loading by false to accept new loading
var limit = 4; // limit items per page


function showEventsDatePrice()
    {
        
       var price = $('#sort_price').val();
       //alert(price);
        $('#sessionvalue').val(0);
       var date = $('#sort_date').val();
       //alert(date);

       $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/sortpricedateforevents")?>',
        data: {
           date:date,
           price:price
        },
        success: function(data) {
            if(data.trim()!='')
            {
              $('#results').html(data);
              
            }else{
               $('#results').addClass("animated slideInUp"); 
               $('#results').html('<div class="alert alert-danger" role="alert">No results over your choosen filters</div>');
            } 
            console.log(data);
        },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                console.log(xhr.responseText);
             
            }
        });


        
    }





$(document).ready(function() {
        var totalrecord = 0;
        var total_groups = <?php echo $total_data; ?>; 
        var lastid = <?php echo $last_id; ?>
        
        $(window).scroll(function() {       
            if($(window).scrollTop() + $(window).height() == $(document).height())  
            {           
                if(is_loading == false)
                {
                    //alert(last_id);
                  loading = true; 
                  $('.loader_image').show(); 
                  var price = $('#sort_price').val();
                var date = $('#sort_date').val();
                //alert(lastid);
                var lastidone =lastid;

                 var sessionValue = $('#sessionvalue').val();
                sessionValue  =+sessionValue+1;
                //alert(sessionValue);
                $('#sessionvalue').val(sessionValue);

                $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/sortpricedateforeventsAjax")?>',
        data: {
            'date':date,
           'price':price,
           'lastid':lastidone,
           'limit':limit,
           'sessionValue':sessionValue
           
                        },
        success: function(data) {
                        if(data!='')
                        {
                            $("#results").append(data);                 
                            $('.loader_image').hide();                  
                            
                          
                        }
        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                            console.log(xhr.responseText);
                         
                        }


        }); //end of ajax



                }
            }
        });
    });
    

    


    


</script>