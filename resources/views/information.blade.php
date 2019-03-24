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
                <h4> Information List</h4>
                <div class="table-fix">
                    <table class="table-edit" >
                        <tr>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($informations as $information)
                        <tr>
                            <td>{{$information->information_type}}</td>
                            <td>{{$information->information_description}}</td>
                            <td>
                            <a href="{{route('information_edit',$information->id)}}" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i>E</a>
                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('information_delete',$information->id)}}" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i>X</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="text-center">
            {{ $informations->links() }}
            </div>
            </div>
        <div class="col-md-5">
            <div class="well">
                @if(isset($informationEditInfo)) 
                    <h4>Update Information </h4>
                @else
                    <h4>Add Information </h4>
                @endif
                <form action="@if(isset($informationEditInfo)) {{ route ('information_update',['id'=>$informationEditInfo->id]) }} @else {{route('admin.store.information')}} @endif" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="information_type">Type:</label>
                        <select name="information_type" class="chosen-select-group form-control"  data-placeholder="Choose type..." >
                            @if(isset($informationEditInfo))
                                @if($informationEditInfo->information_type=="About")
                                    <option value="About" selected>About</option>
                                    <option value="Docs">Docs</option>
                                @elseif($informationEditInfo->information_type=="Docs")
                                    <option value="Docs" selected>Docs</option>
                                    <option value="About">About</option>
                                @endif
                            @else
                                <option value="About">About</option>
                                <option value="Docs">Docs</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="information_description">Description:</label>
                        <textarea name="information_description" class="form-control" id="information_description" rows="3">@if(isset($informationEditInfo)){{$informationEditInfo->information_description}}@endif</textarea>
                    </div>
                    <button type="submit" class="btn btn-default">
                        @if(isset($informationEditInfo)) 
                            <h4>Update Information </h4>
                        @else
                            <h4>Add Information </h4>
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