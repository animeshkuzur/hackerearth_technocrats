 <div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#login"><h4 class="modal-title">Login</h4></a></li>
            <li><a data-toggle="tab" href="#signup" id="signup-modal"><h4 class="modal-title">Signup</h4></a></li>
          </ul>
        </div>
        <div class="modal-body">

          <div class="tab-content">
            <div id="login" class="tab-pane fade in active">
              <div class="login-with">
                <a class="facebook-login-btn btn btn-primary full_width" title="Log in with Facebook" href="{{ url('/auth/facebook') }}">
                Login with Facebook</a>
                <a class="twitter-login-btn btn btn-primary full_width" title="Log in with Twitter" href="{{ url('/auth/twitter') }}">
                Login with Twitter</a>
                <a class="google-login-btn btn btn-primary full_width" title="Log in with Google" href="{{ url('/auth/google') }}">
                  Login with Google</a>
              </div>
              <div class="divider" data-title="or"></div>
              <form class="login-form" name="login" method="POST" id="loginForm" action="{{ route('emailauth') }}">
              {{ csrf_field() }}
              @if( \Session()->has('email') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <font style="font-size: 12px; padding: 0px; margin : 0px;">
                    {{ \Session::get('email') }}
                  </font>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>             
                    </button>
                </div>
              @endif
                <div class="row">
                  <div class="col-md-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" required="required" maxlength="60" placeholder="Email address" class="input form-control" autocomplete="off" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="password-container">
                      <input type="password" name="password" required="required" placeholder="Password (min 5 characters)" class="input form-control" autocomplete="off" >
                      @if ($errors->has('password'))
                        <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                    </div>

                  </div>
                <div class="row">
                  <div style="padding: 20px;">
                  <div class="col-md-6 form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6 form-group">
                    <a class="btn btn-link" href="{{ route('password_email') }}">
                      Forgot Your Password?
                    </a>
                  </div>
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
              <form class="login-form" name="register" method="POST" id="registerForm" action="{{ route('emailregister') }}">
              {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}" value="{{ old('name') }}">
                    <input type="text" name="name" required="required" maxlength="60" placeholder="Full Name" class="input form-control" autocomplete="off" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group{{ 
                  $errors->has('email') ? ' has-error' : '' 
                  }}">
                    <input type="email" name="email" required="required" maxlength="60" placeholder="Email address" class="input form-control" autocomplete="off" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="password-container">
                      <input type="password" name="password" required="required" placeholder="Password (min 5 characters)" class="input form-control" autocomplete="off">
                      @if ($errors->has('password'))
                        <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="password-container">
                      <input type="password" name="password_confirmation" required="required" placeholder="Password (min 5 characters)" class="input form-control" autocomplete="off">
                      @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                      @endif
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