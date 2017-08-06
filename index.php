<?php 
session_start();


// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>"; 
// exit();

if(!isset($_SESSION["login"]))
{
  echo "<script>location.href='login.php';</script>;";
}
    require_once $_SERVER["DOCUMENT_ROOT"] . "/coders/config.php";

    $module = "home";
    if(isset($_GET["module"]) && $_GET["module"] != "")
    {
      $module = $_GET["module"];
    }    

    define("APP", "/coders");

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
        <style>
          .comments
          {
            max-height: 200px;
            overflow: scroll;
            overflow-x: hidden;
          }
          .comment
          {
            padding: 1em;            
          }
          .comment-text
          {
            background-color: #e0f2f1;
          }
          .comment-input
          {
            display: none;
          }
        </style>
    </head>
    <body>        

       
<?php require_once "menu.php"; ?>

<!-- Modal Structure -->
<div id="modalPublicacion" class="modal">
  <div class="modal-content">
    <h4>Nueva Publicación</h4>
    
    <div class="row">
      <form id="formPublicacion" class="" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12">
            <textarea id="contenido" name="contenido" class="materialize-textarea"></textarea>
            <label for="contenido">Contenido:</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input name="foto_publicacion" id="foto_publicacion" type="file" accept="image/*">            
          </div>
        </div>
      </form>
    </div>

  </div>
  <div class="modal-footer">
    <a href="#!" id="guardarPublicacion" class="modal-action waves-effect waves-green btn-flat">Guardar</a>
  </div>
</div>

<div class="row">
    <div class="col s6 offset-s3" id="contenedorPublicaciones">
    
    </div>
</div>

