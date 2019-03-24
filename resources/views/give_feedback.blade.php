@extends('layouts.app')
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                Give Feedback
            </h2>
        </div>
        <div class="panel-body">
<div class="row">
<div class="col-md-7">
            </div>
            <div class="col-md-5">
                <div class="well">
                    <form action="/contact" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="feedback_type">Type:</label>
                            <select id="feedback_type" name="feedback_type" class="form-control">
                              <option value="australia">Like</option>
                              <option value="canada">Dislike</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="feedback_comment">Reason:</label>
                            <textarea name="feedback_comment" class="form-control" id="feedback_comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Send message</button>
                    </form>

                </div>
            </div>

        </div>
        </div>
    </div>
</div>
@endsection