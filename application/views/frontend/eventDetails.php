 <?php
        $photoName = "";

        $query2 = $this->db->query("SELECT * from tbleventphotos WHERE eventid='$eventid'");

        foreach ($query2->result() as $k) {
              $photoName=$k->photoname;
        }

            $todaysDate = date('Y-m-d');

            $packages = $this->db->query("SELECT * from tblpackages WHERE eventid='$eventid' AND status=1 AND expirydate>='$todaysDate'");

         

        ?>

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
          

                addMarker(<?php echo $eventResults->latitude;  ?>, <?php echo $eventResults->longitude;  ?>, '<?php echo $eventResults->eventname;  ?>');
           
            center = bounds.getCenter();
            map.fitBounds(bounds);
            map.setOptions({ minZoom: 5, maxZoom: 15 });
        }
 </script>
  <script>
            $('#sidebar').theiaStickySidebar({
                additionalMarginTop: 80
            });
        </script>

       


     
 <section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url(); ?>assets/eventimages/<?php echo $photoName; ?>" data-natural-width="1400" data-natural-height="500">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h1><?php echo $eventResults->eventname; ?></h1>
                        <span><?php echo $eventResults->location; ?></span>
                        <span class="rating"><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small></span>
                    </div>
                    <div class="col-md-4 col-sm-4">
                       <!-- <div id="price_single_main">
                            from/per person <span><sup>Rs. </sup><?php echo $packageResults->cost;  ?></span>                             
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
     

    
        <div class="collapse" id="collapseMap">
           <!-- <div id="mapp" class="map"></div>-->
        </div>
        <div id="toTop"></div>
        
        <div id="overlay" class="over"><i class="icon-spin3 animate-spin"></i></div>
        <div class="container margin_60" style="transform: none;">
    <div class="row" style="transform: none;">
        <div class="col-md-8" id="single_tour_desc">

            

 <div class="container-fluid">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
               <?php
              $i=0;
              $query = $this->db->query("SELECT * from tbleventphotos WHERE eventid='$eventid' order by photoid DESC limit 6");
               foreach ($query->result() as $k) {
                if($i==0){
                ?>
                <div class="item active">
                  <img src="<?php echo base_url();?>assets/eventimages/<?php echo $k->photoname ;?>">
                   <!--<div class="carousel-caption">
                    <h3>Headline</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. <a href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank" class="label label-danger">Bootstrap 3 - Carousel Collection</a></p>
                  </div>-->
                </div><!-- End Item -->
                 <?php 
                    }
                    else
                    {
                        ?>
                        <div class="item">
                  <img src="<?php echo base_url();?>assets/eventimages/<?php echo $k->photoname ;?>">
                   <!--<div class="carousel-caption">
                    <h3>Headline</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. <a href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank" class="label label-danger">Bootstrap 3 - Carousel Collection</a></p>
                  </div>-->
                </div>
                        <?php

                    }
                    $i++;
                }
                 ?>
              </div><!-- End Carousel Inner -->


                <ul class="nav nav-pills nav-justified hidden-xs">
                    <?php
              $i=0;
              $query = $this->db->query("SELECT * from tbleventphotos WHERE eventid='$eventid' order by photoid DESC limit 6");
               foreach ($query->result() as $k) {
                ?>
                  <li data-target="#myCarousel" data-slide-to="<?php echo $i ;?>"><a href="#" class="detialsbar"><img src="<?php echo base_url();?>assets/eventimages/<?php echo $k->photoname ;?>" class="img-thumbnail"></a></li>
                 <?php
                 $i++;
                  } 
                  ?>   
                </ul>


            </div><!-- End Carousel -->
        </div>            <hr>
            
            <div class="row">
                <div class="col-md-3">
                    <h3>Description</h3>
                </div>
                <div class="col-md-9">
                    <h4><?php echo $eventResults->eventname;  ?></h4>
<?php echo $eventResults->description;  ?>

<div class="row">
<!--<div class="col-sm-6 one-half">

            <ul class="list_ok">
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>No scripta electram necessitatibus sit</li>
                    <li>Quidam percipitur instructior an eum</li>
                    <li>Ut est saepe munere ceteros</li>
                    <li>No scripta electram necessitatibus sit</li>
                    <li>Quidam percipitur instructior an eum</li>
            </ul>

