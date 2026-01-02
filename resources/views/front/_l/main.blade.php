<?php
    if (!isset($route)) {$route=(object)[]; }
    if (!isset($route->seo)) {$route->seo=(object)[]; }

    
    if (!isset($route->seo->title)) $route->seo->title='Панель міста';
    if (!isset($route->seo->keywords)) $route->seo->keywords='';
    if (!isset($route->seo->description)) $route->seo->description='';
?>
<html prefix="og: http://ogp.me/ns#">
<!--<![endif]-->
<head>
	<title><?php print $route->seo->title; ?></title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php print $route->seo->keywords; ?>" />
    <meta name="description" content="<?php print $route->seo->description; ?>" />
    <meta property="og:title" content="<?php print $route->seo->title; ?>" />
    <meta property="og:description" content="<?php print $route->seo->description; ?>" />
    <meta property="og:url" content="<?php print URL::current(); ?>" />
    <link rel="canonical" href="<?php print URL::current(); ?>">
    <meta name="google-site-verification" content="_PiFOWBrJl6bmDzX_W-Bxx9etrLL934pPagdPSAf4gc" />
    <link rel="alternate" hreflang="ua" href="<?php print url('/');?>" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php print url('/'); ?>/lmr/assets/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php print url('/'); ?>/lmr/assets/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php print url('/'); ?>/lmr/assets/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php print url('/'); ?>/lmr/assets/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php print url('/'); ?>/lmr/assets/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php print url('/'); ?>/lmr/assets/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php print url('/'); ?>/lmr/assets/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php print url('/'); ?>/lmr/assets/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php print url('/'); ?>/lmr/assets/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php print url('/'); ?>/lmr/assets/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php print url('/'); ?>/lmr/assets/assets-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php print url('/'); ?>/lmr/assets/assets-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php print url('/'); ?>/lmr/assets/assets-16x16.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php print url('/'); ?>/lmr/assets/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
  	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-87983220-1', 'auto');
      ga('send', 'pageview');
	</script>
    <link rel="stylesheet" href="<?php print url('/'); ?>/admin/assets/plugins/bootstrapv3/css/bootstrap.css">
	<link rel="stylesheet" href="<?php print url('/'); ?>/lmr/assets/css/style.css">
    <link rel="stylesheet" href="<?php print url('/'); ?>/lmr/assets/css/lmr.css">
    <link rel="stylesheet" href="<?php print url('/'); ?>/lmr/assets/css/slick.css">
    <link rel="stylesheet" href="<?php print url('/'); ?>/lmr/assets/css/slick-theme.css">
    <script src="<?php print url('/'); ?>/lmr/assets/js/jquery-1.12.2.min.js"></script>
    <script src="<?php print url('/'); ?>/lmr/assets/js/gauge.min.js"></script>
    <script src="<?php print url('/'); ?>/lmr/assets/js/raphael.js"></script>
    <script src="<?php print url('/'); ?>/lmr/assets/js/morris.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>const PUBLIC_URL="<?php print env('PUBLIC_URL'); ?>";</script>
</head>
<body>
<div class="root">
    <div data-reactroot="" id="wrapper">
        <div class="container-fluid">
			<?php print view('front._l.e_header')->with('p', $p); ?>
			@include($p->subpage)
		</div>
	</div>
    <?php print view('front._l.e_footer')->with('p', $p); ?>
</div>
   <script src="<?php print url('/'); ?>/lmr/assets/js/jquery.circle-diagram.js"></script>
   <script src="<?php print url('/'); ?>/lmr/assets/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
   <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   <script src="<?php print url('/'); ?>/lmr/assets/js/slick.min.js"></script>
   <script src="<?php print url('/'); ?>/lmr/assets/js/slick_slider.js"></script>
   <script src="<?php print url('/'); ?>/lmr/assets/js/lmr.js"></script>
</body>
</html>
