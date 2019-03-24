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
                <h4> Transport List</h4>
                <div class="table-fix">
                    <table class="table-edit" >
                        <tr>
                            <th>Transport Name</th>
                            <th>Transport Type</th>
                            <th>Transport Description</th>
                            <th>Transport Image</th>
                            <th>Transport Status</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($transports as $transport)
                        <tr>
                            <td>{{$transport->transport_name}}</td>
                            <td>{{$transport->transport_type}}</td>
                            <td>{{$transport->transport_description}}</td>
                            <td><img src="{{asset('uploads/'.$transport->transport_image)}}" width="42" height="42"></td>
                            <td>@if($transport->transport_status == '1') Active @else Inactive @endif</td>
                            <td>
                            <a href="{{route('transport_edit',$transport->id)}}" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i>E</a>
                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('transport_delete',$transport->id)}}" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i>X</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="text-center">
                    {{ $transports->links() }}
            </div>
        </div>
        <div class="col-md-5">
            <div class="well">
                @if(isset($transportEditInfo))
                    <h4>Update Transport </h4>
                @else
                    <h4>Add Transport </h4>
                @endif
                <form action="@if(isset($transportEditInfo)) {{ route ('transport_update',['id'=>$transportEditInfo->id]) }} @else {{route('admin.store.transport')}} @endif" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="transport_name">Transport Name:</label>
                        <input type="text" name="transport_name" class="form-control" id="transport_name" @if(isset($transportEditInfo)) value='{{$transportEditInfo->transport_name}}' @endif  >
                    </div>
                    <div class="form-group">
                        <label for="transport_type">Transport Type:</label>
                        <select name="transport_type" class="chosen-select-group form-control"  data-placeholder="Choose type..." >
                            @if(isset($transportEditInfo))
                                @if($transportEditInfo->transport_type == 'Bus')
                                <option value="Bus" selected>Bus</option>
                                <option value="Train">Train</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Airplane</option>
                                <option value="Airplane">Others</option>
                                @elseif($transportEditInfo->transport_type == 'Train')
                                <option value="Train" selected>Train</option>
                                <option value="Bus">Bus</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Airplane</option>
                                <option value="Airplane">Others</option>
                                @elseif($transportEditInfo->transport_type == 'Launch')
                                <option value="Launch" selected>Launch</option>
                                <option value="Bus">Bus</option>
                                <option value="Train">Train</option>
                                <option value="Airplane">Airplane</option>
                                <option value="Airplane">Others</option>
                                @elseif($transportEditInfo->transport_type == 'Airplane')
                                <option value="Bus">Bus</option>
                                <option value="Train">Train</option>
                                <option value="Launch">Launch</option>
                                <option value="Airplane">Others</option>
                                <option value="Airplane" selected>Airplane</option>
                                @elseif($transportEditInfo->transport_type == 'Others')
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
                        <label for="transport_description">Description:</label>
                        <textarea name="transport_description" class="form-control" id="transport_description" rows="3">@if(isset($transportEditInfo)) {{$transportEditInfo->transport_description}} @endif </textarea>
                    </div>
                    <div class="form-group">
                        <label for="transport_image">Image:</label>
                        <input type="file" accept="image/*" name="transport_image" class="form-control" id="transport_image" />
                    </div>
                    <div class="form-group">
                        <label for="transport_status">Status</label>
                        <select name="transport_status" class="chosen-select-member form-control"  data-placeholder="Choose offday...">
                            @if(isset($transportEditInfo))
                                @if($transportEditInfo->transport_status == '1')
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
                        @if(isset($transportEditInfo)) 
                            <h4>Update Transport </h4>
                        @else
                            <h4>Add Transport </h4>
                        @endif
                    </button>
                </form>
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