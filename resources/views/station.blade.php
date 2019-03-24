@extends('layouts.admin') 
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
                <h4> Station List</h4>
                <div class="table-fix">
                    <table class="table-edit" >
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Latitude</th>
                            <th>Longtitude</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($stations as $station)
                        <tr>
                            <td>{{$station->station_name}}</td>
                            <td>{{$station->station_type}}</td>
                            <td>{{$station->station_lat}}</td>
                            <td>{{$station->station_long}}</td>
                            <td>{{$station->station_description}}</td>
                            <td><img src="{{asset('uploads/'.$station->station_image)}}" width="42" height="42"></td>
                            <td>@if($station->station_status == '1') Active @else Inactive @endif</td>
                            <td>
                            <a href="{{route('station_edit',$station->id)}}" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i>E</a>
                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('station_delete',$station->id)}}" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i>X</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="text-center">
            {{ $stations->links() }}
            </div>
        </div>
        <div class="col-md-5">
            <div class="well">
                @if(isset($stationEditInfo)) 
                    <h4>Update Station </h4>
                @else
                    <h4>Add Station </h4>
                @endif
                <form action="@if(isset($stationEditInfo)) {{ route ('station_update',['id'=>$stationEditInfo->id]) }} @else {{route('admin.store.station')}} @endif" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="station_name">Station Name:</label>
                        <input type="text" name="station_name" class="form-control" id="station_name" @if(isset($stationEditInfo)) value='{{$stationEditInfo->station_name}}' @endif >
                    </div>
                    <div class="form-group">
                        <label for="station_type">Type:</label>
                        <select name="station_type" class="chosen-select-group form-control"  data-placeholder="Choose type..." >
                        @if(isset($stationEditInfo))
                                @if($stationEditInfo->station_type == 'Bus')
                                <option value="Bus" selected>Bus</option>
                                <option value="Train">Train</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Airplane</option>
                                <option value="Airplane">Others</option>
                                @elseif($stationEditInfo->station_type == 'Train')
                                <option value="Train" selected>Train</option>
                                <option value="Bus">Bus</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Airplane</option>
                                <option value="Airplane">Others</option>
                                @elseif($stationEditInfo->station_type == 'Launch')
                                <option value="Launch" selected>Launch</option>
                                <option value="Bus">Bus</option>
                                <option value="Train">Train</option>
                                <option value="Airplane">Airplane</option>
                                <option value="Airplane">Others</option>
                                @elseif($stationEditInfo->station_type == 'Airplane')
                                <option value="Bus">Bus</option>
                                <option value="Train">Train</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Others</option>
                                <option value="Airplane" selected>Airplane</option>
                                @elseif($stationEditInfo->station_type == 'Others')
                                <option value="Airplane" selected>Others</option>
                                <option value="Bus">Bus</option>
                                <option value="Train">Train</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Airplane</option>
                                @endif
                            @else
                                <option value="Bus">Bus</option>
                                <option value="Train">Train</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Airplane</option>
                                <option value="Airplane">Others</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="station_lat">Latitude:</label>
                        <input type="text" name="station_lat" class="form-control" id="station_lat" @if(isset($stationEditInfo)) value='{{$stationEditInfo->station_lat}}' @endif >
                    </div>
                    <div class="form-group">
                        <label for="station_long">Longtitude:</label>
                        <input type="text" name="station_long" class="form-control" id="station_long" @if(isset($stationEditInfo)) value='{{$stationEditInfo->station_long}}' @endif >
                    </div>
                    <div class="form-group">
                        <label for="station_description">Description:</label>
                        <textarea name="station_description" class="form-control" id="station_description" rows="3">@if(isset($stationEditInfo)){{$stationEditInfo->station_description}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="station_image">Image:</label>
                        <input type="file" accept="image/*" name="station_image" class="form-control" id="station_image" />
                    </div>
                    <div class="form-group">
                        <label for="station_status">Status</label>
                        <select name="station_status" class="chosen-select-member form-control"  data-placeholder="Choose offday...">
                        @if(isset($stationEditInfo))
                                @if($stationEditInfo->station_status == '1')
                                <option value="1" selected>Active</option>
                                <option value="0" >Inactive</option>
                                @else
                                <option value="0" selected>Inactive</option>
                                <option value="1" >Active</option>
                                @endif
                            @else
                                <option value="1" >Active</option>
                                <option value="0" >Inactive</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">
                        @if(isset($stationEditInfo)) 
                            <h4>Update Station </h4>
                        @else
                            <h4>Add Station </h4>
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