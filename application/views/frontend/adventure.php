   
    <div class="container margin_60" style="margin-top: 40px;">
    <div class="row">
  

        <div class="col-lg-12 col-md-8">
           

            <?php 

                foreach ($getdata->result() as $k) {
                 //echo $k->place."<br>";
                
                    $placetitleurl = str_replace(" ", "-", $k->place);
            ?>

                             <div class="col-md-3 col-sm-6 places-thumb1 text-center " style="visibility: visible; ">

                    
    <div class="">
        <div class="img_container">
            <a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>">
            <img width="400" height="267" src="<?php  echo base_url().'assets/places/'.$k->photoname;   ?>  ">         <!-- <div class="ribbon top_rated"></div> -->
            <div class="short_info">
                <i class="icon_set_1_icon-4"></i><?php echo $k->place;   ?>               
                <!--<span class="price"><span><sup>Rs. </sup><?php //echo $k->cost;   ?>  </span></span>-->
            </div>
            </a>
        </div>
        <div class="tour_title">
            <!--<h3><a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><?php echo $k->place;   ?>  </a></h3>-->
            <div>
                <?php echo $k->address; ?>
            </div>
            
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
    
    <script type="text/javascript">
    
    $( document ).ready(function() {
       $('#bookplaces').addClass('active');
    });

    </script>


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
