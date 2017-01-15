<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Handshake - login differently</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>

    <!-- navigation -->
    <div class="nav">
      <div class="nav__brand">
        <div class="nav__brand__logo">
          <a href="/"><img src="img/logo.png" alt="logo handshake"></a>
        </div>
        <div class="nav__brand__name">
          <a href="/"><h2 class="uppercase">handshake</h2></a>
        </div>
      </div>
      <div class="nav__links">
        <a href="/">Home</a>
        <a href="/#feature" id="featureslink">Features</a>
        <a href="contact">Contact</a>
        <a href="/coming-soon"><button type="button" class="btn--nav uppercase" name="buy">download</button></a>
      </div>
    </div>

    @yield('content')


    <!-- footer -->
    <div class="footer">
      <div class="footer__left">
        Copyright  ©  HANDSHAKE | 2017  </br>
      </div>
      <div class="footer__middle">
        <i class="fa fa-envelope-o" aria-hidden="true"></i> help@handshake.com
      </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/auth.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
