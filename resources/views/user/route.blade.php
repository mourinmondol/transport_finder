@extends('layouts.user') 
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('css/chosenCss/prism.css')}}">
    <link rel="stylesheet" href="{{asset('css/chosenCss/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
@endsection
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="well">
                <h4> Route List</h4>
                <div class="table-fix">
                    <table class="table-edit" >
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Transport</th>
                            <th>Fare</th>
                            <th>Distance</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($routes as $route)
                        <tr>
                        <td>
                                @php
                                echo App\Http\Controllers\FeedbackController::getStation($route->route_SSID);
                                @endphp</td>
                            <td>
                                @php
                                echo App\Http\Controllers\FeedbackController::getStation($route->route_DSID);
                                @endphp
                            </td>
                            <td>
                                @php
                                $transport = App\Http\Controllers\FeedbackController::getBus($route->route_TID);
                                echo $transport->transport_name;
                                @endphp
                            </td>
                            <td>{{$route->route_fare}}</td>
                            <td>{{$route->route_distance}}</td>
                            <td>{{$route->route_description}}</td>
                            
                            <td>@if($route->route_status == '1') Active @else Inactive @endif</td>
                            <td>
                            <a href="{{route('route_edit_user',$route->id)}}" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i>E</a>
                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('route_delete_user',$route->id)}}" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i>X</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="text-center">
            {{ $routes->links() }}
            </div>
            </div>
        <div class="col-md-5">
            <div class="well">
                @if(isset($routeEditInfo)) 
                    <h4>Update Route </h4>
                @else
                    <h4>Add Route </h4>
                @endif
                <form action="@if(isset($routeEditInfo)) {{ route ('route_update_user',['id'=>$routeEditInfo->id]) }} @else {{route('user.store.route')}} @endif" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="route_SSID">From:</label>
                        <select class="form-control form-control-lg" name="route_SSID">
                        @foreach($stations as $station)
                            @if(isset($routeEditInfo))
                                @if($routeEditInfo->route_SSID == $station->id)
                                <option value="{{$routeEditInfo->route_SSID}}" selected>{{$station->station_name}}</option>
                                @else
                                <option value="{{$station->id}}">{{$station->station_name}}</option>
                                @endif
                            @else
                                <option value="{{$station->id}}">{{$station->station_name}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="route_DSID">To:</label>
                        <select class="form-control form-control-lg" name="route_DSID">
                        @foreach($stations as $station)
                            @if(isset($routeEditInfo))
                                @if($routeEditInfo->route_SSID == $station->id)
                                <option value="{{$routeEditInfo->route_SSID}}" selected>{{$station->station_name}}</option>
                                @else
                                <option value="{{$station->id}}">{{$station->station_name}}</option>
                                @endif
                            @else
                                <option value="{{$station->id}}">{{$station->station_name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="route_TID">Transport:</label>
                        <select class="form-control form-control-lg" name="route_TID">
                        @foreach($transports as $transport)
                            @if(isset($routeEditInfo))
                                @if($routeEditInfo->route_TID == $transport->id)
                                <option value="{{$transport->id}}" selected>{{$transport->transport_name}}</option>
                                @else
                                <option value="{{$transport->id}}">{{$transport->transport_name}}</option>
                                @endif
                            @else
                                <option value="{{$transport->id}}">{{$transport->transport_name}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="route_fare">Fare:</label>
                        <input type="text" name="route_fare" class="form-control" id="route_fare" @if(isset($routeEditInfo)) value='{{$routeEditInfo->route_fare}}' @endif >
                    </div>
                    <div class="form-group">
                        <label for="route_description">Description:</label>
                        <textarea name="route_description" class="form-control" id="route_description" rows="3">@if(isset($routeEditInfo)){{$routeEditInfo->route_description}}@endif</textarea>
                    </div>
                    <button type="submit" class="btn btn-default">
                        @if(isset($routeEditInfo)) 
                            <h4>Update Route </h4>
                        @else
                            <h4>Add Route </h4>
                        @endif
                    </button>
                </form>
            </div>
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