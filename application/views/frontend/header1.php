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
<style type="text/css">
    
 .my{
    display: block !important;
    font-size: 13px;
    color: gray;
    padding-bottom: 5px;

    }
  #minheight{
    min-height: 400px;
  }
</style>

</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
<div id="loader">
    <div id="box"></div>
    <div id="hill"></div>
</div>
        
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

    <!-- Header================================================== -->

	