<ul id="dropdown1" class="dropdown-content">
  <li><a href="#!" class="pink-text">
    <i class="material-icons">face</i>
    Mi Perfil</a></li>  
  <li class="divider"></li>
  <li><a href="<?php echo APP; ?>/login/" class="pink-text">
    <i class="material-icons">flight_takeoff</i>
    Salir</a></li>
</ul>
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo appname">Coders!</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">      
      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Gerardo Lopez<i class="material-icons right">arrow_drop_down</i></a></li>    
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li>
        <div class="row">
            <div class="col s4">                          
              <img src="<?php echo APP; ?>/img/logo.png" alt="logo" class="avatar" style="width: 70px; border-radius: 50%;">              
            </div>
            <div class="col s8">
              <b class="username">Gerardo A Lopez Vega</b>
              <span class="email">mcgalv@gmail.com</span>              
            </div>
        </div>
      </li>  
      <li>
        <a href="">
          <i class="material-icons orange-text darken-1">star</i> Favoritos
        </a>
      </li>
      <li>
        <a href="">
          <i class="material-icons blue-text">image</i> Fotos
        </a>
      </li>
      <li>
        <a href="">
          <i class="material-icons green-text darken-1">person</i> Contactos
        </a>
      </li>
    </ul>
  </div>
</nav>
<div class="row">
  <div class="col s4 offset-s4">
    
<div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="" src="img/office.jpg">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Card Title</span>
      <p><a href="#">This is a link</a></p>
    </div>    
  </div>

  </div>
</div>

<div class="fixed-action-btn click-to-toggle">
    <a id="btn-floating" class="btn-floating btn-large red">
      <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
      <li><a class="btn-floating red mostrar"><i class="material-icons">insert_chart</i></a></li>
      <li><a class="btn-floating yellow darken-1 ocultar"><i class="material-icons">format_quote</i></a></li>
      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
    </ul>
  </div>

  <!-- Tap Target Structure -->
  <div class="tap-target blue white-text" data-activates="btn-floating">
    <div class="tap-target-content">
      <h5>Title</h5>
      <p>A bunch of text</p>
    </div>
  </div>