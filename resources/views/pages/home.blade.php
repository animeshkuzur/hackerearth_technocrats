@extends('layouts.master')

@section('style')
	<!--Custom Styles-->
	<link rel="stylesheet" type="text/css" href="#">
@endsection

@section('content')
	 <div class="landing-wrapper">
        <section class="landing-banner">
          <div class="container">
          @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                      <div class="login-button pull-right">
                          <a href="{{ url('/home') }}">Home</a>
                        </div>
                        <div class="login-button pull-left">
                          <p>Hi! {{ \Auth::user()->name }}</p>
                        </div>
                    @else
                    <div class="login-button pull-left">
                          <a href="{{ url('/home') }}">Home</a>
                        </div>
                      <a href="#" data-toggle="modal" data-target="#loginModal">
                        <div class="login-button pull-right">
                          Login
                        </div>
                      </a>
                    @endif
                </div>
            @endif
            <div class="landing-banner-inner">
              <div class="banner-logo marginbottom-lg">
                <!-- <img src="{{ URL::asset('images/hcl-logo.svg')}}"> -->
                <h2 class="logo-text">Canvass</h2>
              </div>
              <div class="technocrats-search" id="technocratsSearch">
                <form class="form" method="GET" action="{{ route('search') }}">
                <div class="input-group">
                  <input class="typeahead input" type="text" placeholder="Search a question" name="q">
                  <div class="input-group-btn">
                    <button type="submit" class="search-button button btn btn-primary"><i class="ion-android-search"></i></button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>

@endsection

@section('script')
<script type="text/javascript">
  @if($errors->any())
    $(function() {
      $('#loginModal').modal('show');
    });
    @if($errors->has('name') || $errors->has('password_confirmation'))
      $(function(){
        $('#signup-modal').click();
      });
    @endif
  @endif

</script>
@endsection