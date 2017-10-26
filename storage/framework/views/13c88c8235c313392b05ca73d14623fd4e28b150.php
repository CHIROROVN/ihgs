<!DOCTYPE html>
<html lang="ja">
<head>
<title>ITOCHU 労務ソリューションシステム</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> 
  addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
  function hideURLbar(){ window.scrollTo(0,1); } 
</script>
<script type="text/javascript" src="<?php echo e(asset('')); ?>public/backend/js/jquery-2.1.4.min.js"></script>
<link href="<?php echo e(asset('')); ?>public/backend/css/import.css" rel="stylesheet" />
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">

</head>
<body>
<!-- banner -->
<div class="wthree_agile_admin_info">
  <!-- /agileits_top_nav-->
    <!-- /nav-->
    <div class="w3_agileits_top_nav">
      <ul id="gn-menu" class="gn-menu-main">
        <!-- /nav_agile -->
          <li class="gn-trigger">
            <a class="gn-icon gn-icon-menu"><i class="fa fa-bars" aria-hidden="true"></i><span>Menu</span></a>
            <nav class="gn-menu-wrapper">

              <div class="gn-scroller scrollbar1">

               <?php echo $__env->make('backend.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              </div><!-- /gn-scroller -->

            </nav>
          </li>
          <!-- //nav_agile -->
          <li class="second logo"><h1><a href="<?php echo e(route('backend.search.index')); ?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i><img src="<?php echo e(asset('')); ?>public/backend/images/logo.png" alt="itochu" style="height: 50px;"> </a></h1>
          </li>
          <li class="second admin-pic fl-right">
            <ul class="top_dp_agile">
              <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span class="username"><?php if(Auth::check()): ?><?php echo e(Auth::user()->u_name); ?><?php endif; ?></span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu drp-mnu">
                  <li> <a href="<?php echo e(route('auth.logout')); ?>"><i class="fa fa-sign-out"></i> ログアウト</a> </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="second full-screen">
            <section class="full-top">
              <button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>  
            </section>
          </li>
        </ul>
        <!-- //nav -->
      </div>
      <div class="clearfix"></div>
      <!-- //agileits_top_nav-->

      <!-- /inner_content-->
      <div class="inner_content">

        <!-- Content -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- /Content -->

      </div>
      <!-- //inner_content-->

  <!-- banner -->
  <!--copy rights start here-->
  <div class="copyrights copyright-fixed">
    <p>© 2017 ITOCHU Human Resources ＆ General Affairs Services Inc. All Rights Reserved.</p>
  </div>
<!--copy rights end here-->
<!-- js -->
<script type="text/javascript" src="<?php echo e(asset('')); ?>public/backend/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo e(asset('')); ?>public/backend/js/modernizr.custom.js"></script>
<script src="<?php echo e(asset('')); ?>public/backend/js/classie.js"></script>
<script src="<?php echo e(asset('')); ?>public/backend/js/gnmenu.js"></script>
<script>
  new gnMenu( document.getElementById( 'gn-menu' ) );
</script>
<script src="<?php echo e(asset('')); ?>public/backend/js/screenfull.js"></script>
<script>
  $(function () {
    $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

    if (!screenfull.enabled) {
      return false;
    }
    $('#toggle').click(function () {
      screenfull.toggle($('#container')[0]);
    });  
  });
</script>
<script src="<?php echo e(asset('')); ?>public/backend/js/jquery.nicescroll.js"></script>
<script type="text/javascript" src="<?php echo e(asset('')); ?>public/backend/js/bootstrap-3.1.1.min.js"></script>
<script src="<?php echo e(asset('')); ?>public/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo e(asset('')); ?>public/backend/js/scripts.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- Js -->
  <?php echo $__env->yieldContent('js'); ?>
<!-- /Js -->

</body>
</html>