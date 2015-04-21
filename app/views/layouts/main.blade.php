<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
        content="Buy modern artwork from artists around the world. Find paintings, photography, drawings, sculptures & prints.">
  <meta name="author" content="">

  @yield('title')

  <!-- Bootstrap -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.2/yeti/bootstrap.min.css">
  {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">--}}
  {{ HTML::style('css/main.css') }}

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  {{--google+ likes--}}
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<!-- NAVBAR
================================================== -->
<body>
<div class="navbar-wrapper">
  <div class="container">

    {{--Fixed NavBar--}}
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed"
                  data-toggle="collapse"
                  data-target="#navbar"
                  aria-expanded="false"
                  aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img alt="Brand" src="/brand/brand.jpg" style="width:35px;height:30px">
          </a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active">
            <li>
              <a href="/art/Painting/" role="button" aria-expanded="false">PAINTINGS</a>
            </li>
            <li>
              <a href="/art/Photography/" role="button" aria-expanded="false">PHOTOGRAPHY</a>
            </li>
            <li>
              <a href="/art/Drawing/" role="button" aria-expanded="false">DRAWINGS</a>
            </li>
            <li>
              <a href="/art/Sculpture/" role="button" aria-expanded="false">SCULPTURE</a>
            </li>
            <li>
              <a href="/art/Collage/" role="button" aria-expanded="false">COLLAGE</a>
            </li>
            <li>
              <a href="/events/" role="button" aria-expanded="false">EVENTS</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
@yield('content')

<footer class="footer">
  <div class="container">
    <div class="footer-wrapper">
      <div class="row">
        <div class="col-md-3">
          <p>FOR BUYERS</p>

          <p>Art Advisory Services</p>

          <p>Buyer FAQ / Support</p>

          <p>Blog</p>
        </div>
        <div class="col-md-3">
          <p>FOR ARTISTS</p>

          <p>Sell Your Art</p>

          <p>Seller's Guide</p>

          <p>Artist FAQ / Support</p>
        </div>
        <div class="col-md-3">
          <p>ABOUT US</p>

          <p>Press</p>

          <p>Careers</p>

          <p>Contact Us</p>
        </div>
        <div class="col-md-3">
          <p>CUBE ART</p>

          <p>Terms of Service</p>

          <p>Privacy Policy</p>

          <p>Copyright Policy</p>

          <p>Affiliate Program</p>
        </div>
      </div>
      <hr/>
      <img alt="Brand" src="/brand/brand.jpg" style="width:35px;height:30px">&nbsp;&nbsp;&copy;2015 Cube Art. All rights
      reserved.
      </a>
    </div>
  </div>
</footer>

{{--facebook like--}}
<div id="fb-root"></div>
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script>$('#flash-overlay-modal').modal();</script>
</body>
</html>
