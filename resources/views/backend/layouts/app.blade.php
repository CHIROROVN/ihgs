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
<script type="text/javascript" src="{{ asset('') }}public/backend/js/jquery-2.1.4.min.js"></script>
<link href="{{ asset('') }}public/backend/css/import.css" rel="stylesheet" />
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

               @include('backend.layouts.sidebar')

              </div><!-- /gn-scroller -->

            </nav>
          </li>
          <!-- //nav_agile -->
          <li class="second logo"><h1><a href="{{route('backend.search.index')}}"><i class="fa fa-graduation-cap" aria-hidden="true"></i><img src="{{ asset('') }}public/backend/images/logo.png" alt="itochu" style="height: 50px;"> </a></h1>
          </li>
          <li class="second admin-pic fl-right">
            <ul class="top_dp_agile">
              <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span class="username">@if(Auth::check()){{Auth::user()->u_name}}@endif</span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu drp-mnu">
                  <li> <a href="{{route('auth.logout')}}"><i class="fa fa-sign-out"></i> ログアウト</a> </li>
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
        @yield('content')
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
<script type="text/javascript" src="{{ asset('') }}public/backend/js/jquery-2.1.4.min.js"></script>
<script src="{{ asset('') }}public/backend/js/modernizr.custom.js"></script>
<script src="{{ asset('') }}public/backend/js/classie.js"></script>
<script src="{{ asset('') }}public/backend/js/gnmenu.js"></script>
<script>
  new gnMenu( document.getElementById( 'gn-menu' ) );
</script>
<script src="{{ asset('') }}public/backend/js/screenfull.js"></script>
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
<script src="{{ asset('') }}public/backend/js/jquery.nicescroll.js"></script>
<script type="text/javascript" src="{{ asset('') }}public/backend/js/bootstrap-3.1.1.min.js"></script>
<script src="{{ asset('') }}public/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{ asset('') }}public/backend/js/scripts.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- Js -->
  @yield('js')
<!-- /Js -->

</body>
</html>