</div>


<div class="col-sm-6 one-half">

<ul class="list_ok">
    <li>Lorem ipsum dolor sit amet</li>
    <li>No scripta electram necessitatibus sit</li>
    <li>Quidam percipitur instructior an eum</li>
    <li>No scripta electram necessitatibus sit</li>
</ul>

</div>
-->
</div>  
            </div>
            </div>

<hr>

<!--map starts from here-->
            <div class="row">
                    <div class="col-md-3">
                        <h3>Location</h3>
                    </div>
                    <div class="col-md-9">
                       
                        <div id="map" class="map"></div>

      
                    </div>
                </div>

<!--map ends from here-->


            <hr>


 <div class="row">
                <div class="col-md-3">
                    <h3>Packages</h3>
                </div>
                <div class="col-md-9">

                <?php
                if (count($packages->result())<1) {
                    echo 'No Packages';
                } else {
                    # code...
                
                

                foreach ($packages->result() as $k) {
            ?>
             <div class="strip_all_tour_list wow fadeIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
                      <!--  <div class="wishlist">
                <a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="170">
                    <span class="wishlist-sign">+</span>
                    <span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span>
                </a>
                <a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="170" style="display:none;"><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back">Remove from wishlist</span></span></a>
            </div>-->
                        <div class="img_list">
                <a href="<?php echo $k->packageid;   ?>">
                    <!-- <div class="ribbon popular" ></div> -->
                    <img width="330" height="220" src="<?php echo base_url(); ?>assets/eventimages/<?php echo $photoName; ?>" class="attachment-330x220 wp-post-image" alt="tour_box_1">                   <div class="short_info"><i class="icon_set_1_icon-4"></i><?php //echo $k->eventname;   ?> </div>                </a>
            </div>
        </div>
        <div class="clearfix visible-xs-block"></div>
        <div class="col-lg-5 col-md-5 col-sm-6">
            <div class="tour_list_desc">
             <!--   <div class="rating"><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><i class="icon-smile"></i><small>(0)</small></div>-->
                <h3><?php echo $k->packagename;   ?></h3>
                <p><?php echo $k->description;   ?></p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-2">
            <div class="price_list">
                <div>
                    <span>Rs. <?php echo $k->adultprice;   ?></span><small>(Adult)</small>
                     <span>Rs. <?php echo $k->childprice;   ?></span><small>(Kids)</small>
                     <input type="hidden" id="<?php echo $k->packageid.'adultprice';   ?>" value="<?php echo $k->adultprice;   ?>">
                     <input type="hidden" id="<?php echo $k->packageid.'childprice';   ?>" value="<?php echo $k->childprice;   ?>">
                     <input type="hidden" id="<?php echo $k->packageid.'servicetax';   ?>" value="<?php echo $k->servicetax;   ?>">

                    <p><button onclick="bookthispackage(<?php echo $k->packageid;   ?>)" class="btn_1">Details</a></p>
                </div>
            </div>

        </div>
    </div>
</div>




            <?php
                        }

                        }


                ?>

               



                <!--    <div class=" table-responsive">
                            <table class="table table-striped">
                            <thead>
                            <tr>
                            <th colspan="2">1st March to 31st October</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>Monday</td>
                            <td>10.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Tuesday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Wednesday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Thursday</td>
                            <td><span class="label label-danger">Closed</span></td>
                            </tr>
                            <tr>
                            <td>Friday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Saturday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Sunday</td>
                            <td>10.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td><strong><em>Last Admission</em></strong></td>
                            <td><strong>17.00</strong></td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                            <div class=" table-responsive">
                            <table class="table table-striped">
                            <thead>
                            <tr>
                            <th colspan="2">1st November to 28th February</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>Monday</td>
                            <td>10.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Tuesday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Wednesday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Thursday</td>
                            <td><span class="label label-danger">Closed</span></td>
                            </tr>
                            <tr>
                            <td>Friday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Saturday</td>
                            <td>09.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td>Sunday</td>
                            <td>10.00 - 17.30</td>
                            </tr>
                            <tr>
                            <td><strong><em>Last Admission</em></strong></td>
                            <td><strong>17.00</strong></td>
                            </tr>
                            </tbody>
                            </table>
