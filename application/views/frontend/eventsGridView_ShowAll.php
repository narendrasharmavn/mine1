
<script type="text/javascript">
      //paste this code under head tag or in a seperate js file.
      // Wait for window load
      $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
      });
    </script>

<div class="row">
                  <div class="se-pre-con"></div>  
                    <div class="col-md-12">
                       
                    </div>
</div>

    <div class="container margin_60">
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                            <select name="sort_date" id="sort_date"  onchange="showAllEventsDatePrice()">
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
                            <select name="sort_price" id="sort_price"  onchange="showAllEventsDatePrice()">
                                <option value="" selected="">Sort by Price</option>
                                <option value="0-100">0-100</option>
                                <option value="100-500">100-500</option>
                                <option value="500-1000">500-1000</option>
                                <option value="1000-5000">1000-5000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 hidden-xs text-right">
                             </div>
                </div>
            </div><!--End tools -->
            
            <input type="hidden" id="sessionvalue" name="sessionvalue" value="0">
            <div class="tour-list row add-clearfix" id="results">
               
            <?php 

                    foreach ($getdata->result() as $k) {
                          //echo $k->eventname."<br>";
                         $eventtitleurl = str_replace(" ", "-", $k->eventname);
                    $sql = "SELECT  min(adultprice) as minprice from tblpackages WHERE eventid='$k->eventid'";
                   //echo $sql."<br>";


                 $query2 = $this->db->query($sql);
                 $row =$query2->row();
             ?>
                          
        <div class="col-md-4 col-sm-4 events-thumb1 text-center " style="visibility: visible; ">

    
                  
                            <div class="">
                                <div class="img_container">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                    <img width="400" height="267" src="<?php  echo base_url().'assets/eventimages/'.$k->bannerimage;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
                                    <div class="short_info">
                                         
                                        <span class="price"><span><sup>Rs.</sup><?php echo $row->minprice;   ?></span></span>
                                                      
                                    </div>
                                    </a>
                                </div>
                                <div class="tour_title">
                                    <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                                        <h3 class="eventtitle"><?php echo $k->eventname;   ?>  </h3>
                                    </a>
                                    <p class="eventdate">

                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php
                                            echo date("d-m-Y", strtotime($k->fromdate)); 
                                         //echo $k->todate; 

                                         ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php echo date("d-m-Y", strtotime($k->todate)); ?></a>
                                    </p>                  
                                </div>
                            </div><!-- End box tour -->
    
        </div><!-- End col-md-6 -->


                          <?php

                          $last_id = $k->eventid;
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



$(document).ready(function() {
        var totalrecord = 0;
        
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
        url: '<?php echo site_url("frontend/sortpricedateforeventsallAjax")?>',
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
        });



                }
            }
        });
    });

  //  loadMap();


    function showAllEventsDatePrice()
    {
       var price = $('#sort_price').val();
       //alert(price);
       $('#sessionvalue').val(0);
       var date = $('#sort_date').val();
       //alert(date);

       $.ajax({
        type: "POST",
        url: '<?php echo site_url("frontend/showalleventsdateprice")?>',
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
               $('#results').html('<div class="alert alert-danger" role="alert">No results found on that price</div>');
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


</script>