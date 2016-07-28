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
               
                <div class="col-md-12">
                 <h3>Packages</h3>
                <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
                    <thead>
                    <td>&nbsp;&nbsp;</td>
                    <td>Package Name</td>
                    <td>No.of Adults</td>
                    <td>No.of Kids</td>
                    </thead>
                <?php
                //echo "count is :".count($packages->result());
                if (count($packages->result())==0) {
                    echo 'No Packages';
                } else {
                    # code...
                
                
                     $photoName = "";
                foreach ($packages->result() as $k) {
                    $photoName=$k->packageimage;
                    if($k->kidsmealprice!=0){
                        ?>
                        <input type="hidden" value="<?php echo $k->kidsmealprice; ?>" id="kidsmeal-price" class="qty2 form-control <?php echo 'kidsmeal-price-'.$k->packageid; ?>" >
                 <?php  }
            ?>
                
                
                    <tr>
                    <td class="col-md-2">      
                    
                        <input type="checkbox" style="height:15px;"  value="<?php echo $k->packageid; ?>" id="<?php echo $k->packageid.'checkbox'; ?>" class="qty3 pull-left" onclick="calculateBookings()" name="packagename[]">
                   
                    </td>
                    <td class="col-md-4">
                        
                       
                            <?php echo $k->packagename; ?>
                            <p>Adult Price : <?php echo $k->adultprice; ?></p>
                            <p>Child Price : <?php echo $k->childprice; ?></p>
                            
                              
                        </td>
                        
                    
                    <td class="col-md-3">

                            <div class="numbers-row" data-min="0">
                                <input type="text" value="0" id="adults" onchange="calculateBookings()" class="qty2 form-control <?php echo 'adult-number-'.$k->packageid; ?>" name="adults">
                            <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>

                                
                                <input type="hidden" value="<?php echo $k->adultprice; ?>" id="adults" class="qty2 form-control <?php echo 'adult-cost-'.$k->packageid; ?>" >
                          
                    </td>
                    <td class="col-md-3">

                                <div class="numbers-row" data-min="0">
                                    <input type="text" onchange="calculateBookings()" value="0" id="children" class="qty2 form-control <?php echo 'child-number-'.$k->packageid; ?>" name="kids">
                                <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>
   
                                
                                <input type="hidden" value="<?php echo $k->childprice; ?>" id="adults" class="qty2 form-control <?php echo 'child-cost-'.$k->packageid; ?>" >
                                
                            
                                 <input type="hidden" value="<?php echo $k->servicetax; ?>" id="adults" class="qty2 form-control <?php echo 'servicetax-'.$k->packageid; ?>" >
                         
                    </td>
                    </tr>
                    
                

             

  <?php
                        }

                        }


                ?>

             </table>
			<!-- <input type="button" name="addtocart" onclick="calculateBookings()" class="btn btn-success pull-right" value="Add To Cart"/> -->
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
                                                        
                                                        echo '<li style="background-image: url(http://fornextit.com/book4holiday/assets/widget_star.gif); background-position: 0px -28px;"></li>';
                                                        $i++;
                                                    }

                                                    for ($a=$i; $a < 5; $a++) { 
                                                        echo '<li style="background-image: url(http://fornextit.com/book4holiday/assets/widget_star.gif); background-position: 0px 0px;"></li>';
                                                    }
                                                    
                                                    echo "</ul>";
                                              


                        ?>
                   </div>
            </div>
            
            <hr>
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
                                                        
                                                        echo '<li style="background-image: url(http://fornextit.com/book4holiday/assets/widget_star.gif); background-position: 0px -28px;"></li>';
                                                        $i++;
                                                    }

                                                    for ($a=$i; $a < 5; $a++) { 
                                                        echo '<li style="background-image: url(http://fornextit.com/book4holiday/assets/widget_star.gif); background-position: 0px 0px;"></li>';
                                                    }
                                                    
                                                    echo "</ul>";
                                                ?></div>
							</div>
							<div class="divTableRow">
							<div class="divTableCell">Subject</div>
							<div class="divTableCell">Description</div>
							</div>
							</div>
						</div>
							<!-- DivTable.com -->

                         <?php
                        }
                    }else{
                        echo "No Reviews";
                    }
                    ?>

                    </div>
                   
                </div>
                         
        <!--Reviews End-->
     
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
                            <input class="form-control datepickerj" id="datepickerj" type="text" name="date" required>
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
                        Adults( <span class="adults-number">0</span>)                  </td>
                    <td class="text-right " >
                        Rs. <span class="adult-price"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Children ( <span class="children-number">0</span>)                   </td>
                    <td class="text-right" >
                      Rs. <span class="child-price"></span>
                    </td>
                </tr>
                <tr class="kids">
                    <td>
                        Kids Meal (<span class="kidsmealqty">0</span>)                   </td>
                    <td class="text-right" >
                       Rs. <span id="kidsmealprice">0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Internet & Handling Charges                    </td>
                    <td class="text-right " >
                      Rs.   <span class="internetcharges" id="internetcharges"></span> 
                    </td>
                </tr>
                <tr>
                    <td>
                        Service tax 
                    </td>
                    <td class="text-right" >
                       Rs.  <span id="servicetax">0.14</span> 
                    </td>
                </tr>

                <tr>
                    <td>
                        Swachh Bharath                     </td>
                    <td class="text-right" >
                      Rs.  <span id="swachhcess">0.005</span> 
                    </td>
                </tr>

                <tr>
                    <td>
                        Krishi Kalyan Cess                    </td>
                    <td class="text-right" >
                       Rs.  <span id="krishicess">0.005</span> 
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
                <div id="book-selection-error" style="background-color: rgb(235, 214, 187);color: #9c0000;padding: 10px;margin-bottom:3px;"> Please select a date</div>
                <button type="button" class="btn_full book-now">Proceed</button>
                            
                                                  
                                                       

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

                    <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->servicetax;  ?>" class="service-tax">
                        <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->swachcess;  ?>" class="swachh-cess">
                        <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->krishicess;  ?>" class="krishi-cess">
                        <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->kidsmealtax;  ?>" class="kids-meal-tax">

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

     //$('.theiaStickySidebar').hide();
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

   

   
    $('input#adults').on('change', function(){
        //$('.adults-number').html( $(this).val() );
        //update_tour_price();
    });
    $('input#children').on('change', function(){
        //$('.children-number').html( $(this).val() );
        //update_tour_price();
    });
    $('input#kidsmeal').on('change', function(){
        $('.kidsmeal-number').html( $(this).val() );
        $('.kidsmealqty').text($(this).val());
        //price  $('#kidsmeal-price').val()
        $('#kidsmealprice').text( $(this).val() * $('#kidsmeal-price').val()   );
        //get kids meal tax
        var kidsmealtax = $('.kids-meal-tax').val();
        var calculatedkidmealtax = kidsmealtax * (  $(this).val() * $('#kidsmeal-price').val() )/100;




        //update_tour_price();
        calculateBookings();
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




function showmap()
{
    
    loadMap();
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

        pushToDatabase();
       

    

   

    }
   


});