</div>-->
                </div>
            </div>

            <hr>

            <?php

if ($this->session->userdata('holidayCustomerName')) {
    


            ?>
            
<div class="row">
        <div class="col-md-3">
            <h3>Reviews</h3>
            <a href="#" class="btn_1 add_bottom_15" data-toggle="modal" data-target="#myReview">Leave a review</a>
        </div>
        <div class="col-md-9">
            <div id="general_rating">0 Reviews                          <div class="rating"><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i></div>
            </div>
            <div class="row" id="rating_summary">
                <div class="col-md-6">
                    <ul>
                        <li>Price                                        <div class="rating"><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i></div>
                        </li>
                        <li>Quality                                     <div class="rating"><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i></div>
                        </li>
                                                        </ul>
                </div>
               
            </div><!-- End row -->
            <hr>
            <div class="guest-reviews">
                                        </div>
        </div>
 </div>

<?php
}
?>
                

            
        </div><!--End  single_tour_desc-->

                <aside class="col-md-4" id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                    

                                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 80px; z-index: 100; left: 889.5px;">
                            <div class="box_style_1 expose overone">
            <h3 class="inner" id="bookingscroll">- Booking -</h3>
                        <form method="get" id="booking-form" action="place-your-order-2/" novalidate="novalidate">
                <input type="hidden" name="tour_id" value="213">
                                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Select a date</label>
                            <input class="form-control" id="datepickerj" type="text" name="date">
                            <input type="hidden" value="" id="packageid">
                            <input type="hidden" value="<?php echo $eventResults->vendorid; ?>" id="vendorid">
                        </div>
                    </div>
                </div>
                                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Adults</label>
                            <div class="numbers-row" data-min="0">
                                <input type="text" value="0" id="adults" class="qty2 form-control" name="adults">
                            <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>
                        </div>
                    </div>
                                        <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Children</label>
                            <div class="numbers-row" data-min="0">
                                <input type="text" value="0" id="children" class="qty2 form-control" name="kids">
                            <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>
                        </div>
                    </div>
                                    </div>
                <br>
                <table class="table table_summary">
                <tbody>
                <tr>
                    <td>
                        Adults( Rs. <span class="adultprice">0</span>)                  </td>
                    <td class="text-right adults-number" >
                        <span id="adultprice">0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Children (Rs. <span class="childprice">0</span>)                   </td>
                    <td class="text-right children-number" >
                       <span id="childprice">0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Service Tax                    </td>
                    <td class="text-right" >
                        % <span id="servicetax">0</span> (per ticket)
                    </td>
                </tr>
                                <tr>
                    <td>
                        Total amount                    </td>
                    <td class="text-right">
                        <span class="adults-number" >0</span>x 
                        Rs. <span class="adultprice">0</span>                                                   <span class="child-amount hide"> + <span class="children-number">0</span>x 
                            Rs. <span class="childprice">0</span>  

                        </span> +  Rs. <span class="calculated-servicetax">0</span> (Service Tax)
                                            </td>
                </tr>
                <tr class="total">
                    <td>
                        Total cost                  </td>
                    <td class="text-right">
                        Rs.  <span class="total-cost">0 </span>                 </td>
                </tr>
                </tbody>
                </table>
                <button type="button" class="btn_full book-now">Book now</button>
                            <?php
                            if (!$this->session->userdata('holidayCustomerName')) {

                                ?>

                                 
                                                        <a href="<?php echo site_url().'login'; ?>" class="btn_full_outline">login</a>

                                <?php

                            }
                                           
                        ?>
                                                  
                                                       

                                                                    </form>
                    </div><!--/box_style_1 -->
                                                </div>
                    
        </aside>
    </div><!--End row -->
</div>


<!--review Modal-->

    <div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myReviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <h4 class="modal-title" id="myReviewLabel">Write your review</h4>
            </div>
            <div class="modal-body">
            <?php          
    echo form_open('Frontend/submiteventreview',array('id'=>'review-form','method'=>'post'));
