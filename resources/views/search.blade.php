@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form" method="GET" action="{{ route('search') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Search for a question...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
            </div>
            </form>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Search results ({{ sizeof($results) }})</div>

                <div class="panel-body">
                    @if(sizeof($results))
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                @foreach($results as $result)
                                    <li>
                                        <h4>
                                            <a href="{{ url('/question/'.$result->quest_id) }}">{{ $result->title }} 
                                            @if($result->answer_id == '') 
                                                (Unresolved) 
                                            @endif</a>
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-2">
                                                    <p style="text-align: left;">{{ sizeof(\DB::table('question_upvotes')->where('question_id',$result->quest_id)->get()) }} Upvote(s)</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p style="text-align: left;">{{ sizeof(\DB::table('answers')->where('question_id',$result->quest_id)->get()) }} Answer(s)</p>
                                            </div>
                                            <div class="col-md-8">
                                                <p style="text-align: right;padding-right: 45px;">{{ $result->name }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <h4>
                                    <a href="{{ route('getadd_question') }}">Ask a new question!</a>
                                </h4>                            
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
