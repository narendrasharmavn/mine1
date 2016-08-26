<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
<style>
    .alert{
        background-color: #2875b8;
        color:black;
    }
	.fadeInDown {
    -webkit-animation-name: fadeInDown;
    animation-name: fadeInDown;
}
.animated {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}
.four{
	text-align: center;
    color: white;
    font-weight: bolder;
}

</style>
<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LewvSUTAAAAAD8SQuVQ45j2WgB6fM59artFNFAF'
        });
      };
    </script>
<section id="hero">
 	<div class="intro_title error">
    	<h1 class="animated fadeInDown">404</h1>
        <p class="four">Oops!! Page not found</p>
       <a href="<?php echo base_url(); ?>home" class="animated fadeInUp btn_1 green">Back to home</a>
	</div>
                
</section>

    <?php include 'footer.php'; ?>

    <div id="toTop"></div><!-- Back to top button -->

       <?php
     include 'scripts.php';
      ?>

      </body>

</html>