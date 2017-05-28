<div class="">
    <div class="row"></div>
        
    <div class="row">
        <div class="col m5 offset-m1 hide-on-small-only">
            <img src="<?php echo APPNAME; ?>/img/iphone.png" alt="Iphone">
        </div>
        <div class="col m5 s12">
            <div class="row">
                <form id="FormLogin" action="server.php" method="GET" class="col s12">
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