?>

                <input type="hidden" name="eventname" value="<?php echo $eventResults->eventname; ?>">
                <input type="hidden" name="eventid" value="<?php echo $this->uri->segment(3, 0); ?>">
                    
                    <div class="row">
                                                  
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <select class="form-control" name="pricerating" required>
                                        <option value="">Please review</option>
                                        <option value="1">Low</option>
                                        <option value="2">Sufficient</option>
                                        <option value="3">Good</option>
                                        <option value="4">Excellent</option>
                                        <option value="5">Super</option>
                                    </select>
                                </div>
                            </div>
                                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quality</label>
                                    <select class="form-control" name="qualityrating" required>
                                        <option value="">Please review</option>
                                        <option value="1">Low</option>
                                        <option value="2">Sufficient</option>
                                        <option value="3">Good</option>
                                        <option value="4">Excellent</option>
                                        <option value="5">Super</option>
                                    </select>
                                </div>
                            </div>
                                            </div>
                    <!-- End row -->
                    <div class="form-group">
                        <textarea name="reviewtext" id="review_text" class="form-control" style="height:100px;" placeholder="Write your review" required></textarea>
                    </div>
                    <input type="submit" value="Submit" class="btn_1" id="submit-review">
                </form>
                <div id="message-review" class="alert alert-warning">
                </div>
            </div>
        </div>
    </div>
</div>


<!--review Modal-->



  <?php
     include 'footer.php';
      ?>

<div id="toTop"></div><!-- Back to top button -->
<div id="overlay"><i class="icon-spin3 animate-spin"></i></div>

<?php
     include 'scripts.php';
      ?>

      <script>
$ = jQuery.noConflict();
var price_per_person = 0;
var price_per_child = 0;
var exchange_rate = 1;

    price_per_person = 62;
    price_per_child = 10;
    exchange_rate = 1;


//$(document).ready(function(){
 //$('.carousel').carousel({interval: 2000});
    //loadMap();
     $('#datepickerj').datepick({dateFormat: 'yyyy-mm-dd'});

     $('.theiaStickySidebar').hide();
     //document.getElementsByClassName("book-now").disabled = true

    var available_days = [];
    var today = new Date();
    var tour_start_date = new Date( 0 );
    var tour_end_date = new Date( 315328464000000 );
    var available_first_date = tour_end_date

    today.setHours(0, 0, 0, 0);
    tour_start_date.setHours(0, 0, 0, 0);
    tour_end_date.setHours(0, 0, 0, 0);

    if ( today > tour_start_date) {
        tour_start_date = today;
    }

    function DisableDays(date) {
        if ( available_days.length == 0 ) {
            if ( available_first_date >= date && date >= tour_start_date) {
                available_first_date = date;
            }
            return true;
        }
        var day = date.getDay();
        if ( $.inArray( day.toString(), available_days ) >= 0 ) {
            if ( available_first_date >= date && date >= tour_start_date) {
                available_first_date = date;
            }
            return true;
        } else {
            return false;
        }
    }

    if ( $('input.date-pick').length ) {
        $('input.date-pick').datepicker({
            startDate: tour_start_date,
                    endDate: tour_end_date,
                    beforeShowDay: DisableDays
        });
        $('input[name="date"]').datepicker( 'setDate', available_first_date );
    }
    if ( $('input.time-pick').length ) {
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        });
    }
    $('input#adults').on('change', function(){
        $('.adults-number').html( $(this).val() );
        update_tour_price();
    });
    $('input#children').on('change', function(){
        $('.children-number').html( $(this).val() );
        update_tour_price();
    });
    var validation_rules = {};
    if ( $('input.date-pick').length ) {
        validation_rules.date = { required: true};
    }
    //validation form
    $('#booking-form').validate({
        rules: validation_rules
    });
//});