function pushToDatabase(){
    console.clear();

    var packageId = document.getElementsByName('packagename[]');
    var vals = "";
    var numberofadults = [];
    var packageIdArray = [];
    var numberofchildren = [];
    var childticketprice = [];
    var internethandlingcharges = [];
    var calculate_adult = [];
    var calculate_child = [];
    var sumOfAdultTickets=0;
    var sumOfChildTickets=0;
    var sumOfAdultPrice =0;
    var sumOfChildPrice =0;
    var internetCharges =0;
    for (var i=0, n=packageId.length;i<n;i++) 
    {
        if (packageId[i].checked) 
        {
            var packageid = packageId[i].value;
            var ur = '.'+'adult-number-'+packageid;
            
            numberofadults.push($('.'+'adult-number-'+packageid).val());
            packageIdArray.push(  packageId[i].value );
            numberofchildren.push($('.'+'child-number-'+packageid).val());
            
           

            
            
            console.log(packageId[i].value);
            
        }
    }

    //kids meal qty
    var kidsmealqty = $('#kidsmeal').val();
    var dateofvisit = $('input[name="date"]').val();


    $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/confirmmulticheckoutbookings")?>',
        data: {
            numberofadults: numberofadults,
            numberofchildren: numberofchildren,
            packageIdArray: packageIdArray,
            kidsmealqty: kidsmealqty,
            dateofvisit: dateofvisit
        },
        success: function(res) {
            console.log(res);
            /*

                if (res.trim()=="true") {
                    window.location.href="<?php echo site_url().'confirm-booking-resorts'; ?>";
                } else if(res.trim()=="false") {
                    //alert("Please login to book tickets");
                     window.location.href="<?php echo site_url().'confirm-booking-resorts'; ?>";
                }else{
                    console.log(res);
                }        //$('#email').html(res);
                */
        },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                 
                }
        });


    

    
    
}

$(':radio').change(
  function(){
    $('.choice').text( this.value + ' stars' );
  } 
)


