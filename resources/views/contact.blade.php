@extends('layouts.app')
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                Contact us
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
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control" id="email">
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