<div class="fixed-action-btn click-to-toggle">
    <a id="btn-floating" class="btn-floating btn-large red">
      <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
      <li>
        <a class="btn-floating green mostrar tooltipped" data-position="left" data-delay="50" data-tooltip="Agregar Publicacion">
          <i class="material-icons">add</i>
        </a>
      </li>
      <!-- <li><a class="btn-floating yellow darken-1 ocultar"><i class="material-icons">format_quote</i></a></li>
      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li> -->
    </ul>
  </div>

  <!-- Tap Target Structure -->
  <div class="tap-target blue white-text" data-activates="btn-floating">
    <div class="tap-target-content">
      <h5>Title</h5>
      <p>A bunch of text</p>
    </div>
  </div>


        <!-- <script src="ejemplo.js"></script> -->

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

          $(".button-collapse").sideNav();

          $('#modalPublicacion').modal();

          $(".mostrar").on("click", function(){
           $('#modalPublicacion').modal('open');
          });

          guardarFoto = function()
          {           
            var formData = new FormData($("#formLogo")[0]);
            // $("input[name='avatar']").attr("disabled", true);

            $.ajax({
                url : "views/perfilService.php?action=foto",
                message : "",
                data : formData,       
                processData: false,
                contentType: false,
                cache : false,
                method : "POST",
                dataType : "json",
                success: function(res)
                {   
                  if(res.success)
                  {
                    
                      var file = "img/perfiles/" + res.file;
                      $("#formLogo img").attr("src", file);
                    
                    // $("input[name='avatar']").attr("disabled", false);
                  }

                },
                error: function(res){  
                    // $("input[name='avatar']").val(null).attr("disabled", false);
                    console.log(res);
                }
            }); 
          }

          $("input[name='logo']").on("change", function(){
            guardarFoto();
          });

          var guardar = function()
          {
            // Esto se utiliza en lugar del serialize() cuando se usen imagene o archivos
            var formData = new FormData($("#formPublicacion")[0]);

              $.ajax({
                url : "views/publicacionService.php",
                message : "",
                data : formData,       
                processData: false,
                contentType: false,
                cache : false,
                method : "POST",
                dataType : "json",
                success: function(res){
                  console.log(res);      
                  $('#modalPublicacion').modal("close");
                  location.href = "";
                },
                error: function(res){                             
                    console.log(res);
                }
            });  
          }

          $("#guardarPublicacion").on("click", function(e){
            e.preventDefault();

            guardar();

            // var form_data = $("#formPublicacion").serialize();
            // console.log(form_data);

            // $.post("views/publicacionService.php", form_data, function(res){
            //     console.log(res);
            //     if(res.success)
            //     {
            //       alert(res.mensaje);
            //       $("#modalPublicacion").modal("close");
            //     }
            //     else
            //     {
            //       alert(res.mensaje);
            //     }
            // }, "json");
          });

          dar_like = function(boton){

            var idpublicacion = boton.parents(".card").attr("id");
            
            console.log(idpublicacion)
            console.log("===========")

            idpublicacion = idpublicacion.split("_");
            
            console.log(idpublicacion)
            console.log("===========")
            
            idpublicacion = idpublicacion[1];
            
            console.log(idpublicacion)
            console.log("===========")

            var numero_likes = boton.find(".likes").text();
            // alert(numero_likes + " Likes");

            numero_likes = parseInt(numero_likes);

            if(boton.hasClass("like"))
            {
              $.getJSON("views/publicacionService.php?like=&id=" + idpublicacion, function(res)
              {
                boton.removeClass("like").addClass("dislike");
                boton.removeClass("blue-text").addClass("red-text");
                boton.find("i").text("thumb_down");
                boton.find(".texto").text("Ya no me gusta");              
                numero_likes = numero_likes + 1;
                boton.find(".likes").text(numero_likes);
              });

            }
            else
            {
              $.getJSON("views/publicacionService.php?dislike=&id=" + idpublicacion, function(res)
              {
                boton.removeClass("dislike").addClass("like"); 
                boton.removeClass("red-text").addClass("blue-text");
                boton.find("i").text("thumb_up");
                boton.find(".texto").text("Me gusta");     
                numero_likes = numero_likes - 1; 
                boton.find(".likes").text(numero_likes);

              });
            }

          }

          enviar_comentario = function(id, comment)
          {
            var data = 
            {
              "idpublicacion" : id,
              "comentario" : comment
            }

            $.getJSON("views/comentarioService.php?agregar", data, function(res){

            });
          }

          obtener_comentarios = function(idpublicacion)
          {            
            $.getJSON("views/comentarioService.php?obtener", {"idpublicacion" : idpublicacion}, function(res){
              console.log(res);
              if(res.success){
                var comments = "";
                $.each(res.data, function(index, com){
                    comments += '<div class="comment comment-text">';
                    comments += '<b><a href="#">' + com.username + '</a></b>';
                    comments += '<span class="right">' + com.fecha +'</span>';
                    comments += '<br>';
                    comments += '<span>' + com.comentario +'</span>';
                    comments += '</div>';
                });
                $("#publicacion_" + idpublicacion).find(".comments").html(comments);
              }
            });
          }

          mostrar_publicaciones = function(registros)
          {
              // alert("Se recibieron los datos");
              console.log(registros);

              $.each(registros, function(index, publicacion){
                console.log(publicacion);

                var conlike = publicacion.conlike;
                var icon = "thumb_up";
                var clase = "like";
                var color = "blue-text";
                var texto = "Me gusta";

                if (conlike == 1)                
                {
                  icon = "thumb_down";
                  clase = "dislike";
                  color = "red-text";
                  texto = "Ya no me gusta";
                }     

                var avatar = publicacion.avatar;

                if(avatar == "")                
                {
                  avatar = "img/logo.png";
                }
                else
                {
                  avatar = "img/perfiles/" + avatar;
                }

                if(publicacion.imagen != null)
                {
                  publicacion.imagen = "publicaciones/" + publicacion.imagen; 
                  // alert(publicacion.imagen)
                  var imagen = [
                    '<div class="card-image waves-effect waves-block waves-light">',
                      ' <img class="" src="' + publicacion.imagen + '">',
                    '</div>',
                  ].join("");
                }
                else
                {
                  var imagen = "";
                }

                console.log(imagen)
                var pub = [
                '<div class="card" id="publicacion_'+publicacion.id+'">',
                  imagen,
                  '<div class="card-content">',
                    '<div class="row">',
                      '<div class="col s3 valign-wrapper">',
                        '<img src="' + avatar + '" alt="avatar" style="border-radius: 50%;">',
                      '</div>',
                      '<div class="col s9">',
                        '<br><b> ' + publicacion.nombre + " " + publicacion.apellido + ' </b>publicó.',
                        '</div>',
                      '</div>',
                    '</div>',
                    '<div class="row">',
                      '<div class="col s12"> '+publicacion.contenido+' </div>',
                    '</div>',
                    '<div class="row">',
                      '<div class="col s4">',
                        '<a href="javascript:;" class="action ' + clase + ' ' + color + '">',
                          '<i class="material-icons">' + icon + '</i>',
                          '<span class="likes">' + publicacion.likes +'</span>',
                          '<span class="texto">' + texto + '</span>',
                        '</a>',
                      '</div>',

                      '<div class="col s4">',
                        '<a href="#" class="comentario">',
                        '<i class="material-icons">chat_bubble</i>',
                        'Comentario</a>',
                      '</div>',

                      '<div class="col s4 right-align"> '+publicacion.fecha,
                      '</div>',
                    '</div>',

                    '<div class="row">',
                      '<div class="col s12 comments">',
                        
                        // '<div class="comment comment-text">',
                        //   '<b><a href="#">User</a></b>',
                        //   '<span class="right">2017-08-06</span>',
                        //   '<br>',
                        //   '<span>comentario1</span>',
                        // '</div>',
                        // '<div class="comment comment-text">',
                        //   '<b><a href="#">User</a></b>',
                        //   '<span class="right">2017-08-06</span>',
                        //   '<br>',
                        //   '<span>comentario1</span>',
                        // '</div>',
                        // '<div class="comment comment-text">',
                        //   '<b><a href="#">User</a></b>',
                        //   '<span class="right">2017-08-06</span>',
                        //   '<br>',
                        //   '<span>comentario1</span>',
                        // '</div>',                        
                      '</div>',
                      '<div class="comment comment-input">',
                        '<div class="row">',
                          '<div class="col s10">',
                            '<input type="text" class="comentario-form">',
                          '</div>',
                          '<div class="col s2">',
                            '<a href="" class="comentar"><i class="material-icons">check</i></a>',
                          '</div>',  
                        '</div>',                          
                      '</div>',
                    '</div>',

                  '</div>'
                  ].join("");

                $("#contenedorPublicaciones").prepend(pub).find(".action").first().on("click", function(e){
                  
                  dar_like($(this));

                });

                $("#contenedorPublicaciones").find(".comentario").first().on("click", function(e){
                  e.preventDefault();
                  console.log("AGREGAR COMENTARIO");
                  // $(".comment-input").show();
                  $(".comment-input").toggle();
                });

                $("#contenedorPublicaciones").find(".comentar").first().on("click", function(e){
                  e.preventDefault();
                  
                  var idpublicacion = $(this).parents(".card").attr("id");
                  idpublicacion = idpublicacion.split("_")[1];
                  
                  console.log(idpublicacion)
                  var comentario = $(this).parents(".card").find(".comentario-form").val();

                  // .siblings()

                  console.log(comentario);
                  enviar_comentario(idpublicacion, comentario);
                });

                obtener_comentarios(publicacion.id);
            });

          }

          obtener_publicaciones = function()
          {
            $.getJSON("views/publicacionService.php?obtener", function(res){
              console.log(res);

              if(res.success == true)
              {
                mostrar_publicaciones(res.data);
              }
              else
              {
                alert("Ocurrio un error al obtener los datos.");
              }

            });
          }

          obtener_publicaciones();

          // $("#nombreapp").html("<b>Curso de Desarrollo Web</b>");  


          // $("#contenedorPublicaciones").html("");

          // $("#contenedorPublicaciones").html("<a class='btn' href=''>CLICK</a>");          

          $("#contenedorPublicaciones")
            .html("")
            .append("<a id='Agregar' class='btn' href='javascript:;'>CLICK</a>");

            $("#Agregar").on("click", function(e){
                alert("HOLA");
                e.preventDefault();
                // console.log(data)
              });


          $(".action").on("click", function(e){
            e.preventDefault();
            // alert("Le diste Me gusta");
            //$(this) hace referencia al elemento sobre el cual estoy trabajando actualmente (sobre el que le di click)
            var numero_likes = $(this).find(".likes").text();
            // alert(numero_likes + " Likes");

            numero_likes = parseInt(numero_likes);

            if($(this).hasClass("like"))
            {
              $(this).removeClass("like").addClass("dislike");
              $(this).removeClass("blue-text").addClass("red-text");
              $(this).find("i").text("thumb_down");
              $(this).find(".texto").text("Ya no me gusta");              
              numero_likes = numero_likes + 1;

            }
            else
            {
              $(this).removeClass("dislike").addClass("like"); 
              $(this).removeClass("red-text").addClass("blue-text");
              $(this).find("i").text("thumb_up");
              $(this).find(".texto").text("Me gusta");     
              numero_likes = numero_likes - 1;              
            }

            $(this).find(".likes").text(numero_likes);           

          });

        </script>
    </body>
</html>
