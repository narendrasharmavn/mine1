
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


  <!--  <script src="<?php echo base_url(); ?>/assets/frontend/fontawesome/fonts.js"></script>-->

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/frontend/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo base_url(); ?>/assets/frontend/img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="<?php echo base_url(); ?>/assets/frontend/css/base.css" rel="stylesheet" type="text/css" media="all" >

    <!-- Google web fonts -->
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <!-- REVOLUTION SLIDER CSS -->
    <link href="<?php echo base_url(); ?>/assets/frontend/rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/extralayers.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/slider-pro.min.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/date_time_picker.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/animate.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo base_url(); ?>/assets/frontend/css/carouselpart.css" rel="stylesheet" type="text/css" media="all" >
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>/assets/frontend/js/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>/assets/frontend/js/theia-sticky-sidebar.js'></script>
    <link href="<?php echo base_url(); ?>/assets/frontend/css/detailscarousel.css" rel="stylesheet" type="text/css" media="all" >
    <script type='text/javascript' src='<?php echo base_url(); ?>/assets/frontend/js/detailspage.js'></script>



    
      <script src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyA-hMJfrFKuq7zQy30m0GBdzKSMl9qcxIo"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/frontend/style.css">
    


    <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>/assets/frontend/js/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>/assets/frontend/js/respond.min.js"></script>
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
        <div id="top_line">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                    <i class="icon-facebook"></i>
                    <i class="icon-twitter"></i>
                    <i class="icon-google"></i>
                    
                    <strong>Help Line : <i class="icon-phone"></i>+91 1231313131</strong></div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-6">
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
                                            <ul>
                                            <a href="'.site_url().'my-account"><li class="my">My Account</li></a>
                                            <a href="'.site_url().'my-orders"><li class="my">My Orders</li></a>
                                            <a href="'.site_url().'logout'.'"><li class="my" >Logout</li></a>
                                            </ul>
                                        </div>
                                        
                                       
                                       
                                       
                                    </div>
                                </div>

                                </li>';
                                
                            }
                                           
                        ?>

                       
                            



                        </ul>
                    </div>
                </div><!-- End row -->
            </div><!-- End container-->
        </div><!-- End top line-->
        
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                     <div id="logo_home">
                    	<!--<img src="<?php echo base_url(); ?>/assets/frontend/images/logo.jpg" width="160" height="34" alt="City tours" data-retina="true" class="logo_sticky">-->
                        <a href="<?php echo site_url().'home';      ?>">
                            <span style="color: white;font-size: 30px;">Book4Holiday</span>
                        </a>
                    </div>
                </div>
                <nav class="col-md-9 col-sm-9 col-xs-9" style="text-align:right;">
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <!--<img src="<?php echo base_url(); ?>/assets/frontend/img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">-->
                            <a href="<?php echo site_url().'home';      ?>">
                                <span style="color: Black;font-size: 30px;">Book4Holiday</span>
                           </a>
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                        <ul id="menu-menu-1" class="menu">
                            <li >
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
                                <a href="<?php echo site_url().'places' ?>" class="show-submenu">Places </a>
                                
                            </li>
                            <li >
                                <a href="<?php echo site_url().'resorts/zoo/1'; ?>" class="show-submenu">Book Zoo Tickets </a>
                                
                            </li>

                            
                            
                           
                             <!-- 
                            
                              <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu">Restaurants <i class="icon-down-open-mini"></i></a>
                                <ul>
                                    <li><a href="all_restaurants_list.html">All restaurants list</a></li>
                                    <li><a href="all_restaurants_grid.html">All restaurants grid</a></li>
                                    <li><a href="single_restaurant.html">Single restaurant page</a></li>
                                    <li><a href="payment_restaurant.html">Booking restaurant</a></li>
                                    <li><a href="confirmation_transfer.html">Confirmation transfers</a></li>
                                </ul>
                            </li>
                            <li class="megamenu submenu">
                                <a href="javascript:void(0);" class="show-submenu-mega">Pages<i class="icon-down-open-mini"></i></a>
                                <div class="menu-wrapper">
                                    <div class="col-md-4">
                                        <h3>Pages</h3>
                                        <ul>
                                            <li><a href="about.html">About us</a></li>
                                           <li><a href="general_page.html">General page</a></li>
                                            <li><a href="tourist_guide.html">Tourist guide</a></li>
                                             <li><a href="wishlist.html">Wishlist page</a></li>
                                             <li><a href="faq.html">Faq</a></li>
                                             <li><a href="faq_2.html">Faq smooth scroll</a></li>
                                             <li><a href="pricing_tables.html">Pricing tables</a></li>
                                             <li><a href="gallery_3_columns.html">Gallery 3 columns</a></li>
                                            <li><a href="gallery_4_columns.html">Gallery 4 columns</a></li>
                                            <li><a href="grid_gallery_1.html">Grid gallery</a></li>
                                            <li><a href="grid_gallery_2.html">Grid gallery with filters</a></li>
                                            <li><a href="shortcodes.html">Shortcodes</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Pages</h3>
                                        <ul>
                                            <li><a href="contact_us_1.html">Contact us 1</a></li>
                                            <li><a href="contact_us_2.html">Contact us 2</a></li>
                                             <li><a href="blog_right_sidebar.html">Blog</a></li>
                                            <li><a href="blog.html">Blog left sidebar</a></li>
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="register.html">Register</a></li>
                                            <li><a href="invoice.html" target="_blank">Invoice</a></li>
                                            <li><a href="404.html">404 Error page</a></li>
                                            <li><a href="site_launch/index.html">Site launch / Coming soon</a></li>
                                            <li><a href="timeline.html">Tour timeline</a></li>
                                            <li><a href="page_with_map.html">Full screen map</a></li>
                                            <li><a href="admin.html">Admin area</a></li>
                                            <li><a href="rtl_version/index.html">RTL version</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Elements</h3>
                                        <ul>
                                            <li><a href="index.html"><i class="icon-columns"></i> Header transparent</a></li>
                                            <li><a href="header_plain.html"><i class="icon-columns"></i> Header plain</a></li>
                                            <li><a href="header_transparent_colored.html"><i class="icon-columns"></i> Header transparent colored</a></li>
                                            <li><a href="footer_2.html"><i class="icon-columns"></i> Footer with working newsletter</a></li>
                                            <li><a href="icon_pack_1.html"><i class="icon-inbox-alt"></i> Icon pack 1 (1900)</a></li>
                                            <li><a href="icon_pack_2.html"><i class="icon-inbox-alt"></i> Icon pack 2 (100)</a></li>
                                            <li><a href="icon_pack_3.html"><i class="icon-inbox-alt"></i> Icon pack 3 (30)</a></li>   
                                            <li><a href="newsletter_template/newsletter.html" target="blank"><i class=" icon-mail"></i> Responsive email template</a></li>  
                                            <li><a href="general_page.html"><i class="icon-light-up"></i>  Weather Forecast</a></li>     
                                            <li><a href="#0"><i class="icon-circle color_1"></i> Color version 1</a></li>                                    
                                            <li><a href="color_2/index.html"><i class="icon-circle color_2"></i> Color version 2</a></li>
                                            <li><a href="color_3/index.html"><i class="icon-circle color_3"></i> Color version 3</a></li>
                                           	<li><a href="color_4/index.html"><i class="icon-circle color_4"></i> Color version 4</a></li>                                          
                                        </ul>
                                    </div>
                                </div>   <!--End menu-wrapper--><!--
                            </li>

                            -->
                        </ul>
                    </div><!-- End main-menu -->
                    <ul id="top_tools">
                        <li>
                            <div class="dropdown dropdown-search">
                              <!--   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></a>
                                <div class="dropdown-menu">
                                   <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search...">
                                            <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" style="margin-left:0;">
                                            <i class="icon-search"></i>
                                            </button>
                                            </span>
                                        </div>
                                    </form> -->
                                </div>
                            </div>
                        </li>
                        <!--
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" icon-basket-1"></i>Cart (0) </a>
                                <ul class="dropdown-menu" id="cart_items">
                                    <li>
                                        <div class="image"><img src="<?php echo base_url(); ?>/assets/frontend/images/slides/1.jpg" alt="Image"></div>
                                        <strong>
										<a href="#">Louvre museum</a>1x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div class="image"><img src="<?php echo base_url(); ?>/assets/frontend/images/slides/2.jpg" alt="Image"></div>
                                        <strong>
										<a href="#">Versailles tour</a>2x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div class="image"><img src="<?php echo base_url(); ?>/assets/frontend/images/slides/3.jpg" alt="Image"></div>
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