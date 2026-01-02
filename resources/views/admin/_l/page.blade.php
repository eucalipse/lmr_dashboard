<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Панель міста</title>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.3/tinymce.min.js" type="text/javascript"></script>

    <link href="<?php print url('/'); ?>/admin/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php print url('/'); ?>/admin/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php print url('/'); ?>/admin/assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php print url('/'); ?>/admin/assets/plugins/summernote/summernote.css" type="text/css" />
    
    <link href="<?php print url('/'); ?>/admin/webarch/css/webarch.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/assets/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css"/>
    <link href="<?php print url('/'); ?>/admin/ae.css" rel="stylesheet" type="text/css"/>




    <script src="<?php print url('/'); ?>/admin/assets/plugins/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
    
    <script>var AE_ADM_URL="<?php print url('/'); ?>/lmr_access";</script>
</head>

<body>

<?php print view('admin._e._h')->with('p', $p); ?>

<div class="page-container row-fluid">

  <?php print view('admin._e._side')->with('p', $p); ?>
  
  <div class="page-content"> 
    <div class="clearfix"></div>
      @include($p->subpage)
  </div>
  
</div>

<?php print view('_common.modal')->render(); ?>

<script src="<?php print url('/'); ?>/admin/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?php print url('/'); ?>/admin/assets/plugins/jquery-block-ui/jqueryblockui.min.js" type="text/javascript"></script> 
<script src="<?php print url('/'); ?>/admin/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
<script src="<?php print url('/'); ?>/admin/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/assets/js/form_elements.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/webarch/js/webarch.js" type="text/javascript"></script> 
<script src="<?php print url('/'); ?>/admin/assets/js/chat.js" type="text/javascript"></script> 

<script src="<?php print url('/'); ?>/admin/libs/bootstrap-notify.min.js" type="text/javascript"></script>

<script src="<?php print url('/'); ?>/admin/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php print url('/'); ?>/admin/assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php print url('/'); ?>/admin/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="<?php print url('/'); ?>/admin/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<script src="<?php print url('/'); ?>/admin/assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php print url('/'); ?>/admin/ae.js" type="text/javascript"></script>
 
</body>
</html>