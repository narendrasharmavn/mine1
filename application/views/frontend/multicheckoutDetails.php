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
            map.setOptions({ minZoom: 5, maxZoom: 11 });
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
           
              $query = $this->db->query("SELECT * from tblresorts WHERE resortid='$resortid'");
                foreach ($query->result() as $k) {
                if($i==0){
                ?>
                
                  <img src="<?php echo base_url();?>assets/resortimages/<?php echo $k->bannerimage ;?>" class="img-responsive" style="width:100%;height:370px;">
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
                    <p>
<?php echo $resortResults->description;  ?>
</p>

<div class="row">
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
					$vvendorid = $this->db->get_where('tblpackages' , array('resortid' => $resortResults->resortid ))->row()->vendorid;
					$vkidsmealprice = $this->db->get_where('tblvendors' , array('vendorid' => $vvendorid ))->row()->kidsmealprice;
					?>
					 <input type="hidden" value="<?php echo $vkidsmealprice; ?>" id="kidsmeal-price" class="qty2 form-control <?php echo 'kidsmeal-price-'.$vkidsmealprice; ?>" >               
			   <?php
			    if (count($packages->result())==0) {
                    echo '<h3 style="color:red;">No Packages</h3>';
                } else {
                    # code...
                
                
                     $photoName = "";
                foreach ($packages->result() as $k) {
                    $photoName=$k->packageimage;
                    if($k->kidsmealprice!=0){
                        ?>
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

                            <div class="numbers-row <?php echo 'incdec-'.$k->packageid; ?>" data-min="0">
                                <input type="text" value="0" id="adults" onchange="calculateBookings()" class="qty2 form-control <?php echo 'adult-number-'.$k->packageid; ?>" name="adults">
                            <div class="inc button_inc <?php echo 'plus-'.$k->packageid; ?>">+</div>
                            <div class="dec button_inc <?php echo 'minus-'.$k->packageid; ?>">-</div></div>

                                
                                <input type="hidden" value="<?php echo $k->adultprice; ?>" id="adults" class="form-control <?php echo 'adult-cost-'.$k->packageid; ?>" >
                          
                    </td>
                    <td class="col-md-3">

                                <div class="numbers-row <?php echo 'incdec-'.$k->packageid; ?>" data-min="0">
                                    <input type="text" onchange="calculateBookings()" value="0" id="children" class="qty2 form-control <?php echo 'child-number-'.$k->packageid; ?>" name="kids">
                                <div class="inc button_inc <?php echo 'plus-'.$k->packageid; ?>">+</div>
                                <div class="dec button_inc <?php echo 'minus-'.$k->packageid; ?>">-</div></div>
   
                                
                                <input type="hidden" value="<?php echo $k->childprice; ?>" id="adults" class="form-control <?php echo 'child-cost-'.$k->packageid; ?>" >
                                
                            
                                 <input type="hidden" value="<?php echo $k->servicetax; ?>" id="adults" class="form-control <?php echo 'servicetax-'.$k->packageid; ?>" >
                         
                    </td>
                    </tr>
                    
                

             

  <?php
                        }

                        }


                ?>

             </table>
                </div>
            </div>
        
<!--map starts from here-->
           

<!--map ends from here-->

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

        </div>
       <div class="col-md-9 col-xs-12">

                    <?php

                        $reviewsquery = $this->db->query("SELECT rr.*,c.name from resortreviews rr LEFT JOIN tblcustomers c ON rr.customerid=c.customer_id WHERE rr.status=1 AND rr.resortname='$resortid' ORDER BY rr.rrid DESC LIMIT 5");


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
                                        
                                        echo '<li style="background-image: url('.base_url().'assets/widget_star.gif); background-position: 0px -28px;cursor:default;"></li>';
                                        $i++;
                                    }

                                    for ($a=$i; $a < 5; $a++) { 
                                        echo '<li style="background-image: url('.base_url().'assets/widget_star.gif); background-position: 0px 0px;cursor:default;"></li>';
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


        
        <!--Reviews Start-->
                
              
                         
        <!--Reviews End-->
     
        </div><!--End  single_tour_desc-->
  <div class="col-md-4">
 
                <aside class="col-md-12 aside-panel" id="sidebar">
            
                                      <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 80px; z-index: 100; left: 889.5px;">
                            <div class="box_style_1" style="display:none;">
            <h3 class="inner" id="bookingscroll">- Booking -</h3>
                        <form method="get" id="booking-form" action="place-your-order-2/" novalidate="novalidate">
                <input type="hidden" name="tour_id" value="213">
                                <div class="row">
                    <div class="col-md-10 col-sm-6">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Select a date</label>
                            <input type="hidden" value="" id="packageid">
                            <input type="hidden" value="<?php echo $resortResults->vendorid; ?>" id="vendorid">
                            <div class="inner-addon right-addon">
                              <i class="glyphicon fa fa-calendar"></i>
                              <input type="text" class="form-control datepickerj" id="datepickerj" readonly="readonly" placeholder="Pick a Date" style="cursor:default;" />
                            </div>
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
                        <i class="fa fa-inr"></i> <span class="adult-price">0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Children ( <span class="children-number">0</span>)                   </td>
                    <td class="text-right" >
                      <i class="fa fa-inr"></i> <span class="child-price">0</span>
                    </td>
                </tr>
                <tr class="kids">
                    <td>
                        Kids Meal (<span class="kidsmealqty">0</span>)                   </td>
                    <td class="text-right" >
                       <i class="fa fa-inr"></i> <span id="kidsmealprice">0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Internet&Handling Charges                    </td>
                    <td class="text-right " >
                      <i class="fa fa-inr"></i>   <span class="internetcharges" id="internetcharges">0</span> 
                    </td>
                </tr>
                <tr>
                    <td>
                        Service tax @ 14%
                    </td>
                    <td class="text-right" >
                       <i class="fa fa-inr"></i>  <span id="servicetax">0</span> 
                    </td>
                </tr>

                <tr>
                    <td>
                       Swachh Bharath @ 0.5%                     </td>
                    <td class="text-right" >
                      <i class="fa fa-inr"></i>  <span id="swachhcess">0</span> 
                    </td>
                </tr>

                <tr>
                    <td>
                        Krishi Kalyan Cess @ 0.5%                   </td>
                    <td class="text-right" >
                       <i class="fa fa-inr"></i>  <span id="krishicess">0</span> 
                    </td>
                </tr>
                               
                <tr class="total">
                    <td>
                        Total cost                  </td>
                    <td class="text-right">
                        <i class="fa fa-inr"></i>  <span class="total-cost">0 </span>                 </td>
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
                 <?php if($resortResults->latitude) { ;?><h3>Location</h3><?php } ?>
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
    echo form_open('Frontend/submitresortreviewmulticheckout',array('id'=>'review-form','method'=>'post'));
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
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject" required>
                    </div>
                    <div class="form-group">
                    <label>Comments</label>
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
                    <label>Add Kid Meal <i class="fa fa-inr"></i><span class="kidsmealprice">50<span> per Kid</label>
                    <div class="numbers-row" data-min="0">
                        <input type="text" value="0" id="kidsmeal" class="qty2 form-control" name="kids">
                    <div class="inc button_inc">+</div><div class="dec button_inc">-</div></div>

                    <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->servicetax;  ?>" class="service-tax">
                        <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->swachcess;  ?>" class="swachh-cess">
                        <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->krishicess;  ?>" class="krishi-cess">
                        <input type="hidden" value="<?php echo $this->db->get_where('taxmaster' , array('taxid' =>1))->row()->kidsmealtax;  ?>" class="kids-meal-tax">
                         <input type="hidden" id="currenturl" value="<?php echo $this->uri->segment(1, 0).'/'.$this->uri->segment(2, 0).'/'.$this->uri->segment(3, 0); ?>">

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
     $('.datepickerj').datepicker('setDate', null);

     var packageId = document.getElementsByName('packagename[]');

for (var i=0, n=packageId.length;i<n;i++) 
    {
         packageId[i].checked=false;
            var packageid = packageId[i].value;
            var ur = '.'+'adult-number-'+packageid;
            
            $('.'+'adult-number-'+packageid).val(0);
           
            $('.'+'child-number-'+packageid).val(0);
        
    }
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
        //update_tour_price();
    });
    $('input#children').on('change', function(){
        //update_tour_price();
    });
    $('input#kidsmeal').on('change', function(){
        $('.kidsmeal-number').html( $(this).val() );
        $('.kidsmealqty').text($(this).val());
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
    $('#book-selection-error').html('Please select a date');
}else if($('.total-cost').text()==0 || $('.total-cost').text()==''){
    $('#book-selection-error').show();
    $('#book-selection-error').html('Total cannot be zero');
   
}else if ($('.adults-number').text()==0 && $('.children-number').text()==0){
    $('#book-selection-error').show();
    $('#book-selection-error').html('Please book atleast one ticket.');
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
    var dateofvisit = $('#datepickerj').val();
    //alert(dateofvisit);
    var currenturl = $('#currenturl').val();
    var vendorid = $('#vendorid').val();
    $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/confirmmulticheckoutbookings")?>',
        data: {
            numberofadults: numberofadults,
            numberofchildren: numberofchildren,
            packageIdArray: packageIdArray,
            kidsmealqty: kidsmealqty,
            dateofvisit: dateofvisit,
            currenturl:currenturl,
            vendorid:vendorid
        },
        success: function(res) {
            console.log(res);
           

                if (res.trim()=="true") {
                    window.location.href="<?php echo site_url().'confirm-booking-multicheckout'; ?>";
                }
                
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
    //console.clear();


     $('.box_style_1').css('display','block');

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
        var packageid = packageId[i].value;
        if (packageId[i].checked) 
        {
            //remove class not-active 
            $('.incdec-'+packageid).removeClass('not-active');

            
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
            
        }else{
            $('.incdec-'+packageid).addClass('not-active');
            //change input of adult and child box to zero
            $('.adult-number-'+packageid).val(0);
            $('.child-number-'+packageid).val(0);
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
        internetCharges = round( internetCharges,2 );
    console.log("Internet charges "+internetCharges);
    //replace adult tickets and price
    sumOfAdultPrice = round(sumOfAdultPrice,2);
    sumOfChildPrice = round(sumOfChildPrice,2);

    $('.adults-number').text(sumOfAdultTickets);
    $('.adult-price').text(sumOfAdultPrice);
    $('.children-number').text(sumOfChildTickets);
    $('.child-price').text(sumOfChildPrice);
    $('.kidsmealprice').text($('#kidsmeal-price').val());
    $('.internetcharges').text(internetCharges);
    //now get service tax from input hidden variable
    var calculatedservicetax = round(( internetCharges * $('.service-tax').val() )/100,2);
    var calculatedswacchcess = rounds(( internetCharges * $('.swachh-cess').val() )/100,2);
    var calculatedkrishicess = rounds(( internetCharges * $('.krishi-cess').val() )/100,2);

    
    $('#servicetax').text(calculatedservicetax);
    $('#swachhcess').text(calculatedswacchcess);
    $('#krishicess').text(calculatedkrishicess);

    var aprice = parseInt($('.adult-price').text());
    var cprice = parseInt($('.child-price').text());
    var kmprice = parseInt($('#kidsmealprice').text());
    kmprice = round(kmprice,2);
    $('#kidsmealprice').text(kmprice);
    var ic = round( $('.internetcharges').text() ,2 );

    //now do total
    var total = 0;
    total = (+aprice + +cprice  + +kmprice + +ic + +calculatedservicetax + +calculatedswacchcess + +calculatedkrishicess );
    //alert("a price  si: : "+aprice);
    //alert("c price charges  si: : "+cprice);
    //alert("kmp price charges  si: : "+kmprice);
    //alert("ic charges  si: : "+ic);

    //alert("calculatedservicetax charges  si: : "+calculatedservicetax);
    //alert("calculatedswacchcess charges  si: : "+calculatedswacchcess);
    //alert("calculatedkrishicess charges  si: : "+calculatedkrishicess);

    total = round(total,2);
    //alert("total is: "+round(total,2));

    console.log("Total is :"+total);

    $('.total-cost').text(total);
    

    
    
}


function round(value, decimals) {
   var val = parseFloat(value);
    var num = val.toFixed(2);
    return num;
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


 $("document").ready(function(){
        //alert("hello");
        console.clear();
        $('input[name="kids"]').val(0);

    var packageId = document.getElementsByName('packagename[]');

        for (var i=0, n=packageId.length;i<n;i++) 
        {
            if (packageId[i].checked) 
            {
                //remove class not-active 

                var packageid = packageId[i].value;
                $('.incdec-'+packageid).removeClass('not-active');
                
                console.log(packageId[i].value);
                
            }else{
                var packageid = packageId[i].value;
                $('.incdec-'+packageid).addClass('not-active');
            }
        }




    });



function rounds(value, decimals) {
   //return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
    return (Number(Math.round(value+'e'+decimals)+'e-'+decimals)).toFixed(decimals);
  // return (+(Math.round(+(num + 'e' + precision)) + 'e' + -precision)).toFixed(precision);
}




</script>

</body>

</html>
<script type="text/javascript">
    
    loadMap();
</script>
