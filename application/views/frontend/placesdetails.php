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

    $placeid = $this->uri->segment(3, 0); 
    $getplacename = $this->db->query("SELECT * FROM tblplaces WHERE plid='$placeid'");
    $row = $getplacename->row(); 
    $place = $row->place;

    $photoName = "";

    $query2 = $this->db->query("SELECT * from tblplacesphotos WHERE plid='$placeid'");

    foreach ($query2->result() as $k) {
          $photoName=$k->photoname;
    }


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
          

                addMarker(<?php echo $row->latitude; ?>, <?php echo $row->longitude; ?>, '<?php echo $row->place; ?>');
           
            center = bounds.getCenter();
            map.fitBounds(bounds);
            map.setOptions({ minZoom: 5, maxZoom: 13 });
        }
 </script>
  <script>
            $('#sidebar').theiaStickySidebar({
                additionalMarginTop: 80
            });
        </script>

       


     
    <section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url(); ?>assets/places/<?php echo $photoName; ?>" data-natural-width="1400" data-natural-height="500">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h1><?php echo $row->place ;?></h1>
                        <span><?php echo $row->address ;?></span>
                           </div>
                    
                </div>
            </div>
        </div>
    </section>


        <div class="collapse" id="collapseMap">
            <!--<div id="map" class="map"></div>-->
        </div>
        <div id="toTop"></div>
        
        <div id="overlay"><i class="icon-spin3 animate-spin"></i></div>
        <div class="container margin_60" style="transform: none;">
    <div class="row" style="transform: none;">
        <div class="col-md-8" id="single_tour_desc">
         
          <div class="container-fluid">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
               <?php
              $i=0;
              $query = $this->db->query("SELECT * from tblplacesphotos WHERE plid='$placeid' order by pphotoid DESC limit 6");
               foreach ($query->result() as $k) {
                if($i==0){
                ?>
                <div class="item active">
                  <img src="<?php echo base_url();?>assets/places/<?php echo $k->photoname ;?>">
               
                </div><!-- End Item -->
                 <?php 
                    }
                    else
                    {
                        ?>
                        <div class="item">
                  <img src="<?php echo base_url();?>assets/places/<?php echo $k->photoname ;?>">
                   
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
              $query = $this->db->query("SELECT * from tblplacesphotos WHERE plid='$placeid' order by pphotoid DESC limit 6");
               foreach ($query->result() as $k) {
                ?>
                  <li data-target="#myCarousel" data-slide-to="<?php echo $i ;?>"><a href="#" class="detialsbar"><img src="<?php echo base_url();?>assets/places/<?php echo $k->photoname ;?>" class="img-thumbnail"></a></li>
                 <?php
                 $i++;
                  } 
                  ?>   
                </ul>


            </div><!-- End Carousel -->
         
                   
                            

</div>               <hr>
            
            <div class="row">
                <div class="col-md-3">
                    <h3>Description</h3>
                </div>
                <div class="col-md-9">
                    <p>
                <?php echo $row->description; ?>
</p>
              </div>
            </div>

            <hr>
                        <div class="row">
                <div class="col-md-3">
                    <h3>Other Information</h3>
                </div>
                <div class="col-md-9">
                    <div class=" table-responsive">
<?php echo $row->otherinfo; ?>
</div>

                </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-9">
                       
                        <div id="map" class="map"></div>

      
                    </div>
                </div>


                <hr>

         
            
<div class="row reviews">
        <div class="col-md-3">
            <h3>User Reviews</h3>

               <?php

if ($this->session->userdata('holidayCustomerName')) {
    


            ?>
           
            <a href="#" class="btn_1 add_bottom_15" data-toggle="modal" data-target="#myReview">Leave a review</a>

            <?php
}
?>
			<br/>
        </div>
        <div class="col-md-9 col-xs-12">

                    <?php

                        $reviewsquery = $this->db->query("SELECT er.*,c.name from placereviews er LEFT JOIN tblcustomers c ON er.customerid=c.customer_id WHERE er.placeid='$placeid' ORDER BY er.prid DESC LIMIT 5");
                        //echo "SELECT er.*,c.name from eventreviews er LEFT JOIN tblcustomers c ON er.customerid=c.customer_id WHERE er.status=1 AND er.resortoreventname='$eventid' ORDER BY er.rid DESC LIMIT 4";

                        if(count($reviewsquery->result())>0){

                        foreach ($reviewsquery->result() as $k) {
                         
                         ?>

                        <div class="row-fluid"> 
      <div class="col-sm-12">
          <div class="panel panel-success">
          <div class="panel-heading">
            <span itemscope itemtype="http://schema.org/Review">
            <h3 class="panel-title" itemprop="name"><?php echo $k->subject; ?></h3>
          </div><!--/panel-heading-->
          <div class="panel-body" itemprop="reviewBody">
            <div class="col-sm-6">
			<?php echo $k->review; ?>

           
            <p> 
<span itemprop="author" itemscope itemtype="http://schema.org/Person">
              <span itemprop="name">--<strong> <?php echo $k->name; ?></strong></span>
            </span><!--/author schema -->
</br>

			<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>

              <meta itemprop="datePublished" content="01-01-2016"><?php
               
               $reviewgivendate = date("d-m-Y", strtotime($k->reviewgivendate));
               echo $reviewgivendate;

                ?>
              </p>
			  </div>
			  <div class="col-sm-6">
              <span class="pull-left">
              
              <?php

                                                    
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
                                ?>
            
          </div>
          </div><!--/panel-body-->
         
        </div><!--/panel-->
      </div><!--/col-sm-6-->
    
  </div><!--/row (1) -->    
                         
                        <?php
                        }
                    }else{
                        echo "<h3 style='color:red;'>No Reviews</h3>";
                    }
                    ?>

                    </div>
 </div>


        </div><!--End  single_tour_desc-->



                <aside class="col-md-4" id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                   

                                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 80px; z-index: 100; left: 889.5px;">
                            <div class="box_style_1 expose">
                                <h4>Other Places in Hyderabad</h4>
                    
                <?php 
                    $query = $this->db->query("SELECT * FROM tblplaces where plid!='".$row->plid."'");
                    foreach ($query->result() as $k) {
                       $placename = $k->place;
                       $plid = $k->plid;
                       //echo $placename."<br>";
                       $pdescription = $k->description;
                       //echo $pdescription."<br>";
                       $getplacepic = $this->db->query("SELECT * FROM tblplacesphotos WHERE plid='$plid'");
                       $rows = $getplacepic->row(); 
                       $photoname = $rows->photoname;
                       //echo $photoname."<br>";
                       $placetitleurl = str_replace(" ", "-", $k->place);
                    
                ?>
                <div class="row">
                <div class="col-md-12 col-sm-6 text-center">
                    <p>
                        <a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><img src="<?php echo base_url(); ?>/assets/places/<?php echo $photoname; ?>" alt="Pic" width="800" height="450" style="min-height: 200px;" class="img-responsive"></a>
                  </p>
                    <h4><a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><?php echo $placename; ?></a></h4>
                   
                </div>
                </div>
                <?php } ?>
            
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
    echo form_open('Frontend/submitplacereview',array('id'=>'review-form','method'=>'post'));
?>

            <input type="hidden" name="placename" value="<?php echo $row->place; ?>">
                <input type="hidden" name="placeid" value="<?php echo $this->uri->segment(3, 0); ?>">
                    
                    
                    <div class="row">

                        
                                                  
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label style="float: left;">Rate Us</label>
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
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject" required>
                    </div>
<div class="form-group">
                    <label>Comments</label>
                        <textarea name="reviewtext" id="review_text" class="form-control" style="height:100px;" placeholder="Write your review" required></textarea>
                    </div>
                    <input type="submit" value="Submit" class="btn_1" id="submit-review" >
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
    $('.child-amount').toggleClass( 'hide', children < 1 );
    var total_price = $('.total-cost').text().replace(/[\d\.\,]+/g, price);
    console.log(total_price);
    $('.total-cost').text( total_price );
}


function showmap()
{
    
    loadMap();
}


function bookthispackage(packageId){
    
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


//window.location.hash = '#bookingscroll';


   

}


</script>
       

</body>

</html>
<script type="text/javascript">
    
    loadMap();
</script>