function calculateBookings(){
    console.clear();

    var packageId = document.getElementsByName('packagename[]');
    var vals = "";
    var numberofadults = [];
    var adultticketprice = [];
    var numberofchildren = [];
    var childticketprice = [];
    var internethandlingcharges = [];
    var calculate_adult = [];
    var calculate_child = [];
    var sumOfAdultTickets=0;
    var sumOfChildTickets=0;
    var sumOfAdultPrice =0;
    var sumOfChildPrice =0;
    var internetCharges =0;
    for (var i=0, n=packageId.length;i<n;i++) 
    {
        if (packageId[i].checked) 
        {
            var packageid = packageId[i].value;
            var ur = '.'+'adult-number-'+packageid;
            
            numberofadults.push($('.'+'adult-number-'+packageid).val());
            adultticketprice.push($('.'+'adult-cost-'+packageid).val());
            numberofchildren.push($('.'+'child-number-'+packageid).val());
            childticketprice.push($('.'+'child-cost-'+packageid).val());
            internethandlingcharges.push($('.'+'servicetax-'+packageid).val());

            
            sumOfAdultTickets += + ($('.'+'adult-number-'+packageid).val());
            sumOfChildTickets += + ($('.'+'child-number-'+packageid).val());
            sumOfAdultPrice += + ( $('.'+'adult-number-'+packageid).val() * $('.'+'adult-cost-'+packageid).val() );

            //now calculate internet charges over adult price and adult ticket
            internetCharges += + ( (($('.'+'adult-number-'+packageid).val() * $('.'+'adult-cost-'+packageid).val()) * $('.'+'servicetax-'+packageid).val())/100  );
            //now calculate internet charges over child price and child ticket
            internetCharges += + ( ($('.'+'child-number-'+packageid).val() *  $('.'+'child-cost-'+packageid).val()) * $('.'+'servicetax-'+packageid).val())/100 ;

            //console.log("sum of adult price :"+sumOfAdultPrice);
            sumOfChildPrice += + ( $('.'+'child-number-'+packageid).val() *  $('.'+'child-cost-'+packageid).val() );
            calculate_adult.push( $('.'+'adult-number-'+packageid).val() * $('.'+'adult-cost-'+packageid).val() );

            calculate_child.push( $('.'+'child-number-'+packageid).val() * $('.'+'child-cost-'+packageid).val() );
            console.log(packageId[i].value);
            
        }
    }
    /*
    
    console.log("number of adults for the package "+numberofadults);
    console.log("Price of adults per ticket "+adultticketprice);
    console.log("number of Children for the package "+numberofchildren);
    console.log("Price of Child for the package "+childticketprice);
    
    console.log("Cost charges Adult "+calculate_adult);
    console.log("Cost charges Child "+calculate_child);
    */
    console.log("Internet Handling charges "+internethandlingcharges);
     //get kids meal tax
        var kidsmealtax = $('.kids-meal-tax').val();
        var calculatedkidmealtax = kidsmealtax * (  $('#kidsmeal').val() * $('#kidsmeal-price').val() )/100;
        internetCharges = internetCharges + calculatedkidmealtax;
    console.log("Internet charges "+internetCharges);
    //replace adult tickets and price
    $('.adults-number').text(sumOfAdultTickets);
    $('.adult-price').text(sumOfAdultPrice);
    $('.children-number').text(sumOfChildTickets);
    $('.child-price').text(sumOfChildPrice);
    $('.kidsmealprice').text($('#kidsmeal-price').val());
    $('.internetcharges').text(internetCharges);
    //now get service tax from input hidden variable
    var calculatedservicetax = round(( internetCharges * $('.service-tax').val() )/100,1);
    var calculatedswacchcess = round(( internetCharges * $('.swachh-cess').val() )/100,1);
    var calculatedkrishicess = round(( internetCharges * $('.krishi-cess').val() )/100,1);

    
    $('#servicetax').text(calculatedservicetax);
    $('#swachhcess').text(calculatedswacchcess);
    $('#krishicess').text(calculatedkrishicess);


    //now do total
    var total = 0;
    total += +( parseInt($('.adult-price').text()) + parseInt($('.child-price').text()) + parseInt($('#kidsmealprice').text()) + round( $('.internetcharges').text() ,1 ) + round( $('#servicetax').text(),1 ) + round( $('#swachhcess').text(),1 ) + round( $('#krishicess').text(),1 ) );

    console.log("Total is :"+total);

    $('.total-cost').text(Math.round(total));
    

    
    
}









function round(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}


$('.package-book').on('click',function(){
    //alert("hello");
    
  $('.package-book').removeClass('pbook');
  $(this).addClass('pbook');
  
})

$('.close-modal').on('click', function() {
    
    $('#kidsmealpopup').modal('hide')
});




$('input[name="addtocart"]').on('click', function() {
    
    $('.theiaStickySidebar').show();
});





</script>

</body>

</html>
<script type="text/javascript">
    
    loadMap();
</script>
