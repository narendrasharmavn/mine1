
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    <title>Book4Holiday</title>

    <script src="https://use.fontawesome.com/3ad883fb7d.js"></script>


  <!--  <script src="<?php echo base_url(); ?>assets/frontend/fontawesome/fonts.js"></script>-->

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/frontend/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="<?php echo base_url(); ?>assets/frontend/css/base.css" rel="stylesheet" type="text/css" media="all" >

    <!-- Google web fonts -->
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <!-- REVOLUTION SLIDER CSS -->
    <link href="<?php echo base_url(); ?>assets/frontend/rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/extralayers.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/slider-pro.min.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/date_time_picker.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/animate.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>assets/frontend/css/carouselpart.css" rel="stylesheet" type="text/css" media="all" >
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/frontend/js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/frontend/js/theia-sticky-sidebar.js'></script>
    <link href="<?php echo base_url(); ?>assets/frontend/css/detailscarousel.css" rel="stylesheet" type="text/css" media="all" >
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/frontend/js/detailspage.js'></script>

    <script src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyA-hMJfrFKuq7zQy30m0GBdzKSMl9qcxIo"></script>

    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets/frontend/js/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/frontend/js/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
    
 .my{
    display: block !important;
    font-size: 13px;
    color: gray;
    padding-bottom: 5px;

    }
</style>

</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
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
                            <span class="logo-title">Book4Holiday</span>
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
                           <div class="col-xs-12 hidden-lg hidden-md"">
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
                            <li>
                              
                            </li>

                        </ul>
                    </div><!-- End main-menu -->
                    <ul id="top_tools">
                        <li>
                            <div class="dropdown dropdown-search  hidden-xs">
                              <ul id="top_links">
                        <?php
                            if (!$this->session->userdata('holidayCustomerName')) {

                                ?>

                                <li>
                                <div class="dropdown dropdown-access">
                                    <a href="<?php echo site_url().'login'; ?>" class="dropdown-toggle" id="access_link">Sign in</a>
                                    <!-- End Dropdown access -->
                            </li>
                            
                           <li><a href="<?php echo site_url().'register'; ?>">Register</a></li>

                                <?php

                            }else{
                                echo ' <li><a href="#"  class="dropdown-toggle" data-toggle="dropdown" id="access_link">Welcome '.$this->session->userdata('holidayCustomerName').'</a>
                                
                                    <div class="dropdown-menu">
                                        
                                        <div class="login-or">
                                            <ul class="my-account-ul">
                                            <a href="'.site_url().'my-account"><li class="my my-account-ul-li">My Account</li></a>
                                            <a href="'.site_url().'my-orders"><li class="my my-account-ul-li">My Orders</li></a>
                                            <a href="'.site_url().'logout'.'"><li class="my my-account-ul-li" >Logout</li></a>
                                            </ul>
                                        </div>
                                        
                                       
                                       
                                       
                                    </div>
                                </div>

                                </li>';
                                
                            }
                                           
                        ?>

                        </ul>    
                                </div>
                            </div>
                        </li>
                        <!--
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" icon-basket-1"></i>Cart (0) </a>
                                <ul class="dropdown-menu" id="cart_items">
                                    <li>
                                        <div class="image"><img src="<?php echo base_url(); ?>assets/frontend/images/slides/1.jpg" alt="Image"></div>
                                        <strong>
                                        <a href="#">Louvre museum</a>1x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div class="image"><img src="<?php echo base_url(); ?>assets/frontend/images/slides/2.jpg" alt="Image"></div>
                                        <strong>
                                        <a href="#">Versailles tour</a>2x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div class="image"><img src="<?php echo base_url(); ?>assets/frontend/images/slides/3.jpg" alt="Image"></div>
                                        <strong>
                                        <a href="#">Versailles tour</a>1x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div>Total: <span>$120.00</span></div>
                                        <a href="cart.html" class="button_drop">Go to cart</a>
                                        <a href="payment.html" class="button_drop outline">Check out</a>
                                    </li>
                                </ul>
                            </div>--><!-- End dropdown-cart-->
                        </li>
                    </ul>
                </nav>
            </div>
        </div><!-- container -->
    </header><!-- End Header -->