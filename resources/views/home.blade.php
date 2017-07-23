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
            
            <br>

            <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Feed</div>

                    <div class="panel-body">
                        @if(isset($feeds))
                            <div class="row">
                                <div class="col-md-12">
                                    <ul>
                                    @foreach($feeds as $feed)
                                        <li>
                                            <h4>
                                                <a href="{{ url('/question/'.$feed->quest_id) }}">{{ $feed->title }} 
                                                @if(empty($feed->answer_id)) 
                                                    (Unresolved) 
                                                @endif
                                                </a>
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <p style="text-align: left;">{{ sizeof(\DB::table('question_upvotes')->where('question_id',$feed->quest_id)->get()) }} Upvote(s)</p>
                                                </div>
                                                <div class="col-md-2" style="text-align: left;">
                                                    <p >{{ sizeof(\DB::table('answers')->where('question_id',$feed->quest_id)->get()) }} Answer(s)</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p style="text-align: right;padding-right: 45px;">{{ $feed->name }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <br>
                                    @endforeach
                                    </ul>
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
