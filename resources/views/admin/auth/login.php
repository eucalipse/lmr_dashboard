<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>City panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
 
    <link href="<?php print URL::to('/'); ?>/admin/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?php print URL::to('/'); ?>/admin/assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print URL::to('/'); ?>/admin/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print URL::to('/'); ?>/admin/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print URL::to('/'); ?>/admin/assets/plugins/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print URL::to('/'); ?>/admin/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
     
    <link href="<?php print URL::to('/'); ?>/admin/webarch/css/webarch.css" rel="stylesheet" type="text/css"/>
    
</head>

<body class="error-body no-top lazy" data-original="<?php print URL::to('/'); ?>/assets/images/promo.jpg" style="background-image: url('<?php print URL::to('/'); ?>/assets/images/promo.jpg')">

	<div class="container">
		<div class="row login-container animated fadeInUp">
			<div class="col-md-7 col-md-offset-2 tiles white no-padding">
				<div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
					<h2 class="normal">City panel</h2>
					<p class="p-b-20"> Введіть свої дані індетифікації</p>
						
					<form class="animated fadeIn validate" action="<?php print url('/'.$url.'/login'); ?>" name="form" method="post">
						<div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
							<div class="col-md-6 col-sm-6">
								<input class="form-control" id="login_username" name="login" placeholder="Користувач" type="email" required>
							</div>
							<div class="col-md-6 col-sm-6">
								<input class="form-control" id="login_pass" name="password" placeholder="Пароль" type="password" required>
							</div>
							
				     		<div class="col-md-12 col-sm-12" style="text-align:center;">
								<a href="#" class="btn btn-primary btn-cons ae_submit">Логін</a>
							</div>
						</div>
						
					</form>
				</div>
				
			</div>
		</div>
	</div>

    <script src="<?php print URL::to('/'); ?>/admin/assets/plugins/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="<?php print URL::to('/'); ?>/admin/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    
    <script src="<?php print URL::to('/'); ?>/admin/ae.js" type="text/javascript"></script>
</body>
</html>
