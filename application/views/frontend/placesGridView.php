<script>
    var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
    new google.maps.Size(32, 32), new google.maps.Point(0, 0),
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
        zoom: 0,
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
                addMarker(<?php echo $k->latitude; ?>, <?php echo $k->longitude; ?>, '<?php echo $k->place; ?>');
        <?php } ?>

        center = bounds.getCenter();
        map.fitBounds(bounds);
    }
 </script>


   <!-- <div class="row">
        <div class="col-md-12">
            <div id="map" class="map"></div>
        </div>
     </div>
-->

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
    
    <div class="container margin_60" style="margin-top: 100px;">
    <div class="row">
  

        <div class="col-lg-12 col-md-8">
           

            <?php 

                foreach ($getdata->result() as $k) {
                 //echo $k->place."<br>";
                $placetitleurl = str_replace(" ", "-", $k->place);

            ?>

                             <div class="col-md-4 col-sm-6 wow zoomIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">

                    
    <div class="tour_container">
        <div class="img_container">
            <a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid;   ?>  ">
            <img width="400" height="267" src="<?php  echo base_url().'assets/places/'.$k->photoname;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-4"></i><?php echo $k->place;   ?>               
                <!--<span class="price"><span><sup>Rs. </sup><?php //echo $k->cost;   ?>  </span></span>-->
            </div>
            </a>
        </div>
        <div class="tour_title">
            <h3><a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid;   ?>  "><?php echo $k->place;   ?>  </a></h3>
            <div>
                <?php echo $k->address; ?>
            </div>
            <!--
            <div class="rating">
                <i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small>
            </div><!-- end rating -->
                        <!--
                        <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170"><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div><!-- End wish list-->
                    </div>
    </div><!-- End box tour -->
</div><!-- End col-md-6 -->

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
    
    


    <!-- content ends here -->

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