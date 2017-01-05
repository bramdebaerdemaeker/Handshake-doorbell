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
      <div class="logo uppercase">
        <a href="/"><h2>Handshake</h2></a>
      </div>
      <div class="nav-links">
        <a href="/">Home</a>
        <a href="#">Features</a>
        <a href="contact">Contact</a>
        <a href="#"><button type="button" class="buy uppercase" name="buy">download</button></a>
      </div>
    </div>

    @yield('content')


    <!-- footer -->
    <div class="footer">
      Hier komt de footer inhoud
    </div>



    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/count.js"></script>
  </body>
</html>
