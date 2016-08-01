 <style>
            /****** ratingg Starts *****/
          

            fieldset, label { margin: 0; padding: 0; }
           
            

            .ratingg { 
                border: none;
                float: left;
            }

            .ratingg > input { display: none; } 
            .ratingg > label:before { 
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .ratingg > .half:before { 
                content: "\f089";
                position: absolute;
            }

            .ratingg > label { 
                color: #ddd; 
                float: right; 
            }

            .ratingg > input:checked ~ label, 
            .ratingg:not(:checked) > label:hover,  
            .ratingg:not(:checked) > label:hover ~ label { color: #FFD700;  }

            .ratingg > input:checked + label:hover, 
            .ratingg > input:checked ~ label:hover,
            .ratingg > label:hover ~ input:checked ~ label, 
            .ratingg > input:checked ~ label:hover ~ label { color: #FFED85;  }     


            /* Downloaded from http://devzone.co.in/ */
        </style>

        <?php
          $todaysDate = date('Y-m-d');

            $packages = $this->db->query("SELECT * from tblpackages WHERE resortid='$resortid' AND status=1 AND expirydate>='$todaysDate'");

            //echo "SELECT * from tblpackages WHERE resortid='$resortid' AND status=1 AND expirydate>='$todaysDate'";

         

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
          

                addMarker(<?php echo $resortResults->latitude;  ?>, <?php echo $resortResults->longitude;  ?>, '<?php echo $resortResults->resortname;  ?>');
           
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

       
 
        <div class="collapse" id="collapseMap">
           <!-- <div id="mapp" class="map"></div>-->
        </div>
        <div id="toTop"></div>
        
        <div id="overlay" class="over"><i class="icon-spin3 animate-spin"></i></div>
        
 <?php
              $i=0;
           
              $query = $this->db->query("SELECT * from tblresorphotos WHERE resortid='$resortid' order by rphotoid DESC limit 6");
                foreach ($query->result() as $k) {
                if($i==0){
                ?>
                
                  <img src="<?php echo base_url();?>assets/resortimages/<?php echo $k->photoname ;?>" class="img-responsive" style="width:100%;height:370px;">
                   <!--<div class="carousel-caption">
                    <h3>Headline</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. <a href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank" class="label label-danger">Bootstrap 3 - Carousel Collection</a></p>
                  </div>-->
                <!-- End Item -->
                 <?php 
                    }
                }
                ?>
        <div class="container margin_60" style="transform: none;">
    <div class="row" style="transform: none;">
        

              
        <div class="col-md-8 col-sm-8">
                        <h1><?php echo $resortResults->resortname; ?></h1>
                        <span><?php echo $resortResults->location; ?></span>
                        
                    
            <div class="row">
                <div class="col-md-3">
                    <h3>Description</h3>
                </div>
                <div class="col-md-9">
                    <h4><?php echo $resortResults->resortname;  ?></h4>
<?php echo $resortResults->description;  ?>

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
 <div class="row">
                <div class="col-md-3">
                    <h3>Packages</h3>
                </div>
                <div class="col-md-9">

                <?php
                //echo "count is :".count($packages->result());
                if (count($packages->result())==0) {
                    echo 'No Packages';
                } else {
                    # code...
                
                
                     $photoName = "";
                foreach ($packages->result() as $k) {
                    $photoName=$k->packageimage;
            ?>
             <div class="strip_all_tour_list wow fadeIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
                      
                        <div class="img_list">
                <a href="<?php echo $k->packageid;   ?>">
                    
                    <img width="330" height="220" src="<?php echo base_url(); ?>assets/resortimages/<?php echo $photoName; ?>" class="attachment-330x220 wp-post-image" alt="tour_box_1">                   <div class="short_info"><i class="icon_set_1_icon-4"></i><?php //echo $k->resortname;   ?> </div>                </a>
            </div>
        </div>
        <div class="clearfix visible-xs-block"></div>
        <div class="col-lg-5 col-md-5 col-sm-6">
            <div class="tour_list_desc">
             
                <h4><?php echo $k->packagename;   ?></h4>
                <p><?php echo $k->description;   ?></p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-2">
            <div class="price_list">
                <div>
                    <span>Rs. <?php echo $k->adultprice;   ?><small>(Adult)</small></span>
                     <span>Rs. <?php echo $k->childprice;   ?><small>(Kids)</small></span>
                     <input type="hidden" id="<?php echo $k->packageid.'adultprice';   ?>" value="<?php echo $k->adultprice;   ?>">
                     <input type="hidden" id="<?php echo $k->packageid.'childprice';   ?>" value="<?php echo $k->childprice;   ?>">
                     <input type="hidden" id="<?php echo $k->packageid.'servicetax';   ?>" value="<?php echo $k->servicetax;   ?>">
                     <input type="hidden" id="<?php echo $k->packageid.'kidsmealprice';   ?>" value="<?php echo $k->kidsmealprice;   ?>">
                     <input type="hidden" id="currenturl" value="<?php echo $this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/'.$this->uri->segment(3, 0); ?>">

                    <p><button onclick="bookthispackage(<?php echo $k->packageid;   ?>)" class="btn_1 package-book button-clicked-<?php echo $k->packageid;   ?>">Book Now</a></p>
                </div>
            </div>

        </div>
    </div>
</div>

  <?php
                        }

                        }


                ?>

             
                </div>
            </div>
        
<!--map starts from here-->
           

<!--map ends from here-->

            <hr>

            <?php

if ($this->session->userdata('holidayCustomerName')) {
    


            ?>
            
<div class="row">
        <div class="col-md-3">
            <h3>Reviews</h3>
            <?php
            $reviewsquery = $this->db->query("SELECT rr.*,c.name from resortreviews rr LEFT JOIN tblcustomers c ON rr.customerid=c.customer_id WHERE rr.status=1 AND rr.resortname='$resortid' ORDER BY rr.rrid DESC");

            //$result=$reviewsquery->result();
            $reviewsum= $this->db->query("SELECT sum(pricereview) as sumr from resortreviews where resortname='$resortid'");
            foreach($reviewsum->result() as $sum)
            {
                $sum=$sum->sumr;
            }
            $tot=count($reviewsquery->result());
            //echo count($reviewsquery->result());
            $avg=$sum/$tot;
            //echo "Avg=".$avg;

            ?>

            <a href="#" class="btn_1 add_bottom_15" data-toggle="modal" data-target="#myReview">Leave a review</a>
        </div>
        <div class="col-md-9">
            <div id="general_rating"><?php echo $tot; ?> Reviews   
                   <div class="rating">
                        <?php

                        echo "<ul class='codexworld_rating_widget'>";
                        $i=0;
                        //echo "review is: ".$k->pricereview."<br>";
                        for ($j=$avg; $j > 0 ; $j--) { 
                            
                            echo '<li style="background-image: url('.base_url().'assets/widget_star.gif); background-position: 0px -28px;"></li>';
                            $i++;
                        }

                        for ($a=$i; $a < 5; $a++) { 
                            echo '<li style="background-image: url('.base_url().'assets/widget_star.gif); background-position: 0px 0px;"></li>';
                        }
                        
                        echo "</ul>";

                        ?>
                   </div>
            </div>
            
            <div class="guest-reviews">
                                        </div>
        </div>
 </div>

<?php
}
?>
        
        <!--Reviews Start-->
                
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <h3>User Reviews</h3>
                    </div>
                    <div class="col-md-9 col-xs-12">

                    <?php

                        $reviewsquery = $this->db->query("SELECT rr.*,c.name from resortreviews rr LEFT JOIN tblcustomers c ON rr.customerid=c.customer_id WHERE rr.status=1 AND rr.resortname='$resortid' ORDER BY rr.rrid DESC LIMIT 8");


                        if(count($reviewsquery->result())>0){

                        foreach ($reviewsquery->result() as $k) {
                         
                         ?>

                        <div class="divTable">
                            <div class="divTableBody">
                                <div class="divTableRow">
                                <div class="divTableCell"><?php echo $k->name; ?></div>
                                <div class="divTableCell"><?php

                                                    
                                echo "<ul class='codexworld_rating_widget'>";
                                    $i=0;
                                    //echo "review is: ".$k->pricereview."<br>";
                                    for ($j=$k->pricereview; $j > 0 ; $j--) { 
                                        
                                        echo '<li style="background-image: url('.base_url().'assets/widget_star.gif); background-position: 0px -28px;"></li>';
                                        $i++;
                                    }

                                    for ($a=$i; $a < 5; $a++) { 
                                        echo '<li style="background-image: url('.base_url().'assets/widget_star.gif); background-position: 0px 0px;"></li>';
                                    }
                                    
                                    echo "</ul>";
                                ?></div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell"><?php echo $k->subject; ?></div>
                                    <div class="divTableCell"><?php echo $k->review; ?></div>
                                </div>
                            </div>
                        </div> 
                            
                         <?php
                        }
                    }else{
                        echo "No Reviews";
                    }
                    ?>

                    </div>
                   
                </div>
                         
        <!--Reviews End-->
             <hr>
        </div><!--End  single_tour_desc-->
  <div class="col-md-4">
 
                <aside class="col-md-12 aside-panel" id="sidebar">
            
                                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 80px; z-index: 100; left: 889.5px;">
                            <div class="box_style_1 expose overone">
            <h3 class="inner" id="bookingscroll">- Booking -</h3>
                        <form method="get" id="booking-form" action="place-your-order-2/" novalidate="novalidate">
                <input type="hidden" name="tour_id" value="213">
                                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Select a date</label>
                            <input type="hidden" value="" id="packageid">
                            <input type="hidden" value="<?php echo $resortResults->vendorid; ?>" id="vendorid">
                            <input type="hidden" value="" id="buttonclickedname">
                            <input class="form-control datepickerj" id="datepickerj" type="text" name="date" required>
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
                    <div class="row kids">
                        <div class="col-md-6 col-sm-6">
                            <a href="" data-toggle="modal" data-target="#kidsmealpopup">Add Kids Meal</a>
                            
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              
                                
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
                <tr class="kids">
                    <td>
                        Kids Meal (Rs. <span class="kidsmealprice">50</span>)                   </td>
                    <td class="text-right kidsmeal-number" >
                       <span id="kidsmealqty">0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Internet & Handling Charges  
						<span id="internetcharges" style="display:none;"></span>
						</td>
                    <td class="text-right internetcharges" >
					Rs. <span class="calculated-internetcharges">0</span>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        Service tax @ 14%
						<span id="servicetax" style="display:none;"></span>
						</td>
                    <td class="text-right" >
                        
						Rs. <span class="calculated-servicetax">0</span>
                    </td>
                </tr>

                <tr>
                    <td>
                        Swachh Bharath @ 0.5%       
					<span id="internetcharges" style="display:none;">0.05</span>
						</td>
                    <td class="text-right" >
                        
						Rs. <span class="calculated-swachhbharath">0</span>
                    </td>
                </tr>

                <tr>
                    <td>
                       Krishi Kalyan Cess @ 0.5%
					<span id="internetcharges" style="display:none;">0.05</span>
						</td>
                    <td class="text-right" >
                        
						Rs. <span class="calculated-kkcess">0</span>
                    </td>
                </tr>
                        <!--        <tr>
                    <td>
                        Total amount                    </td>
                    <td class="text-right">
                        <span class="adults-number" >0</span>x 
                        Rs. <span class="adultprice">0</span>                                                   
                        <span class="child-amount"> + <span class="children-number">0</span>x 
                            Rs. <span class="childprice">0</span> 


                        </span>


                            +  
                        <span class="kids">
                                <span class="kidsmeal-number">0</span> *  Rs . <span class="kidsmealprice">50</span> 
                             + 
                         </span>
                          Rs. <span class="calculated-internetcharges">0</span> (Internet Charges)
                          +
                          Rs. <span class="calculated-servicetax">0</span> (Service Tax)
                          +
                          Rs. <span class="calculated-swachhbharath">0</span> (Swachh Bharath)
                          +
                          Rs. <span class="calculated-kkcess">0</span> (Krishi Kalyan Cess)
                                            </td>
                </tr>-->
                <tr class="total">
                    <td>
                        Total cost                  </td>
                    <td class="text-right">
                        Rs.  <span class="total-cost">0 </span>                 </td>
                </tr>
                </tbody>
                </table>
                <div id="book-selection-error" style="background-color: rgb(235, 214, 187);color: #9c0000;padding: 10px;margin-bottom:3px;"> Please select a date</div>
                <button type="button" class="btn_1 btn_full book-now">Proceed</button>
                            
                                                  
                                                       

                                                                    </form>
                    </div><!--/box_style_1 -->
                                                </div>
                                                <div class="row">
                <div class="col-md-12">
                <hr>
                <h3>Location</h3>
                    <div id="map" class="map"></div>
                </div>

            </div>           
        </aside>
         
    </div><!--End row -->
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
    echo form_open('Frontend/submitresortreview',array('id'=>'review-form','method'=>'post'));
?>

                <input type="hidden" name="resortname" value="<?php echo $resortResults->resortname; ?>">
                <input type="hidden" name="resortid" value="<?php echo $this->uri->segment(3, 0); ?>">
                    
                    <div class="row">

                        
                                                  
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label style="float: left;margin-top:4px;">Rate Us</label>
                                    <fieldset id='demo1' class="ratingg">
                                <input class="stars" type="radio" id="star5" name="pricerating" value="5" />
                                <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <input class="stars" type="radio" id="star4" name="pricerating" value="4" />
                                <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input class="stars" type="radio" id="star3" name="pricerating" value="3" />
                                <label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input class="stars" type="radio" id="star2" name="pricerating" value="2" />
                                <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input class="stars" type="radio" id="star1" name="pricerating" value="1" />
                                <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                            </fieldset>
                                </div>
                            </div>
                 </div>
                    <!-- End row -->
                    <div class="form-group">
                    <label>Subject</label>
                        <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter Subject">
                    </div>
                    <div class="form-group">
                    <label>Comments</label>
                        <textarea name="reviewtext" id="review_text" class="form-control" class="form-control" style="height:100px;" placeholder="Write your Comments" required></textarea>
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

<!-- set up the modal to start hidden and fade in and out -->
<div id="kidsmealpopup" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <img src="<?php echo base_url().'assets/frontend/img/BK-Kids-Meal.jpg'; ?>" class="img-responsive">
            </div>
            <div class="col-md-6 col-sm-6">
                            
            <div class="form-group">
                    <label>Add Kid Meal Rs.<span class="kidsmealprice">50<span> per Kid</label>
                    <div class="numbers-row" data-min="0">
                        <input type="text" value="0" id="kidsmeal" class="qty2 form-control" name="kids">
                    <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>
                </div>
            </div>
            
        </div>
      </div>
      <!-- dialog buttons -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary close-modal">OK</button>
        
      </div>
    </div>
  </div>
</div>


<!-- Modal Pop up ends here -->

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
     $( ".datepickerj" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});

     $('.theiaStickySidebar').hide();
     //document.getElementsByClassName("book-now").disabled = true
     $('#book-selection-error').hide();
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
    $('input#kidsmeal').on('change', function(){
        $('.kidsmeal-number').html( $(this).val() );
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
    var kidsmealqty = $('input#kidsmeal').val();
    var children = 0;
    if ( $('input#children').length ) {
        children = $('input#children').val();
    }


    price_per_person=parseInt($('.adultprice').html());
    price_per_child=parseInt($('.childprice').html());
    kids_meal_price=parseInt($('.kidsmealprice').html());
    var internetcharges=$('#internetcharges').html();
    
    var service_tax = 14;
    var swachhbharath = 0.5;
    var kkcess = 0.5;
    
    

    //var kidsmealtotal = kidsmealqty*kids_meal_price;
    var price =0;
    price = +( (adults * price_per_person + children * price_per_child +  kidsmealqty*kids_meal_price) );
    price = Math.ceil(price);
    console.log("price is: "+price);

    var calculatedinternetcharges = round((price * internetcharges ),1);
    console.log("calculated internet charges are : "+calculatedinternetcharges);
    $('.calculated-internetcharges').html(calculatedinternetcharges);


    var calculatedservicetax = (service_tax * calculatedinternetcharges)/100;
    //alert(calculatedservicetax);
    //calculate Swachh Bharath tax based on internet handling charges
    var calculatedswachhbharath = (swachhbharath * calculatedinternetcharges)/100;
    console.log("calculated Swachh Bharath are : "+calculatedswachhbharath);
    //alert(calculatedswachhbharath);
    //calculate Krish Kalyan Cess based on internet handling charges
    var calculatedkkcess = (kkcess * calculatedinternetcharges)/100;
    console.log("calculated Krish Kalyan Cess are : "+calculatedkkcess);
    //alert(calculatedkkcess);

    console.log("calculated service tax over internet charges are : "+calculatedservicetax);
    console.log("calculated Swachh Bharath tax over internet charges are : "+calculatedswachhbharath);
    console.log("calculated Krish Kalyan Cess tax over internet charges are : "+calculatedkkcess);
    $('.calculated-servicetax').html(calculatedservicetax.toFixed(2));
    $('.calculated-swachhbharath').html(calculatedswachhbharath.toFixed(2));
    $('.calculated-kkcess').html(calculatedkkcess.toFixed(2));

    $('.child-amount').toggleClass( 'hide', children < 1 );
    var total_price = $('.total-cost').text().replace(/[\d\.\,]+/g, price);
    var total_calculated_cost = price+calculatedservicetax+calculatedinternetcharges+calculatedswachhbharath+calculatedkkcess;
    $('.total-cost').text(Math.ceil(total_calculated_cost));
    console.log("calculated totalcost"+Math.ceil(total_calculated_cost));
}


function showmap()
{
    
    loadMap();
}


function bookthispackage(packageId){

    if($('#buttonclickedname').val()==''){
        //add class to this button
    $('.button-clicked-'+packageId).addClass('not-active');
    $('#buttonclickedname').val('.button-clicked-'+packageId);
    }else{
        var btn = $('#buttonclickedname').val();
        $(btn).removeClass('not-active');
        $('.button-clicked-'+packageId).addClass('not-active');
        $('#buttonclickedname').val('.button-clicked-'+packageId);
    }

    

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
    $('.calculated-internetcharges').html(0);
   
    //$('#children-number').val(0);
   // $('#children-number').val(0);
    
var adultPriceId = packageId+"adultprice";
var childPriceId = packageId+"childprice";
var serviceTaxId = packageId+"servicetax";
var kmp = packageId+"kidsmealprice";
var kidsmealprice = $('#'+kmp).val();

//alert($('#'+serviceTaxId).val());

$('.adultprice').html($('#'+adultPriceId).val());
$('.childprice').html($('#'+childPriceId).val());
var internetcharges = $('#'+serviceTaxId).val();
internetcharges = internetcharges/100;
$('#internetcharges').html(internetcharges);

$('.kidsmealprice').html(kidsmealprice);

if (kidsmealprice>0) {
    $(".kids").show();
}else{
    $(".kids").hide();
}

$('html, body').animate({
    scrollTop: 500
    
}, 1000);


$(".over").css("display", "block");
$(".animate-spin").css("display", "none");
$(".overone").css("z-index", '100');

$('.theiaStickySidebar').show();

 

}

$('.book-now').on('click',function(){



    if ($('#datepickerj').val() == "") {
        $('#book-selection-error').show();
    //alert("Please Select a Date");
    $('#book-selection-error').html('Please select a date');
}else if($('.total-cost').text()==0 || $('.total-cost').text()==''){
    //alert("Please book atleast one ticket. Total cannot be zero "+$('.total-cost').text());
    $('#book-selection-error').show();
    //alert("Please Select a Date");
    $('#book-selection-error').html('Please book atleast one ticket. Total cannot be zero');
}else{

        var packageid = $('#packageid').val();
        var vendorid = $('#vendorid').val();
        var totalcost = $('.total-cost').html();

        var adultpriceperticket = $('.adultprice').html();
        var childpriceperticket = $('.childprice').html();
        var numberofadults = $('.adults-number').html();
        var numberofchildren = $('.children-number').html();
        var calculated_service_tax = $('.calculated-servicetax').html();
        var calculated_internet_charges = $('.calculated-internetcharges').html();
        var kidsmealqty = $("#kidsmeal").val();
        var dateofvisit = $('#datepickerj').val();
        var currenturl = $('#currenturl').val();
        //alert(numberofadults);

        $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/confirmbookings")?>',
        data: {
            dateofvisit: dateofvisit,
            packageid:packageid,
            vendorid:vendorid,
            totalcost:totalcost,
            adultpriceperticket:adultpriceperticket,
            childpriceperticket:childpriceperticket,
            numberofadults:numberofadults,
            numberofchildren:numberofchildren,
            calculatedservicetax:calculated_service_tax,
            calculatedinternetcharges:calculated_internet_charges,
            kidsmealqty:kidsmealqty,
            currenturl:currenturl

        },
        success: function(res) {

                if (res.trim()=="true") {
                    window.location.href="<?php echo site_url().'confirm-booking-resorts'; ?>";
                } else if(res.trim()=="false") {
                    //alert("Please login to book tickets");
                     window.location.href="<?php echo site_url().'confirm-booking-resorts'; ?>";
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
   


});

$(':radio').change(
  function(){
    $('.choice').text( this.value + ' stars' );
  } 
)


$('.package-book').on('click',function(){
    //alert("hello");
    
  $('.package-book').removeClass('pbook');
  $(this).addClass('pbook');
  
})

$('.close-modal').on('click', function() {
    
    $('#kidsmealpopup').modal('hide')
});


function round(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}

</script>

</body>

</html>
<script type="text/javascript">
    
    loadMap();
</script>
