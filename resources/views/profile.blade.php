@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Preferences</div>
                    <div class="panel-body">
                        <form class="form" method="POST" action="{{ route('preference') }}"> 
                        {{ csrf_field() }}
                        <ul style="list-style-type: none;">
                          
                          
                            @foreach($cat as $category)
                                @if($pref[$category->id-1])
                                    <li><input type="checkbox" name="category[]" value="{{$category->id}}" checked> <label for="category[]">{{$category->name}}</label></li>
                                @else
                                    <li><input type="checkbox" name="category[]" value="{{$category->id}}"> <label for="category[]">{{$category->name}}</label></li>
                                @endif
                                                                
                            @endforeach
                           
                          </ul>
                          <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                <h1>{{ $profile->name }}</h1>
                                <p>{{ $profile->email }}</p>
                                <br>
                                <br>
                                <p>A member since : {{ $profile->created_at }}</p>
                                <p>Questions asked : <b>{{ $no_quest }}</b></p>
                                <p>Question answered : <b>{{ $no_ans }}</b></p>
                                <p>Total Upvotes Received :<b>{{ $quest_upvote+$ans_upvote }}</b></p>
                                <p>Total XP : <b>{{ ($no_quest*10+$no_ans*5)+($quest_upvote+$ans_upvote) }}</b></p>
                            </div>
                        </div>
                        @if(count($questions))
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Questions Asked:</h4>
                                @foreach($questions as $question)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>
                                                <a href="{{ url('/question/'.$question->id) }}">{{ $question->title }}.
                                                @if(empty($question->answer_id)) 
                                                    (Unresolved) 
                                                @endif
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(count($answers))
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Questions Answered:</h4>
                                @foreach($answers as $answer)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>
                                                <a href="{{ url('/question/'.$answer->question_id.'/#answer'.$answer->id) }}">{{ \DB::table('questions')->where('id',$answer->question_id)->get()->first()->title }}.
                                                @if(empty(\DB::table('questions')->where('id',$answer->question_id)->get()->first()->answer_id)) 
                                                    (Unresolved) 
                                                @endif
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection
