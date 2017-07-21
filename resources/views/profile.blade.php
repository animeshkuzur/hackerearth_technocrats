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
                                <p>Total XP : <b>{{ $no_quest*10+$no_ans*5 }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection
