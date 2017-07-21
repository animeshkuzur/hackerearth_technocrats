@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6" style="text-align: left;">
                        @if($question_data->answer_id == '') 
                            (Unresolved) 
                        @else
                            (Resolved)
                        @endif
                        </div>
                        <div class="col-sm-6" style="text-align: right; ">Category : {{ $question_data->category_name }}</div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>{{ $question_data->title }}</h2>
                            <p>{{ $question_data->description }}</p>
                            <br>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Asked by <a href="{{ url('/user/'.$question_data->user_id) }}">{{ $question_data->user_question }}</a></p>
                        </div>
                        <div class="col-md-6">
                            <p style="text-align: right;">{{ $question_data->question_created }}</p>
                        </div>
                    </div>
                    @if(\Auth::user()->id == $question_data->question_user_id)
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align: right;"><a href="{{ url('/question/'.$question_data->question_id.'/delete') }}" style="color:red;">Delete</a></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <br>
        
    </div>
    <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    
                        <h4>({{ sizeof($answer_data) }}) Answers</h4>
                    
                </div>
                @foreach($answer_data as $answer)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                               <p>{{ $answer->answer }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Answered by <a href="{{ url('/user/'.$answer->user_id) }}">{{ $answer->user_answer }}</a></p>
                            </div>
                            <div class="col-md-6">
                                <p style="text-align: right;">{{ $answer->answer_created }}</p>
                            </div>
                        </div>
                        @if(\Auth::user()->id == $answer->answer_user_id)
                        <div class="row">
                            <div class="col-md-12">
                                <p style="text-align: right;"><a href="{{ url('/question/'.$question_data->question_id.'/answer/'.$answer->answer_id.'/delete') }}" style="color:red;">Delete</a></p> 
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form" method="POST" action="{{ url('/question/'.$question_data->question_id.'/answer/add') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                   <textarea type="text" name="answer" class="form-control" placeholder="Write your answer here..." id="answer" required autofocus></textarea> 
                                   @if ($errors->has('answer'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('answer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" class="form-control btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
</div>
@endsection
