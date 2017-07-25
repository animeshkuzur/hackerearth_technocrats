 <div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#login"><h4 class="modal-title">Login</h4></a></li>
            <li><a data-toggle="tab" href="#signup"><h4 class="modal-title">Signup</h4></a></li>
          </ul>
        </div>
        <div class="modal-body">

          <div class="tab-content">
            <div id="login" class="tab-pane fade in active">
              <div class="login-with">
                <a class="facebook-login-btn btn btn-primary full_width" title="Log in with Facebook">
                Login with Facebook</a>
                <a class="twitter-login-btn btn btn-primary full_width" title="Log in with Twitter">
                Login with Twitter</a>
                <a class="google-login-btn btn btn-primary full_width" title="Log in with Google">
                  Login with Google</a>
              </div>
              <div class="divider" data-title="or"></div>
              <form class="login-form" name="login" method="post" id="loginForm">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="email" name="email" required="required" maxlength="60" placeholder="Email address" class="input form-control" autocomplete="off">
                    <span class="help-block hidden"></span>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <div class="password-container">
                      <input type="password" name="password" required="required" placeholder="Password (min 5 characters)" class="input form-control" autocomplete="off">
                      <span class="help-block hidden"></span>
                    </div>

                  </div>

                </div>
                <div class="row submit">
                  <div class="col-md-12 form-group">
                    <button type="submit" id="login_save" class="btn btn-primary full_width">Login</button>
                  </div>
                  <!-- <div class="col-md-12">
                    <div class="action-btn-group">
                      <a href="#">Sign Up</a>
                      <a href="#">Forgot password?</a>
                    </div>
                  </div> -->
                </div>
              </form>
            </div>
            <div id="signup" class="tab-pane fade">
              <form class="login-form" name="login" method="post" id="loginForm">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" name="name" required="required" maxlength="60" placeholder="Full Name" class="input form-control" autocomplete="off">
                    <span class="help-block hidden"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="email" name="email" required="required" maxlength="60" placeholder="Email address" class="input form-control" autocomplete="off">
                    <span class="help-block hidden"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <div class="password-container">
                      <input type="password" name="password" required="required" placeholder="Password (min 5 characters)" class="input form-control" autocomplete="off">
                      <span class="help-block hidden"></span>
                    </div>
                  </div>

                </div>
                <div class="row submit">
                  <div class="col-md-12 form-group">
                    <button type="submit" id="login_save" class="btn btn-primary full_width">Signup</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>

    </div>
  </div>