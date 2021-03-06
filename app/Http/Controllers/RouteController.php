<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
Use File;
class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $stations = DB::table('stations')->get();
        $transports = DB::table('transports')->get();
        $routes = DB::table('routes')->simplePaginate(10);
        return view('route',compact('routes','stations','transports'));
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        //dd($lat2);
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);
          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
      }
      

    public function store(Request $request)
    {
        $this->validate($request,[
            'route_SSID'=>'required',
            'route_DSID'=>'required',
            'route_TID'=>'nullable',
            'route_fare'=>'required',
            'route_description'=>'nullable',
            'route_status'=>'nullable',
        ]);
        $route_SSID = $request->input('route_SSID');
        $route_DSID = $request->input('route_DSID');
        $route_TID = $request->input('route_TID');
        $route_fare = $request->input('route_fare');
        $route_description = $request->input('route_description');
        $route_status = $request->input('route_status');
        $first_station = DB::table('stations')->find($route_SSID);
        $second_station = DB::table('stations')->find($route_DSID);
        $route_distance = $this->distance($first_station->station_lat, $first_station->station_long, $second_station->station_lat, $second_station->station_long, "K");
        $data=array('route_SSID' => $route_SSID, 'route_DSID' => $route_DSID, 'route_TID' => $route_TID, 'route_fare' => $route_fare, 'route_description' => $route_description, 'route_status' => $route_status, 'route_distance' => $route_distance);
        DB::table('routes')->insert($data);
        $request->session()->flash('alert-success', 'Route successful added!');
        return redirect()->route("admin.route");
    }

    public function show($id)
    {
        $post = Post::with('group','member','image','video')->where('id', $id)->first();
        return view('postDetails',compact('post'));
    }

    public function edit($id){

        $routes = DB::table('routes')->simplePaginate(10);
        $stations = DB::table('stations')->get();
        $transports = DB::table('transports')->get();
        $all_route = DB::table('routes')->get();
        $routeEditInfo = DB::table('routes')->find($id);
        return view('route',compact('routes','routeEditInfo','all_route','stations','transports'));
    }

    public function update(Request $request, $id)
    {
        $station=DB::table('stations')->where('id', $id)->first();

        $route_SSID = $request->route_SSID;
        $route_DSID = $request->route_DSID;
        $route_TID = $request->route_TID;
        $route_fare = $request->route_fare;
        $route_description = $request->route_description;
        $route_status = $request->route_status;

        $first_station = DB::table('stations')->find($route_SSID);
        $second_station = DB::table('stations')->find($route_DSID);
        //dd($second_station);
        $route_distance = $this->distance($first_station->station_lat, $first_station->station_long, $second_station->station_lat, $second_station->station_long, "K");
        //dd($route_distance);
        DB::table('routes')->where('id', $id)->update(['route_SSID' => $route_SSID, 'route_DSID' => $route_DSID, 'route_TID' => $route_TID, 'route_fare' => $route_fare, 'route_description' => $route_description, 'route_status' => $route_status, 'route_distance' => $route_distance]);

        $request->session()->flash('alert-success', 'Route successful updated!!');
        return redirect()->route("admin.route");
    }

    public function destroy($id)
    {
        DB::table('stations')->delete($id);
        Session::flash('success','Station deleted');            
        return redirect()->back();
    }
}
