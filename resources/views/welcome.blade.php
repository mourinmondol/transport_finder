@extends('layouts.app')
@section('content')
<div class="text-center" >
                <h1 >Transport Finder</h1>
                <form method="GET" action="{{route('search_route')}}" class="searching">
                <select class="form-control  form-control-lg " name="route_SSID">
                        @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->station_name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-lg " name="route_DSID">
                        @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->station_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-default btn-sd">Search</button>
                </form>
                </div>
@endsection
