@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ask a Question!</div>

                <div class="panel-body">
                    <div class="row">
                        <form class="form" method="POST" action="{{ route('add_question') }}">
                        {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <input id="title" type="text" class="form-control" name="title" placeholder="Question..." required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <textarea type="text" class="form-control" name="description" id="description" placeholder="Description..." required></textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                            <input type="text" id="tags" name="tags" class="form-control" placeholder="tag1,tag2,tag3 (seperate each tag with a comma)" required>
                                            @if ($errors->has('tags'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tags') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                        <div class="col-md-3" align="right">
                                            <label for="category">Select a category :</label>
                                        </div>
                                        <div class="col-md-3">
                                        
                                            <select class="form-control input-sm" id="category" name="category">
                                                <option disabled selected value> -- select a category -- </option>
                                                <option value="1">Programming</option>
                                                <option value="2">Lifestyle</option>
                                                <option value="3">Financial</option>
                                                <option value="4">Art</option>
                                                <option value="5">Gaming</option>
                                                <option value="6">Business</option>
                                                <option value="7">Politics</option>
                                                <option value="8">Entertainment</option>
                                            </select>
                                            @if ($errors->has('category'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-block">Ask</button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
