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
          <label class="tab-label" for="button" onclick><span class="tab-label-text text-center">Asked & Answered</span></label>
        </div>
      </div>

      <section class="container">
        <div class="row margintop-xxlg">
          <div class="col-md-3">
            <div class="profile-box static-box">
              <div class="intro">
                <div class="name">{{ $profile->name }}</div>
                <div class="email">{{ $profile->email }}</div>
                <div class="member-since">Member Since {{ substr($profile->created_at,0,4) }}</div>
              </div>
              <div class="rank">
                <!-- <div><i class="ion-android-star"></i></div> -->
                <div class="rank-text">XP</div>
                <div class="rank-number">{{ ($no_quest*10+$no_ans*5)+($quest_upvote+$ans_upvote) }}</div>
              </div>
              <div class="stats">
                <div class="stats-item" data-toggle="tooltip" title="Questions Asked">
                  <img class="stats-icon" src="{{ asset('images/asked.svg') }}">
                  <div class="stats-number">{{ $no_quest }}</div>
                </div>
                <div class="stats-item" data-toggle="tooltip" title="Questions Answered">
                  <img class="stats-icon" src="{{ asset('images/answered.svg') }}">
                  <div class="stats-number">{{ $no_ans }}</div>
                </div>
                <div class="stats-item" data-toggle="tooltip" title="Votes Received">
                  <i class="ion-thumbsup stats-icon"></i>
                  <div class="stats-number">{{ $quest_upvote+$ans_upvote }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
          <h3>Asked</h3>
            <div class="questions-box" id="questions tab-pane fade in active"> 
            @foreach($questions as $question)
              <div class="question-wrapper">
                <div class="row">

                  <div class="col-md-10"> 
                    <div class="question-content">
                      <a href="{{ url('/question/'.$question->id) }}"><div class="question">{{ $question->title }}
                      @if(empty($question->answer_id)) 
                        (Unresolved) 
                      @endif</div></a>
                      <div class="question-description">{{$question->description}}</div>
                      <div class="action-btn-group margintop-md">
                        <div class="actions">
                          <!-- Pass Class null in action-btn if no answers or votes -->
                          <a href="#">
                            <span class="number-answers action-btn">
                              <i class="ion-android-textsms paddingright-xs"></i>
                              <span>{{ sizeof(\DB::table('answers')->where('question_id',$question->id)->get()) }} Answers</span>
                            </span>
                          </a>
                          <a href="#">
                            <span class="votes action-btn">
                              <i class="ion-arrow-up-c paddingright-xs"></i>
                              <span>{{ sizeof(\DB::table('question_upvotes')->where('question_id',$question->id)->get()) }} Votes</span>
                            </span>
                          </a>
                        </div>
                        <span class="time">
                          <i class="ion-clock paddingright-xs"></i>
                          <span>{{$question->created}}</span>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="question-category">
                      <i class="ion-android-bookmark icon"></i>
                      <div class="category-label">{{$question->name}}</div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
              </div>

              <h3>Answered</h3>
            <div class="questions-box" id="questions tab-pane fade in active"> 
            @foreach($answers as $answer)
              <div class="question-wrapper">
                <div class="row">

                  <div class="col-md-10"> 
                    <div class="question-content">
                      <a href="{{ url('/question/'.$question->id) }}"><div class="question">{{ $answer->title }}
                      @if(empty($answer->answer_id)) 
                        (Unresolved) 
                      @endif</div></a>
                      <div class="question-description">{{$answer->description}}</div>
                      <div class="action-btn-group margintop-md">
                        <div class="actions">
                          <!-- Pass Class null in action-btn if no answers or votes -->
                          <a href="#">
                            <span class="number-answers action-btn">
                              <i class="ion-android-textsms paddingright-xs"></i>
                              <span>{{ sizeof(\DB::table('answers')->where('question_id',$answer->question_id)->get()) }} Answers</span>
                            </span>
                          </a>
                          <a href="#">
                            <span class="votes action-btn">
                              <i class="ion-arrow-up-c paddingright-xs"></i>
                              <span>{{ sizeof(\DB::table('question_upvotes')->where('question_id',$answer->question_id)->get()) }} Votes</span>
                            </span>
                          </a>
                        </div>
                        <span class="time">
                          <i class="ion-clock paddingright-xs"></i>
                          <span>{{$answer->created}}</span>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="question-category">
                      <i class="ion-android-bookmark icon"></i>
                      <div class="category-label">{{$answer->name}}</div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
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
@endsection