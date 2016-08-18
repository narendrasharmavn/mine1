<?php $last_id=0; ?>
<script type="text/javascript">
      //paste this code under head tag or in a seperate js file.
      // Wait for window load
      $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
      });
    </script>

<div class="row" style="margin-top:20px;">
                  <div class="se-pre-con"></div>  
                    
                </div>

    <!-- content starts here -->
    
   
    
    <div class="container margin_60">
    <div class="row">
        <div class="col-lg-12 col-md-12">
           <!-- <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="styled-select-filters">
                            <select name="sort_price" id="sort_price"  onchange="sortpriceforresorts()">
                                <option value="" selected="">Sort by Price</option>
                                <option value="0-50">0-50</option>
                                <option value="50-100">50-100</option>
                                <option value="100-250">100-250</option>
                                <option value="250-500">250-500</option>
                                <option value="500a">501 and Above</option>
                            </select>
                        </div>
                    </div>
                   
                </div>
            </div>End tools -->
           
           <input type="hidden" id="sessionvalue" name="sessionvalue" value="0">
           
            <div class="tour-list row add-clearfix" id="results">

            <?php 
                    if(count($getdata->result())>0){
                    foreach ($getdata->result() as $k) {
                         $resorttitleurl = str_replace(" ", "-", $k->resortname);
                    $sql = "SELECT  min(adultprice) as minprice from tblpackages WHERE resortid='$k->resortid'";
                   //echo $sql."<br>";


                 $query2 = $this->db->query($sql);
                 $row =$query2->row();
                          ?>
                          
                          <div class="col-md-4 col-sm-4 events-thumb1" style="visibility: visible;">

    <div class="">
        <div class="img_container">
            <a href="<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>" >
            <img  src="<?php  echo base_url().'assets/resortimages/'.$k->bannerimage;   ?>  " style="height:267px;">         <!-- <div class="ribbon top_rated"></div> -->
            
            </a>
        </div>
        <div class="tour_title">
            <a href="<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid;   ?>">
                <h3 ><?php echo $k->resortname;   ?>  </h3>
            </a>
          
        </div>
    </div><!-- End box tour -->
    </div>
<!-- End col-md-6 -->

                          <?php

                          $last_id = $k->resortid;
                    }

                }else{
                    echo '<div class="alert alert-danger" role="alert">No results over your choosen Criteria</div>';
                }

                     ?>

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
        var total_groups = <?php echo $total_data; ?>; 
        var lastid = <?php echo $last_id; ?>
        
        $(window).scroll(function() {       
            if($(window).scrollTop() + $(window).height() == $(document).height())  
            {           
                if(is_loading == false)
                {
                  //  alert(last_id);
                  loading = true; 
                  $('.loader_image').show(); 
                  var price = $('#sort_price').val();
                
                  var lastidone =lastid;

                  var sessionValue = $('#sessionvalue').val();
               
                sessionValue  =+sessionValue+1;
                //alert(sessionValue);
                $('#sessionvalue').val(sessionValue);

                $.ajax({
                type: "POST",
                url: '<?php echo site_url("frontend/sortpriceforresortsAjax")?>',
                data: {
                    
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

    function sortpriceforresorts()
    {
        var price = $('#sort_price').val();
        //alert(price);
        $('#sessionvalue').val(0);

        $.ajax({
        type: "POST",
        url: '<?php echo site_url() ?>/frontend/sortpriceforresorts',
        data: {
           price:price
        },
        success: function(data) {
             //alert("Data: " + data + "\nStatus: " + status);
            console.log(data);
            if(data.trim()!='')
            {
              $('#results').html(data);
              
            }else{
              $('#results').addClass("animated slideInUp"); 
              $('#results').html('<div class="alert alert-danger" role="alert">No results over your choosen filter</div>');
            }
        },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                console.log(xhr.responseText);
             
            }
        });


       
    }


</script>