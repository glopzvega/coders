<?php 
session_start();

unset($_SESSION["login"]);
session_destroy();

require_once $_SERVER["DOCUMENT_ROOT"] . "/coders/config.php";
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Coders! Web Developers Love.!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

        <link rel="apple-touch-icon" href="<?php echo APPNAME; ?>/apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/normalize.css">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/materialize.min.css">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
        <script src="<?php echo APPNAME; ?>/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>        

    <?php
      // include "views/login/index.php";
    ?>

    <div class="">
      <div class="row"></div>
          
      <div class="row">
          <div class="col m5 offset-m1 hide-on-small-only">
              <img src="<?php echo APPNAME; ?>/img/iphone.png" alt="Iphone">
          </div>
          <div class="col m5 s12">
              <div class="row">
                  <form id="FormLogin" action="server.php" method="POST" class="col s12">
                    <div class="row">                            
                      <div class="col s2">
                          <h1 class="logo">
                              <i class="fa fa-bug" aria-hidden="true"></i>
                          </h1>
                      </div>
                      <div class="col s10">
                          <h1 class="appname">Coders!</h1>
                          <span class="subtitle">App Developers Love!</span>
                      </div>
                    </div>                          
                    <br>                                               
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="email" name="email" type="email" class="validate">
                        <label for="email">Email</label>
                      </div>
                    </div>                          
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="password" name="password" type="password" class="validate">
                        <label for="password">Password</label>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col s12 center-align">
                            <button class="btn waves-effect waves-light pink lighten-1" type="submit" name="action">
                              <i class="fa fa-send"></i>
                               Entrar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 center-align">
                            o <a href="<?php echo APPNAME; ?>/registro/">Crea una cuenta</a>
                        </div>
                    </div>
                  </form>
                </div>
          </div>
      </div>
  </div>



    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>


    <script>window.jQuery || document.write('<script src="<?php echo APPNAME; ?>/js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
    <script src="<?php echo APPNAME; ?>/js/plugins.js"></script>
    <script src="<?php echo APPNAME; ?>/js/materialize.min.js"></script>
    <script src="<?php echo APPNAME; ?>/js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>

    <script>

    procesar_respuesta = function(res){
      // console.log(res);
      // alert(res);

      if(res.correcta == true)
      {
        alert(res.mensaje);
        location.href = "index.php";
      }
      else
      {
        alert(res.mensaje);
        $("#email").val("");
        $("#password").val("")
      }
    }
      
    $("#FormLogin").on("submit", function(e){
      e.preventDefault();
      // alert("SUBMIT");

      var data = $(this).serialize();
      // alert(data)

      $.post("server.php", data, procesar_respuesta , "json");

    });

    </script>
        
    </body>
</html>