function update_tour_price() {
    var adults = $('input#adults').val();
    var children = 0;
    if ( $('input#children').length ) {
        children = $('input#children').val();
    }


    price_per_person=parseInt($('.adultprice').html());
    
    price_per_child=parseInt($('.childprice').html());
    exchange_rate=parseInt($('#servicetax').html());

    console.log(price_per_person);
    var price = +( (adults * price_per_person + children * price_per_child) ).toFixed(2);
    var calculatedServiceTax = (price *exchange_rate)/100;
    $('.calculated-servicetax').html(calculatedServiceTax);
    $('.child-amount').toggleClass( 'hide', children < 1 );
    var total_price = $('.total-cost').text().replace(/[\d\.\,]+/g, price);
    console.log("calculate service tax is:"+calculatedServiceTax);
    $('.total-cost').text(price+calculatedServiceTax);
}


function showmap()
{
    
    loadMap();
}


function bookthispackage(packageId){

    $('#packageid').val(packageId);
    //reset all values
    $('#adults').val(0);
    $('#children').val(0);
    $('#adults-number').val(0);
    $('#children-number').val(0);
    $('.adults-number').html(0);
    $('.adultprice').html(0);
    $('.children-number').html(0);
    $('.childprice').html(0);
    $('.total-cost').html(0);
    $('.calculated-servicetax').html(0);
   
    //$('#children-number').val(0);
   // $('#children-number').val(0);
    
var adultPriceId = packageId+"adultprice";
var childPriceId = packageId+"childprice";
var serviceTaxId = packageId+"servicetax";

//alert($('#'+serviceTaxId).val());

$('.adultprice').html($('#'+adultPriceId).val());
$('.childprice').html($('#'+childPriceId).val());
$('#servicetax').html($('#'+serviceTaxId).val());

$('html, body').animate({
    scrollTop: 25
    
}, 1000);

$(".over").css("display", "block");
$(".animate-spin").css("display", "none");
$(".overone").css("z-index", '100');

$('.theiaStickySidebar').show();


   

}

$('.book-now').on('click',function(){



    if ($('#datepickerj').datepick('getDate') == "") {
    alert("Please Select a Date");
    //return false;
}else if($('.total-cost').text()==0 || $('.total-cost').text()==''){
    alert("Please book atleast one ticket. Total cannot be zero "+$('.total-cost').text());
}else{

    var d = new Date($('#datepickerj').datepick('getDate'));
    var n = d.toISOString();
    var n = n.split('T');
    //alert("clicked"+n[0]);

    
    
    var EffectiveDate = n[0];
var Today = new Date();
var dd = Today.getDate();
var mm = Today.getMonth() + 1; //January is 0!
var yyyy = Today.getFullYear();
if (dd < 10) {
    dd = '0' + dd
}
if (mm < 10) {
    mm = '0' + mm
}
var Today = yyyy + '-' + mm + '-' + dd;

dateFirst = EffectiveDate.split('-');
dateSecond = Today.split('-');
var value = new Date(dateFirst[2], dateFirst[1], dateFirst[0]);
var current = new Date(dateSecond[2], dateSecond[1], dateSecond[0]);


 if (value < current) {
        alert("Date should not be less than Present Date!");
       // return false;
    }else{

        var packageid = $('#packageid').val();
        var vendorid = $('#vendorid').val();
        var totalcost = $('.total-cost').html();

        var adultpriceperticket = $('.adultprice').html();
        var childpriceperticket = $('.childprice').html();
        var numberofadults = $('.adults-number').html();
        var numberofchildren = $('.children-number').html();
        var servicetax = $('#servicetax').html();

        //alert(numberofadults);

        $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/confirmbookings")?>',
        data: {
            dateofvisit:value,
            packageid:packageid,
            vendorid:vendorid,
            totalcost:totalcost,
            adultpriceperticket:adultpriceperticket,
            childpriceperticket:childpriceperticket,
            numberofadults:numberofadults,
            numberofchildren:numberofchildren,
            servicetax:servicetax

        },
        success: function(res) {

                    if (res.trim()=="true") {
                        window.location.href="<?php echo site_url().'/frontend/confirmevents'; ?>";
                    } else if(res.trim()=="false") {
                         alert("Please login to book tickets");
                         window.location.href="<?php echo site_url().'/frontend/loginForm'; ?>";
                    }else{
                        console.log(res);
                    }        //$('#email').html(res);
        },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                 
                }
        });
       

    

    }

    }
   


});


</script>
       

</body>

</html>
<script type="text/javascript">
    
    loadMap();
</script>
