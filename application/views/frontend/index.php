<?php
    $query = $this->db->query("SELECT * FROM tblsliders WHERE status=1");
?>
<style>

@media (min-width:300px) and (max-width:1280px) {
  .barsearchm { display:none; } 
  .carousel { margin-top: 5px !important; }          /* style.css - 2120 / add customedia css */
  .margin_61 { background-color:#FFFFFF !important; }      /* add customedia css */
  
  .events-thumb { margin-left: 15px !important;
                  min-width: 325px !important;
                 min-height: 0px !important; }

  .places-thumb { margin-left: 40px !important;
                  min-width: 225px !important;
                 min-height: 0px !important; }                       /* add customedia css */
          /* add customedia css */
  #social_footer p { text-align: center !important; }      /* add customedia css */
  #login { margin: 60px 0 20px !important; }         /* add customedia css / style.css - 1944 */
}
</style>


        <!-- Slider -->
    <div class="container">
<div class="featured-overlay hidden-sm hidden-xs">
                                <a id="close-form" href="#" class="button close open-close-btn"><i class="icon_close_alt2"></i></a>
                                
                               <div class="featured-overlay-inner">
                                       <?php echo $this->session->flashdata('error-msg'); ?>
                                                <?php  

                                                    echo form_open('search-results',array('id'=>'searchform','method'=>'post','role' => 'search','class' => 'searchform'));
                                                ?>   
                                        <div class="search-field">
                                        
                                            <div class="destination-field">
                                             <div class="row">
                                             
                                       
                       
                        <input type="hidden" name="post_type" value="tour">
                         
                                             <div class="col-md-12">
                                                    <div class="form-group">
                                                        
                                                        <select class="form-control search-form-slider searchtype" id="searchtype" name="searchtype" required>
                                                            <option value="" selected="">Search For</option>
                                                            <option value="resortname" <?php echo  set_select('searchtype', 'resortname'); ?>>Resort Name</option>
                                                           <option value="eventname" <?php echo  set_select('searchtype', 'eventname'); ?>>Event Name</option>
                                                           <option value="places" <?php echo  set_select('searchtype', 'places'); ?>>Places</option>
                                                           
                                                         </select>
                                                         <span class="text-danger searchtypeerror"><?php echo form_error('searchtype'); ?></span>
                                                        </div>
                                                </div>
												<div class="col-md-12 datefield" style="display:none;">
													<div class="form-group">
														
														<input class="form-control search-form-slider1 datepickerj" type="text" name="date" id="date" placeholder="Select date">
														<span class="text-danger datepickerjerror"><?php echo form_error('date'); ?></span>
													</div>
												</div>
                                                <div class="col-md-12">
<div class="form-group">
      <!-- /btn-group -->
     <input type="text" class="form-control search-form-slider1" style="height:35px;font-size:14px;" name="searchterm" id="searchterm" placeholder="Resorts, Events or Places " value="<?php echo set_value('searchterm'); ?>" autocomplete="off" required>
                                    
    </div><!-- /input-group -->
<span class="text-danger searchtermerror" style="color:#ebd6bb;"><?php echo form_error('searchterm'); ?></span>
                                    <span class="search-results-autofill"></span>
                               
                            </div>
                            
                            <div class="col-md-12 col-sm-3 col-xs-6">
                                <div class="form-group">
                                   
                                
                                    <button type="submit" class="btn_1 green searchnowbutton"><i class="icon-search"></i>Search now</button>
                                </div>
                            </div>
                                                </div>
                                                
                                            </div>
                                        </div>                                            
                                         
                                    </form><!-- /form.location-search -->

                                </div><!-- /.featured-overlay-inner -->
                            </div>
                            </div>
      <!-- ForNext Slider -->
      <div id="jssor_1" class="jssor_1">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
        <?php
            $i=0;
            foreach ($query->result() as $k) {
                
                    ?>
			
            <div data-p="225.00" style="display: none;">
			<a href="<?php echo $k->link; ?>">
                <img data-u="image" src="<?php echo base_url(); ?>assets/sliderimages/<?php echo $k->image; ?>" />
                <!--<div class="slider-title"><?php echo $k->title; ?></div>
                <div class="slider-cap1"><?php echo $k->subtitle; ?></div>-->
              
                </a>
            </div>
			
            <?php } ?>
            <a data-u="ad" href="#" style="display:none"></a>
        
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>
    <script>
        jssor_1_slider_init();
    </script>
    

       
<div class="banner colored hidden-lg hidden-md">
<div class="container">

                                        <?php echo $this->session->flashdata('error-msg'); ?>
                                                <?php  

    echo form_open('search-resultss',array('id'=>'searchform2','method'=>'post','role' => 'search','class' => 'searchform2'));
                                            ?>
                       
                        <input type="hidden" name="post_type" value="tour">
                        <div class="main_title">
                             <h2 style="color:white;">Search 4 Holiday</h2>
                            
                        </div>
                       
                        <div class="row">
                           <input type="hidden" name="post_type" value="tour">
                         
                                             <div class="col-md-12">
                                                    <div class="form-group">
                                                        
                                                        <select class="form-control search-form-slider searchtype" id="searchtype1" name="searchtype2" required>
                                                            <option value="" selected="">Search For</option>
                                                            <option value="resortname" <?php echo  set_select('searchtype', 'resortname'); ?>>Resort Name</option>
                                                           <option value="eventname" <?php echo  set_select('searchtype', 'eventname'); ?>>Event Name</option>
                                                           <option value="places" <?php echo  set_select('searchtype', 'places'); ?>>Places</option>
                                                           
                                                         </select>
                                                         <span class="text-danger searchtypeerror"><?php echo form_error('searchtype'); ?></span>
                                                        </div>
                                                </div>
												<div class="col-md-12 datefield" style="display:none;">
													<div class="form-group">
														
														<input class="form-control search-form-slider datepickerj" type="text" name="date2" id="date1" placeholder="Select date">
														<span class="text-danger datepickerjerror"><?php echo form_error('date'); ?></span>
													</div>
												</div>
                                                <div class="col-md-12">
<div class="form-group">
      <!-- /btn-group -->
     <input type="text" class="form-control search-form-slider2" style="height:35px;font-size:14px;" name="searchterm2" id="searchterm" placeholder="Resorts, Events or Places " value="<?php echo set_value('searchterm'); ?>" autocomplete="off" required>
                                    
    </div><!-- /input-group -->
<span class="text-danger searchtermerror" style="color:#ebd6bb;"><?php echo form_error('searchterm'); ?></span>
                                    <span class="search-results-autofill"></span>
                               
                            </div>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                   
                                
                                    <button type="submit" class="btn_1 green searchnowbutton"><i class="icon-search"></i>Search now</button>
                                </div>
                            </div>
                                                </div>
                                                
                                            </div>
                                        </div>                                            
                                         
                                    </form><!-- /form.location-search -->
                            
                            
            </div>
                        </div><!-- End row -->
            </div>
            <div class="container margin_60">
<?php

if (count($events->result())>0) {
  ?>

    
    
        <div class="main_title">
            <h2 class="bar_title"><span>Latest Events</span></h2> 
        </div>

        
        
        <div class="row">

        <?php
            foreach ($events->result() as $k) {
                                             // echo $k->eventid."<br>";
                $eventtitleurl = str_replace(" ", "-", $k->eventname);

                                              ?>
<div class="col-md-3 col-sm-6 text-center events-thumb">
                <div class="">
                    <div class="img_container">
                       <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> ">
                       <img src="<?php echo base_url().'assets/eventimages/'.$k->bannerimage; ?>" alt="Image" style="min-height:200px;" class="img-responsive">
                       <div class="short_info">
                            <?php echo $k->eventname; ?>
		       </div>
                       </a>
                    </div>
                    <div class="tour_title">
                        <!--<h3 class="eventtitle">
                            <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?> "> 
                           
                            
                                <?php echo $k->eventname; ?>
                                
                          
                            </a>
							
                        </h3>-->
						 <p class="eventdate">

                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">From : <?php

                                echo date("d-m-Y", strtotime($k->fromdate)); 
                                         //echo ;

                                          ?></a> 
                                        &nbsp;
                                        &nbsp;
                                        <a href="<?php echo site_url().'eventdetails/'.$eventtitleurl.'/'.$k->eventid;   ?>" style="color:black;">To : <?php
                                        echo date("d-m-Y", strtotime($k->todate)); 
                                         //echo $k->fromdate;
                                          ?></a>
                                    </p> 
						<!--<p style="padding: 5px;"><?php
						
						//echo substr($k->description,0,100); ?></p>-->
                      
                    </div>
                </div><!-- End box tour -->
            </div><!-- End col-md-4 -->


                                              <?php
                    }

        ?>
        
                 
        </div><!-- End row -->
        <p class="text-center add_bottom_30">
            <a href="<?php echo site_url().'eventsall' ?>" class="btn_1 green medium"><i class="icon-eye-7"></i>View all Events  </a>
        </p>
        
       

         <?php

           # code...
}

?>

<!-- View All Resorts -->
<?php 
$resorts = $this->db->query("SELECT * FROM tblresorts WHERE status=1 ORDER BY resortid desc limit 4");
if (count($resorts->result())>0) {
?>
<div class="main_title">
    <h2 class="bar_title"><span>Featured Resorts</span></h2>
</div>
<div class="row">
    <?php 
                        
      foreach ($resorts->result() as $k) {
         $resortid = $k->resortid;
         $resortname = $k->resortname;
         //echo $placename."<br>";
         $rdescription = $k->description;
         //echo $pdescription."<br>";
         $photoname = $k->bannerimage;
         //echo $photoname."<br>";
         $resorttitleurl = str_replace(" ", "-", $k->resortname);

    ?>
    <div class="col-md-3 col-sm-6 text-center places-thumb">
        <div class="img_container">
            <p>
                <a href="<?php echo site_url().'resorts/'.$resorttitleurl.'/'.$k->resortid; ?>">
                <img src="<?php echo base_url(); ?>/assets/resortimages/<?php echo $photoname; ?>" alt="Pic" width="800" height="450" style="height: 200px;" class="img-responsive">
            </p>
            <div class="short_info">
                <?php echo $resortname; ?>
            </div></a>
        </div>
        <p style="padding: 5px;">
            <?php echo substr($rdescription,0,100)."...."; ?>
        </p>
    </div>
<?php } ?>
</div>


    <p class="text-center add_bottom_30">
        <a href="<?php echo site_url().'resortsall' ?>" class="btn_1 green medium"><i class="icon-eye-7"></i>View all Resorts  </a>
    </p>
<?php } ?>
<!-- View All Resorts -->

<?php
$query = $this->db->query("SELECT * FROM tblplaces WHERE status=1 ORDER BY plid desc limit 4");

if (count($query->result())>0) {
    



?>
    
    
            <div class="main_title">
                <h2 class="bar_title"><span>Popular Places in Hyderabad</span></h2>
                
            </div>

            <div class="row">
                <?php 
                    
                    foreach ($query->result() as $k) {
                       $plid = $k->plid;
                       $placename = $k->place;
                       //echo $placename."<br>";
                       $pdescription = $k->description;
                       //echo $pdescription."<br>";
                       $getplacepic = $this->db->query("SELECT * FROM tblplacesphotos WHERE plid='$plid'");
                       $rows = $getplacepic->row(); 
                       $photoname = $rows->photoname;
                       //echo $photoname."<br>";
                       $placetitleurl = str_replace(" ", "-", $k->place);
                    
                ?>
                <div class="col-md-3 col-sm-6 text-center places-thumb">
				 <div class="img_container">
                    <p>
                        <a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>">
						<img src="<?php echo base_url(); ?>/assets/places/<?php echo $photoname; ?>" alt="Pic" width="800" height="450" style="height: 200px;" class="img-responsive">
                  </p>
				   <div class="short_info">
                            <?php echo $placename; ?>
		       </div></a>
			   </div>
                  <!--<div class="place_title">
                    <h3><a href="<?php echo site_url().'places/'.$placetitleurl.'/'.$k->plid; ?>"><?php echo $placename; ?></a></h3>
</div>                -->   
                   <p style="padding: 5px;">
                        <?php echo substr($pdescription,0,100)."...."; ?>
                    </p>
                </div>
                
                <?php } ?>
            </div><!-- End row -->

            <p class="text-center add_bottom_30">
            <a href="<?php echo site_url().'placesall' ?>" class="btn_1 green medium"><i class="icon-eye-7"></i>View all Places  </a>
        </p>

           
            
            
        </div><!-- End container -->
    </div><!-- End white_bg -->
   
    
    
    <?php
}
     include 'footer.php';
      ?>

<div id="toTop"></div><!-- Back to top button -->

<?php
     include 'scripts.php';
      ?>

<script type="text/javascript">

function myFunctionFocusOut(){
    $('.search-results-autofill').html('');
}



$('document').ready(function(){

    $(".indexmyhome").hide();
    $(".indexmyhome").css('display','-webkit-inline-box');

   $( ".datepickerj" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});

    var searchType = $('.searchtype').val();
    if (searchType=="eventname") {
        $('.datefield').show();
    } else {
        $('.datefield').hide();    
    }



});


 $( ".search-form-slider1" ).autocomplete({
      source:function(request, response) {
        
        $.ajax({
            type: "POST",
            url: '<?php echo site_url("frontend/autofillsearch/")?>',
            data: {
                searchtype : $('#searchtype').val(),
                searchdate : $('#date').val() ,
                searchterm : $('input[name="searchterm"]').val()
            },
            success: function(data) {
                console.log("jquery ajax autocomplete test "+data);
                response(JSON.parse(data));
            }
        });
    },
      min_length: 3
    });


    $( ".search-form-slider2" ).autocomplete({
      source:function(request, response) {
        
        $.ajax({
            type: "POST",
            url: '<?php echo site_url("frontend/autofillsearch/")?>',
            data: {
                searchtype : $('#searchtype1').val(),
                searchdate : $('#date1').val() ,
                searchterm : $('.search-form-slider2').val()
            },
            success: function(data) {
                console.log("jquery ajax autocomplete test "+data);
                response(JSON.parse(data));
            }
        });
    },
      min_length: 3
    });



