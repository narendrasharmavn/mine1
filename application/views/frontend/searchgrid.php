

    <!-- content starts here -->
    
    <section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url(); ?>assets/frontend/images/bg.jpg" data-natural-width="1400" data-natural-height="500">
        <div class="parallax-content-1">
                <div class="wpb_wrapper">
            <div>
    <h3>BELONG ANYWHERE</h3>
    <p>Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.</p>
    <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video"><i class="icon-play-circled2-1"></i></a>
</div>
        </div>
            </div>
    </section>
    
    <div class="container margin_60">
    <div class="row">
        <aside class="col-lg-3 col-md-3">

        <div id="search_results">9 Results found</div>
        
        <div id="modify_search">
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
            </div><!--End collapse -->
        </div>

        <div class="box_style_cat">
            <ul id="cat_nav">
                <li class="all-types"><a href="" class="active"><i class="icon_set_1_icon-51"></i>All tours<small>(9)</small></a></li><li data-term-id="30"><a href="&amp;tour_types=30&amp;page=0"><i class="icon_set_1_icon-43"></i>Churces<small>(1)</small></a></li><li data-term-id="34"><a href="&amp;tour_types=34&amp;page=0"><i class="icon_set_1_icon-3"></i>City sightseeing<small>(2)</small></a></li><li data-term-id="31"><a href="&amp;tour_types=31&amp;page=0"><i class="icon_set_1_icon-14"></i>Eat &amp; Drink<small>(0)</small></a></li><li data-term-id="32"><a href="&amp;tour_types=32&amp;page=0"><i class="icon_set_1_icon-44"></i>Historic Buildings<small>(1)</small></a></li><li data-term-id="33"><a href="&amp;tour_types=33&amp;page=0"><i class="icon_set_1_icon-4"></i>Museum tours<small>(5)</small></a></li><li data-term-id="29"><a href="&amp;tour_types=29&amp;page=0"><i class="icon_set_1_icon-28"></i>Skyline tours<small>(0)</small></a></li>         </ul>
        </div>

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
                
                                <div class="filter_type">
                    <h6>Facility</h6>
                    <ul class="list-filter facility-filter" data-base-url="" data-arg="facilities">
                        <li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="facility_filter[]" value="38" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>Access for disabled</label></li><li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="facility_filter[]" value="39" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>Audio guide</label></li><li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="facility_filter[]" value="37" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>Groups allowed</label></li><li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="facility_filter[]" value="35" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>Pet allowed</label></li><li><label><div class="icheckbox_square-grey" style="position: relative;"><input type="checkbox" name="facility_filter[]" value="36" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>Tour guides</label></li>                   </ul>
                </div>
                
            </div><!--End collapse -->
        </div><!--End filters col-->
        </aside><!--End aside -->

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
                        <a href="" class="bt_filters" title="Grid View"><i class="icon-th"></i></a>
                        <a href="/wordpress/citytours/tour/?view=list" class="bt_filters" title="List View"><i class="icon-list"></i></a>
                    </div>
                </div>
            </div><!--End tools -->

            <div class="tour-list row add-clearfix">
                    <div class="col-md-6 col-sm-6 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/arc-de-triomphe/">
            <img width="400" height="267" src="wp-content/uploads/2015/09/tour_box_1-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="tour_box_1">         <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-4"></i>Museum tours               <span class="price"><span><sup>$</sup>52</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>ARC DE TRIOMPHE</h3>
            <div class="rating">
                <i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 --> <div class="col-md-6 col-sm-6 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/notredame-tour/">
            <img width="400" height="267" src="wp-content/uploads/2015/10/7_large-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="7_large">           <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-43"></i>Churces               <span class="price"><span><sup>$</sup>42</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>NOTREDAME TOUR</h3>
            <div class="rating">
                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="177"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="177" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 --> <div class="col-md-6 col-sm-6 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/versailles-tour/">
            <img width="400" height="267" src="wp-content/uploads/2015/09/tour_box_3-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="tour_box_3">         <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-44"></i>Historic Buildings                <span class="price"><span><sup>$</sup>39</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>VERSAILLES TOUR</h3>
            <div class="rating">
                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="178"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="178" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 --> <div class="col-md-6 col-sm-6 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/pompidue-tour/">
            <img width="400" height="267" src="wp-content/uploads/2015/09/tour_box_4-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="tour_box_4">         <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-3"></i>City sightseeing               <span class="price"><span><sup>$</sup>52</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>POMPIDUE TOUR</h3>
            <div class="rating">
                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="179"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="179" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 --> <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/tour-eiffel-tour/">
            <img width="400" height="267" src="wp-content/uploads/2015/09/tour_box_14-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="tour_box_14">           <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-3"></i>City sightseeing               <span class="price"><span><sup>$</sup>49</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>TOUR EIFFEL TOUR</h3>
            <div class="rating">
                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="180"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="180" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 --> <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/pantheon-tour/">
            <img width="400" height="267" src="wp-content/uploads/2015/09/tour_box_5-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="tour_box_5">         <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-4"></i>Museum tours               <span class="price"><span><sup>$</sup>49</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>PANTHEON TOUR</h3>
            <div class="rating">
                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="182"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="182" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 --> <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/louvre-museum-tour/">
            <img width="400" height="267" src="wp-content/uploads/2015/10/8_large-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="8_large">           <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-4"></i>Museum tours               <span class="price"><span><sup>$</sup>102</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>LOUVRE MUSEUM TOUR</h3>
            <div class="rating">
                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="214"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="214" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 --> <div class="col-md-6 col-sm-6 wow zoomIn" data-wow-delay="0.1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
    <div class="tour_container">
        <div class="img_container">
            <a href="tour/open-bus-tour/">
            <img width="400" height="267" src="wp-content/uploads/2015/10/tour_box_8-400x267.jpg" class="attachment-ct-list-thumb wp-post-image" alt="tour_box_8">         <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-4"></i>Museum tours               <span class="price"><span><sup>$</sup>62</span></span>
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3>OPEN BUS TOUR</h3>
            <div class="rating">
                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="213"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="213" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 -->         </div><!-- End row -->

            <hr>

                <div class="text-center">
                    <ul class="page-numbers">
    <li><span class="page-numbers current">1</span></li>
    <li><a class="page-numbers" href="/wordpress/citytours/tour/?page=2&amp;view=grid">2</a></li>
    <li><a class="next page-numbers" href="/wordpress/citytours/tour/?page=2&amp;view=grid">Next</a></li>
</ul>
                </div><!-- end pagination-->
                
        </div><!-- End col lg 9 -->
    </div><!-- End row -->
</div>
    
    
        <div class="post-content">
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