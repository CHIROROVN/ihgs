<!DOCTYPE html>
<html lang="ja">
<head>
<title>ITOCHU 労務ソリューションシステム</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
  function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{ asset('') }}public/backend/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/backend/css/table-style.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('') }}public/backend/css/basictable.css" />
<link href="{{ asset('') }}public/backend/css/component.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('') }}public/backend/css/style_grid.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('') }}public/backend/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('') }}public/backend/css/my.css" rel="stylesheet" type="text/css" media="all" />

<!-- font-awesome-icons -->
<link href="{{ asset('') }}public/backend/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
</head>
<body>
  <!-- /pages_agile_info_w3l -->
  <div class="pages_agile_info_w3l">
    <!-- /login -->
    <div class="over_lay_agile_pages_w3ls">
      <div class="registration">
        <div class="signin-form profile">
          <h2>ログイン</h2>

          <div class="flash-messages">
                @if($message = Session::get('danger'))

                    <div id="error" class="message">
                        <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
                        <span>{{$message}}</span>
                    </div>

                @elseif($message = Session::get('success'))

                    <div id="success" class="message">
                        <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
                        <span>{{$message}}</span>
                    </div>

                @endif  
          </div>

          <div class="login-form">
            {!! Form::open(array('route' => ['auth.login'], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
              <input type="text" name="u_login" placeholder="ログインID">
                @if ($errors->first('u_login'))
              <div class="error-text">{{$errors->first('u_login')}}</div>
              @endif

              <input type="password" name="u_passwd" placeholder="パスワード">
              @if ($errors->first('u_passwd'))
              <div class="error-text">{{$errors->first('u_passwd')}}</div>
              @endif
              <div class="tp">
                <td align="center"><input type="submit" value="ログイン">
                <!-- <input onclick="location.href='statics_search.html'" value="ログイン" type="submit"> -->
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /login -->
  <!--copy rights start here-->
    <div class="copyrights">
    <p>© 2017 ITOCHU Human Resources ＆ General Affairs Services Inc. All Rights Reserved.</p>
  </div>
  <!--copy rights end here-->
<!-- //pages_agile_info_w3l -->

<!-- js -->
<script type="text/javascript" src="{{ asset('') }}public/backend/js/jquery-2.1.4.min.js"></script>
<script src="{{ asset('') }}public/backend/js/modernizr.custom.js"></script>

<script src="{{ asset('') }}public/backend/js/classie.js"></script>
<script src="{{ asset('') }}public/backend/js/gnmenu.js"></script>
<script>
  new gnMenu( document.getElementById( 'gn-menu' ) );
</script>
  
<!-- //js -->
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
<script src="{{ asset('') }}public/backend/js/scripts.js"></script>
<script src="{{ asset('') }}public/backend/js/snow.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" src="{{ asset('') }}public/backend/js/bootstrap-3.1.1.min.js"></script>
</body>
</html>