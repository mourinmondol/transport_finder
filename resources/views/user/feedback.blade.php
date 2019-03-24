@extends('layouts.user') 
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('css/chosenCss/prism.css')}}">
    <link rel="stylesheet" href="{{asset('css/chosenCss/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
@endsection
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <h4> Feedback List</h4>
                <div class="table-fix">
                    <table class="table-edit" >
                        <tr>
                            <th>Type</th>
                            <th>Reason</th>
                            <th>Given To</th>
                            <th>Given By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{$feedback->feedback_type}}</td>
                            <td>{{$feedback->feedback_comment}}</td>
                            <td>
                            @php
                                $transport = App\Http\Controllers\FeedbackController::getBus($feedback->given_to_id);
                                echo $transport->transport_name." ". $transport->transport_type;
                                @endphp
                            </td>
                            <td>
                                @php
                                echo App\Http\Controllers\FeedbackController::getUser($feedback->given_by);
                                @endphp
                            </td>
                            <td>@if($feedback->feedback_status == '1') Active @else Inactive @endif</td>
                            <td>
                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('feedback_delete_user',$feedback->id)}}" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i>X</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="text-center">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script src="{{asset('js/chosenJs/chosen.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/chosenJs/prism.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript" charset="utf-8"></script>
    
    <script>
        $(".chosen-select-type").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });

        $(".chosen-select-group").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });

        $(".chosen-select-member").chosen({
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });

        
        $( "#startdate" ).datepicker({
            inline: true,
            changeYear: true
        });
        
        $( "#finishdate" ).datepicker({
            inline: true,
            changeYear: true
        });
    </script>
@endsection