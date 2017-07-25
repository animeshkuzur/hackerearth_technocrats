 <div id="askModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ask your Question</h4>
        </div>
        <div class="modal-body">
          <form id="loginForm" class="form" method="POST" action="{{ route('add_question') }}">
          {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12 form-group {{ $errors->has('title') ? ' has-error' : '' }}" >
                <label class="form-label">Type your question</label>
                <input type="text" name="title" required="required" maxlength="60" placeholder="Write your question in brief..." class="input form-control" autocomplete="off">
                @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label class="form-label">Describe your question</label>
                <textarea placeholder="Explain what is your question about in detail..." class="input form-control" name="description" id="description"></textarea>
                @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                <label class="form-label">Tags</label>
                <input type="text" id="tags" name="tags" required="required" maxlength="60" placeholder="tag1, tag2, tag3 ( seperate each tag with a comma )" class="input form-control" autocomplete="off">
                @if ($errors->has('tags'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tags') }}</strong>
                                                </span>
                                            @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <label class="form-label">Catgeory</label>
                <div class="select">
                  <select class="select-category" id="category" name="category">
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
            <div class="row submit">
              <div class="col-md-12 form-group text-center">
                <button type="submit" id="login_save" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
          
        </div>
      </div>

    </div>
  </div>