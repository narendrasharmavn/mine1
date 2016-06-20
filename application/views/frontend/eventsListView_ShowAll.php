

<script>

        var icon = new google.maps.MarkerImage("<?php echo base_url().'assets/marker/'  ?>green.png",
        new google.maps.Size(32, 40), new google.maps.Point(0, 0),
        new google.maps.Point(16, 32));
        var center = null;
        var map = null;
        var currentPopup;
        var bounds = new google.maps.LatLngBounds();

        function addMarker(lat, lng, info)
        {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker(
            {
                position: pt,
                icon: icon,
                map: map
            });
            var popup = new google.maps.InfoWindow(
            {
                content: info,
                maxWidth: 300
            });

            google.maps.event.addListener(marker, "click", function()
            {
                if (currentPopup != null)
                {
                    currentPopup.close();
                    currentPopup = null;
                }
                popup.open(map, marker);
                currentPopup = popup;
            });
            google.maps.event.addListener(popup, "closeclick", function()
            {
                map.panTo(center);
                currentPopup = null;
            });
        }

        function loadMap()
        {
            map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(0, 0),
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            mapTypeControlOptions:
            {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
            },
            navigationControl: true,
            navigationControlOptions:
            {
                style: google.maps.NavigationControlStyle.SMALL
            }
            });
            <?php foreach($getdata->result() as $k) { //you could replace this with your while loop query ?>
                addMarker(<?php echo $k->latitude; ?>, <?php echo $k->longitude; ?>, '<?php echo $k->eventname; ?>');
            <?php } ?>
            center = bounds.getCenter();
            map.fitBounds(bounds);
        }
 </script>

<div class="row">
                    
                    <div class="col-md-12">
                       
                        <div id="map" class="map"></div>

      
                    </div>
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
        <aside class="col-lg-3 col-md-3">

        <div id="search_results"><?php echo $totalrows; ?> Results found</div>
  
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

   

        <div id="filters_col">
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
        </div><!--End filters col-->
        </aside><!--End aside --><!--End aside -->

        <div class="col-lg-9 col-md-8">
            <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                            <select name="sort_price" id="sort_price" data-base-url="">
                                <option value="" selected="">Sort by price</option>
                                <option value="lower">Lowest price</option>
                                <option value="higher">Highest price</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                            <select name="sort_rating" id="sort_rating" data-base-url="">
                                <option value="" selected="">Sort by rating</option>
                                <option value="lower">Lowest rating</option>
                                <option value="higher">Highest rating</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs text-right">
                        <a href="<?php echo site_url().'/frontend/resortsGridView'; ?>" class="bt_filters" title="Grid View"><i class="icon-th"></i></a>
                        <a href="<?php echo site_url().'/frontend/resortsListView'; ?>" class="bt_filters" title="List View"><i class="icon-list"></i></a>
                    </div>
                </div>
            </div><!--End tools -->

            <div class="tour-list row add-clearfix">

            <?php 

                    foreach ($getdata->result() as $k) {
                          //echo $k->eventname."<br>";

                          ?>
                          <div class="strip_all_tour_list wow fadeIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
           <!-- <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div>
            -->
                        <div class="img_list">
                <a href="<?php echo site_url().'/frontend/showEventDetails/'.$k->eventid;   ?> ">
                    <!-- <div class="ribbon popular" ></div> -->
                    <img width="330" height="220" src="<?php  echo base_url().'assets/eventimages/'.$k->photoname;   ?> " class="attachment-330x220 wp-post-image" alt="tour_box_1">                   <div class="short_info"><i class="icon_set_1_icon-4"></i><?php echo $k->eventname;   ?> </div>                </a>
            </div>
        </div>
        <div class="clearfix visible-xs-block"></div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="tour_list_desc">
               <!-- <div class="rating"><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small></div>-->
                <h3><?php echo $k->eventname;   ?></h3>
                <p><?php echo $k->description;   ?></p>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="price_list">
                <div>
                   <!-- <span><sup>Rs. </sup>20</span><small>*Per person</small> -->
                    <p><a href="<?php echo site_url().'/frontend/showEventDetails/'.$k->eventid;   ?>" class="btn_1">Details</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

                          <?php
                    }


                     ?>

 </div><!-- End row -->

            <hr>

                <div class="text-center">
                <?php echo $pagination; ?>
                   
                </div><!-- end pagination-->
                
        </div><!-- End col lg 9 -->
    </div><!-- End row -->
</div>
    
    
   <!--       <div class="post-content">
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
<script type="text/javascript">
    
    loadMap();
</script>