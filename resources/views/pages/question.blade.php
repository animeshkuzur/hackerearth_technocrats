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
            <a class="navbar-link dropdown-toggle" data-toggle="dropdown" href="">{{\Auth::user()->name}}
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

    <div class="page-wrapper">

      <section class="container">
        <div class="row">

          <div class="col-md-9">

            <div class="question-page-box"> 
              <div class="question-wrapper">
                <div class="question-content">
                  <div class="question">{{$question_data->title}}</div>
                  <div class="question-tags">
                    @foreach($tag_data as $tag)
                      <button class="btn-primary btn-outline">{{ $tag->tag }}</button>
                    @endforeach
                  </div>
                  <div class="question-description">{{ $question_data->description }}</div>
                  <div class="action-btn-group margintop-md">
                    <div class="actions">
                      <!-- Pass Class null in action-btn if no answers or votes -->
                      <a href="#">
                        <span class="number-answers action-btn">
                          <i class="ion-android-textsms paddingright-xs"></i>
                          <span>{{ sizeof($answer_data) }} Answers</span>
                        </span>
                      </a>
                      <a href="#">
                        <span class="votes action-btn">
                          <i class="ion-arrow-up-c paddingright-xs"></i>
                          <span>{{ sizeof(\DB::table('question_upvotes')->where('question_id',$question_data->question_id)->get()) }} Votes</span>
                        </span>
                      </a>
                      @if(\Auth::check())

                      @if(isset(\DB::table('question_upvotes')->where('question_id',$question_data->question_id)->where('user_id',\Auth::user()->id)->get()->first()->id))
                            <a href="{{ url('/question/'.$question_data->question_id.'/downvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsdown paddingright-xs"></i>Downvote</a>
                            @else
                            <a href="{{ url('/question/'.$question_data->question_id.'/upvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsup paddingright-xs"></i>Upvote</a>
                            @endif

                      @else
                        <a href="{{ url('/question/'.$question_data->question_id.'/upvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsup paddingright-xs"></i>Upvote</a> 
                      @endif

                      @if(\Auth::check())
                         @if(\Auth::user()->id == $question_data->question_user_id)
                              <a href="{{ url('/question/'.$question_data->question_id.'/delete') }}" class="btn btn-danger btn-sm">Delete</a>
                         @endif
                      @endif

                    </div>
                    <span class="time action-btn text-right">
                      <i class="ion-clock paddingright-xs"></i>
                      <span>{{ $question_data->question_created }}</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="static-box answers-box margintop-md">
              <form class="answer-form" method="POST" action="{{ url('/question/'.$question_data->question_id.'/answer/add') }}">
              {{ csrf_field() }}
              
                <div class="row">
                  <div class="col-md-12 form-group">
                    <textarea placeholder="Got something to say..." class="input form-control" type="text" id="answer" name="answer"></textarea>
                    @if ($errors->has('answer'))
                      <span class="help-block">
                        <strong>{{ $errors->first('answer') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="row submit">
                  <div class="col-md-12 form-group text-right">
                    <button type="submit" id="login_save" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
              <div class="answers-wrapper">


                @foreach($answer_data as $answer)
                @if($answer->answer_id == $question_data->solution)
                  <div class="answer-content">
                  <div class="answer-user">
                    <div class="name"><a href="{{ url('/user/'.$answer->user_id) }}">{{ $answer->user_answer }}</a></div>
                    <span class="time"><i class="ion-clock paddingright-xs"></i>{{ $answer->answer_created }}</span>
                  </div>
                  <div class="answer-text">{{ $answer->answer }}</div>
                  <div class="action-btn-group margintop-md">
                    <div class="actions">
                      <!-- Pass Class null in action-btn if no votes -->
                      <a href="#">
                        <span class="votes action-btn">
                          <i class="ion-arrow-up-c paddingright-xs"></i>
                          <span>{{ sizeof(\DB::table('answer_upvotes')->where('answer_id',$answer->answer_id)->get()) }} Votes</span>
                        </span>
                      </a>
                      @if(\Auth::check())

                        @if(isset(\DB::table('answer_upvotes')->where('answer_id',$answer->answer_id)->where('user_id',\Auth::user()->id)->get()->first()->id))
                        <a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/downvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsdown paddingright-xs"></i>Downvote</a>
                        @else
                        <a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/upvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsup paddingright-xs"></i>Upvote</a>
                        @endif

                      @else
                        <a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/upvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsup paddingright-xs"></i>Upvote</a>

                      @endif


                      @if(\Auth::check())
                        @if(\Auth::user()->id == $question_data->question_user_id)
                          <a href="{{ url('/question/'.$question_data->question_id.'/delete') }}" class="btn btn-danger btn-sm">Delete</a>
                        @endif
                      @endif

                    </div>
                    @if(\Auth::check())
                      @if(\Auth::user()->id == $question_data->question_user_id)
                      <span class="correct-soln"> 
                        <a href="{{ url('/question/'.$question_data->question_id.'/remove-solution') }}" class="btn-primary btn-outline marked"><i class="ion-checkmark-circled paddingright-xs"></i>Unmark Solution</a>
                      </span>
                      @endif

                    @else
                      <span class="correct-soln"> 
                        <a href="#" class="btn-primary btn-outline marked"><i class="ion-checkmark-circled paddingright-xs"></i>Correct Solution</a>
                      </span>

                    @endif
                  </div>
                </div>
                @else
                <div class="answer-content">
                  <div class="answer-user">
                    <div class="name"><a href="{{ url('/user/'.$answer->user_id) }}">{{ $answer->user_answer }}</a></div>
                    <span class="time"><i class="ion-clock paddingright-xs"></i>{{ $answer->answer_created }}</span>
                  </div>
                  <div class="answer-text">{{ $answer->answer }}</div>
                  <div class="action-btn-group margintop-md">
                    <div class="actions">
                      <!-- Pass Class null in action-btn if no votes -->
                      <a href="#">
                        <span class="votes action-btn">
                          <i class="ion-arrow-up-c paddingright-xs"></i>
                          <span>{{ sizeof(\DB::table('answer_upvotes')->where('answer_id',$answer->answer_id)->get()) }} Votes</span>
                        </span>
                      </a>
                      @if(\Auth::check())
                        @if(isset(\DB::table('answer_upvotes')->where('answer_id',$answer->answer_id)->where('user_id',\Auth::user()->id)->get()->first()->id))
                        <a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/downvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsdown paddingright-xs"></i>Downvote</a>
                        @else
                        <a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/upvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsup paddingright-xs"></i>Upvote</a>
                        @endif
                      @else
                        <a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/upvote') }}" class="btn-primary btn-outline"><i class="ion-thumbsup paddingright-xs"></i>Upvote</a>
                      @endif
                    </div>
                    @if(\Auth::check())
                    @if(\Auth::user()->id == $question_data->question_user_id)
                    <span class="correct-soln"> 
                      <a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/solution') }}" class="btn-primary btn-outline"><i class="ion-checkmark-circled paddingright-xs"></i>Mark as Correct Solution</a>
                    </span>
                    @endif
                    @endif
                  </div>
                </div>
                @endif
                @endforeach


                
              </div>

            </div>
          </div>

          <div class="col-md-3">
            <a href="{{ url('/user/'.$question_data->user_id) }}">
              <div class="author-box static-box text-center">
                <i class="ion-person"></i>
                <div class="author-name">{{$question_data->user_question}}</div>
              </div>
            </a>

            <div class="sentiment-title static-box padding-sm margintop-lg text-center">
              <span>Social Analysis Report</span>
            </div>
            @foreach($tag_data as $tag)
              @if(isset($tag->tag_id))
            <div class="chart static-box">
              <ul class="chart-inner" data-title="{{ $tag->tag }}">
                <li class="yes" style="transform: rotate({{(($tag->positive)/100)*180}}deg)">
                  <span class="chart-label" style="transform: rotate(-{{(($tag->positive)/100)*180}}deg)">Yes</span>
                </li>
                <li class="neutral" style="transform: rotate({{(($tag->neutral)/100)*180}}deg)">
                  <span class="chart-label" style="transform: rotate(-{{(($tag->neutral)/100)*180}}deg)">Neutral</span>
                </li>
                <li class="no" style="transform: rotate(180deg)">
                  <span class="chart-label" style="transform: rotate(-180deg)">No</span>
                </li>
              </ul>
            </div>
              @endif
            @endforeach
            <div class="row">
                                <div class="col-md-12" style="text-align:center; color:gray;">
                                    <p>Sentiment Analysis is being calculated using the Twitter API. If the stats are not being displayed, then it may take some while.</p>
                                </div>
                            </div>   
          </div>

        </div>
      </section>
    </div>

@endsection

@section('script')
@endsection