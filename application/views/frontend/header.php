<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="book4holiday">
    <meta name="author" content="Book4Holiday">
    <title>Book4Holiday</title>

    <script src="https://use.fontawesome.com/3ad883fb7d.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/style.css">
  <!--  <script src="<?php echo base_url(); ?>assets/frontend/fontawesome/fonts.js"></script>-->

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/frontend/img/favicon.ico" type="image/x-icon">
   <!-- BASE CSS -->
    <link href="<?php echo base_url(); ?>assets/frontend/css/base.css" rel="stylesheet" type="text/css" media="all" >

  
    <!-- REVOLUTION SLIDER CSS -->
    <link href="<?php echo base_url(); ?>assets/frontend/rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/extralayers.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/slider-pro.min.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/date_time_picker.css" rel="stylesheet" type="text/css" media="all" >
 <link href="<?php echo base_url(); ?>assets/frontend/css/animate.css" rel="stylesheet" type="text/css" media="all" >
  <!--  <link href="<?php echo base_url(); ?>assets/frontend/css/carouselpart.css" rel="stylesheet" type="text/css" media="all" >-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/frontend/js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/frontend/js/theia-sticky-sidebar.js'></script>
    <link href="<?php echo base_url(); ?>assets/frontend/css/detailscarousel.css" rel="stylesheet" type="text/css" media="all" >
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/frontend/js/detailspage.js'></script>

    <script src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyA-hMJfrFKuq7zQy30m0GBdzKSMl9qcxIo"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/css/css/js/jssor.slider.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
	<!-- use jssor.slider.debug.js instead for debug -->
    <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_SlideoTransitions = [
              [{b:5500,d:3000,o:-1,r:240,e:{r:2}}],
              [{b:-1,d:1,o:-1,c:{x:51.0,t:-51.0}},{b:0,d:1000,o:1,c:{x:-51.0,t:51.0},e:{o:7,c:{x:7,t:7}}}],
              [{b:-1,d:1,o:-1,sX:9,sY:9},{b:1000,d:1000,o:1,sX:-9,sY:-9,e:{sX:2,sY:2}}],
              [{b:-1,d:1,o:-1,r:-180,sX:9,sY:9},{b:2000,d:1000,o:1,r:180,sX:-9,sY:-9,e:{r:2,sX:2,sY:2}}],
              [{b:-1,d:1,o:-1},{b:3000,d:2000,y:180,o:1,e:{y:16}}],
              [{b:-1,d:1,o:-1,r:-150},{b:7500,d:1600,o:1,r:150,e:{r:3}}],
              [{b:10000,d:2000,x:-379,e:{x:7}}],
              [{b:10000,d:2000,x:-379,e:{x:7}}],
              [{b:-1,d:1,o:-1,r:288,sX:9,sY:9},{b:9100,d:900,x:-1400,y:-660,o:1,r:-288,sX:-9,sY:-9,e:{r:6}},{b:10000,d:1600,x:-200,o:-1,e:{x:16}}]
            ];
            
            var jssor_1_options = {
              $AutoPlay: true,
              $SlideDuration: 800,
              $SlideEasing: $Jease$.$OutQuint,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>

    <style>
        
        /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        .jssorb05 {
            position: absolute;
        }
        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('<?php echo base_url(); ?>assets/frontend/img/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        */
        .jssora22l, .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('<?php echo base_url(); ?>assets/frontend/img/a22.png') center center no-repeat;
            overflow: hidden;
        }
        .jssora22l { background-position: -10px -31px; }
        .jssora22r { background-position: -70px -31px; }
        .jssora22l:hover { background-position: -130px -31px; }
        .jssora22r:hover { background-position: -190px -31px; }
        .jssora22l.jssora22ldn { background-position: -250px -31px; }
        .jssora22r.jssora22rdn { background-position: -310px -31px; }
    </style>
    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets/frontend/js/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/frontend/js/respond.min.js"></script>
    <![endif]-->


</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <!--<div id="preloader">
<div id="loader">
    <div id="box"></div>
    <div id="hill"></div>
</div>-->
        
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

    <!-- Header================================================== -->
    <header>

        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                     <div id="logo_home">
                        <!--<img src="<?php echo base_url(); ?>assets/frontend/images/logo.jpg" width="160" height="34" alt="City tours" data-retina="true" class="logo_sticky">-->
                        <a href="<?php echo site_url().'home';      ?>">
                            <span class="logo-title">Book4Holiday<span style="font-size:10px;">.com<span></span>
                        </a>
                    </div>
                </div>
                <nav class="col-md-9 col-sm-9 col-xs-9">
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <!--<img src="<?php echo base_url(); ?>assets/frontend/img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">-->
                            <a href="<?php echo site_url().'home';      ?>">
                                <span style="color: Black;font-size: 30px;">Book4Holiday</span>
                           </a>
                    <!--Added mobile view starts-->   
                           <div class="col-xs-12 hidden-lg hidden-md">
                           <div class="col-xs-1"></div>
                           <div class="col-xs-5">
                           <a href="<?php echo site_url().'login'; ?>" class="show-submenu">Sign In</a>
                           </div>
                           <div class="col-xs-5">
                           <a href="<?php echo site_url().'register'; ?>" class="show-submenu">Register</a>
                           </div>
                           <div class="col-xs-1"></div>
                           </div>   
                           <div class="hidden-lg hidden-md">&nbsp;</div>
                    <!--Added mobile view ends-->      
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                        <ul id="menu-menu-1" class="menu">
                            
<?php
if($this->uri->segment(1)=='home' || $this->uri->segment(1)==''){
?>
                           <li style="background:#196bad;" id="li-search-book-toggle">
                                <a href="#" class="show-submenu" style="color:white;" id="search-book-toggle" >Search</a>
                                
  <?php } ?>                          </li>
  <?php
//if($this->uri->segment(1)=='home' || $this->uri->segment(1)==''){
?>
                            <!--<li style="background:#196bad;" id="li-search-book-toggle">
                                <a href="#" class="show-submenu" style="color:white;" id="search-book-toggle" ><i class="fa fa-search"></i></a>
                                
  <?php //} ?>                          </li>-->
							<li>
                                <a href="<?php echo site_url().'home';?>" class="show-submenu">Home </a>
                                
                            </li>
                            <li >
                                <a href="javascript:void(0);" class="show-submenu">Kids Dayout </a>
                                
                            </li>
                            <li >
                                <a href="javascript:void(0);" class="show-submenu">Adventure </a>
                                
                            </li>
                            <li >
                                <a href="javascript:void(0);" class="show-submenu">Day Events </a>
                                
                            </li>
                            <li >
                                <a href="<?php echo site_url().'placesall' ?>" class="show-submenu">Places </a>
                                
                            </li>
                            <li >
                                <a href="<?php echo site_url().'resorts/zoo/1'; ?>" class="show-submenu">Book Zoo Tickets </a>
                                
                            </li>
                            <li>&nbsp;</li>
                            
                            <li>
                                <?php
                                if (!$this->session->userdata('holidayCustomerName')) {
                               ?>
                                <a href="<?php echo site_url().'login'; ?>" class="show-submenu"><i class="fa fa-user" aria-hidden="true"></i> Sign In</a>
                            
                            <li >
                                <a href="<?php echo site_url().'register'; ?>" class="show-submenu"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
                            </li>
                            <?php
         
                            }else{
                                echo ' <li><a href="#"  class="dropdown-toggle show-submenu" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> Welcome '.$this->session->userdata('holidayCustomerName').'</a>
                                
                                    <ul class="dropdown-menu">
                                        <li><a href="'.site_url().'my-account">My Account</a></li>
                                        <li><a href="'.site_url().'my-orders">My Orders</a></li>
                                        <li><a href="'.site_url().'logout'.'">Logout</a></li>
                                    </ul>   
                                </li>';
                                
                            }
                                           
                        ?>
                        </li>
                        </ul>
                    </div><!-- End main-menu -->
                    
                    
                </nav>
            </div>
        </div><!-- container -->
    </header><!-- End Header -->
	