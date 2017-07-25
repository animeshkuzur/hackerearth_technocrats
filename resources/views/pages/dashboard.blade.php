@extends('layouts.master')

@section('style')
    <!--Custom Styles-->
    <link rel="stylesheet" type="text/css" href="#">
@endsection

@section('content')
     <nav class="navbar navbar-fixed-top no-box-shadow">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ url('/home') }}">Canvass</a>
        </div>
        <ul class="nav navbar-nav">
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
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a class="navbar-link" href="{{ url('/home') }}">
                    Home
                </a>
            </li>
          
          @if (Auth::check())
          <li>
            <a class="navbar-link" href="" data-toggle="modal" data-target="#askModal">Ask</a>
          </li>
          <li class="dropdown">
            <a class="navbar-link dropdown-toggle" data-toggle="dropdown" href="{{ url('/profile/'.\Auth::user()->id) }}">{{ \Auth::user()->name }}
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    Logout
                    </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
               </li>
            </ul>
          </li>
          @else
            <li>
            <a class="navbar-link" href="{{ url('/') }}">Login/Register</a>
          </li>
          @endif
        </ul>
      </div>
    </nav>

    <div class="page-wrapper no-padding">

      <div class="search-tabs">
        <div class="search-tab-item">
          <input type="radio" name="search" id="button" checked/>
          <label class="tab-label" for="button" onclick><span class="tab-label-text text-center">Your Feed</span></label>
        </div>
        <div class="search-tab-item">
          <input type="radio" name="search" id="button1"/>
          <label class="tab-label" for="button1" onclick></span><span class="tab-label-text text-center">Recent</span></label>
        </div>
        <div class="search-tab-item">
          <input type="radio" name="search" id="button2"/>
          <label class="tab-label" for="button2" onclick></span><span class="tab-label-text text-center">Not Answered</span></label>
        </div>
      </div>

      <section class="container">
        <div class="row margintop-xxlg">
          <div class="col-md-3">
            <div class="category-filters">
              <div class="category-head text-uppercase marginbottom-lg">Categories</div>
              <form class="form" method="POST" action="{{ route('preference') }}"> 
              {{ csrf_field() }}
              @foreach($cat as $category)
                @if($pref[$category->id-1])
              <div>
                <label class="control control--checkbox">{{$category->name}}
                  <input type="checkbox" name="category[]" value="{{$category->id}}" checked/>
                  <div class="control--indicator"></div>
                </label>
              </div>
                @else
              <div>
                <label class="control control--checkbox">{{$category->name}}
                  <input type="checkbox" name="category[]" value="{{$category->id}}"/>
                  <div class="control--indicator"></div>
                </label>
              </div>
                @endif
              @endforeach
              <button type="submit" class="btn btn-primary btn-block">Update</button>
              </form>
            </div>
          </div>
          <div class="col-md-9">

            <div class="questions-box"> 
            @if(isset($feeds))
            @foreach($feeds as $feed)
              <div class="question-wrapper">
                <div class="row">

                  <div class="col-md-10"> 
                    <div class="question-content">
                      <a href="{{ url('/question/'.$feed->quest_id) }}"><div class="question">{{ $feed->title }}
                        @if(empty($feed->answer_id)) 
                            (Unresolved) 
                        @endif
                      </div></a>
                      <div class="question-description">{{ $feed->description }}</div>
                      <div class="action-btn-group margintop-md">
                        <div class="actions">
                          <!-- Pass Class null in action-btn if no answers or votes -->
                          <a href="{{ url('/question/'.$feed->quest_id) }}">
                            <span class="number-answers action-btn">
                              <i class="ion-android-textsms paddingright-xs"></i>
                              <span>{{ sizeof(\DB::table('answers')->where('question_id',$feed->quest_id)->get()) }} Answers</span>
                            </span>
                          </a>
                          <a href="#">
                            <span class="votes action-btn">
                              <i class="ion-arrow-up-c paddingright-xs"></i>
                              <span>{{ sizeof(\DB::table('question_upvotes')->where('question_id',$feed->quest_id)->get()) }} Votes</span>
                            </span>
                          </a>
                        </div>
                        <span class="time">
                          <i class="ion-clock paddingright-xs"></i>
                          <span>{{ $feed->time }}</span>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="question-category">
                      <i class="ion-android-bookmark icon"></i>
                      <div class="category-label">{{ $feed->name }}</div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            @endif
            </div>
          </div> 
        </div>
        <!-- <label class="control control--checkbox">First checkbox
          <input type="checkbox" checked="checked"/>
          <div class="control--indicator"></div>
        </label> -->
      </section>
    </div>

@endsection

@section('script')

<script type="text/javascript">
  @if($errors->any())
    $(function() {
      $('#askModal').modal('show');
    });
  @endif

</script>
@endsection