@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('emailauth') }}">
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
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password_email') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                    <hr>
                        <div class="col-md-4">
                            <a class="btn btn-primary center-block" href="{{ url('/auth/facebook') }}">Login with facebook</a>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-danger center-block" href="{{ url('/auth/google') }}">Login with google</a>
                        </div>
                        <div class="col-md-4 col">
                            <a class="btn btn-info center-block" href="{{ url('/auth/twitter') }}">Login with twitter</a>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