$('.searchtype').on('change',function(){
    //alert(this.value);
    $('.searchtermerror').text('');
    if (this.value=="eventname") {
        $('.datefield').show();
        $('.datefield').css('display','block');
        
    } else {
        $('.datefield').hide();
        $('.datefield').css('display','none');
        
    }

});

$("#search-book-toggle").click(function(){
    $(".featured-overlay").toggle();
	
	//$("#li-search-book-toggle").css("background-color":"#ebd6bb");
});



$("#searchform").validate({
      //by default the error elements is a <label>
     
    
        // Specify the validation rules
        rules: {
           searchtype: {
                required: true
            },
            date:{
                required: function () {
                    return $(".searchtype").val() =="eventname";
                }
            },
            searchterm: {
                required: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            searchtype: {
                required: "Please select the search type"
            },
            date:{
                required:"Please choose a date"
            },
            searchterm: {
                required: "Please type a letter or word in searchterm"
            }
        },
        
        
        submitHandler: function(form) {
              //alert("all correct");
              form.submit();
               // 
          }
        
    });

//searchform2


$("#searchform2").validate({
      //by default the error elements is a <label>
     
    
        // Specify the validation rules
        rules: {
           searchtype2: {
                required: true
            },
            date2:{
                required: function () {
                    return $("#searchtype1").val() =="eventname";
                }
            },
            searchterm2: {
                required: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            searchtype2: {
                required: "Please select the search type"
            },
            date2:{
                required:"Please choose a date"
            },
            searchterm2: {
                required: "Please type a letter or word in searchterm"
            }
        },
        
        
        submitHandler: function(form) {
              //alert("all correct");
              form.submit();
               // 
          }
        
    });


/*
$(window).scroll(function() {

    if ($(this).scrollTop()>3)
     {
        $('.featured-overlay').fadeOut(500);
     }
    else
     {
      $('.featured-overlay').fadeIn(500);
     }
 });
*/


</script>

        </body>

</html>