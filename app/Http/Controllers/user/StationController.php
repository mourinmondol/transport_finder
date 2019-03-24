<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
Use Session;
use Auth;
class StationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $stations = DB::table('stations')->where('posted_by',$userId)->simplePaginate(10);
        return view('user.station',compact('stations'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'station_name'=>'required|max:255',
            'station_type'=>'required|max:255',
            'station_description'=>'nullable',
            'station_lat'=>'required|max:255',
            'station_long'=>'required|max:255',
        ]);
        $station_name = $request->input('station_name');
        $station_type = $request->input('station_type');
        $station_long = $request->input('station_long');
        $station_lat = $request->input('station_lat');
        $station_description = $request->input('station_description');
        $posted_by = Auth::id();
        if ($request->hasFile('station_image')) {
            if($request->file('station_image')->isValid()) {
                try {
                    $file = $request->file('station_image');
                    $imagePath = time() . '.' . $file->getClientOriginalExtension();
                    $request->file('station_image')->move("uploads", $imagePath);
                    $station_image = $imagePath;
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
        
                }
            } 
        }
        $data=array('station_name' => $station_name, 'station_type' => $station_type, 'station_description' => $station_description, 'station_image' => $station_image, 'posted_by' => $posted_by, 'station_lat' => $station_lat, 'station_long' => $station_long);
        DB::table('stations')->insert($data);
        $request->session()->flash('alert-success', 'Station successful added!');
        return redirect()->route("user.station");
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('group','member','image','video')->where('id', $id)->first();
        return view('postDetails',compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $userId = Auth::id();
        $stations = DB::table('stations')->where('posted_by',$userId)->simplePaginate(10);
        $all_station = DB::table('stations')->get();
        $stationEditInfo = DB::table('stations')->find($id);
        return view('user.station',compact('stations','stationEditInfo','all_station'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $station=DB::table('stations')->where('id', $id)->first();
        $station_name = $request->station_name;
        $station_type = $request->station_type;
        $station_image = $request->station_image;
        $station_lat = $request->station_lat;
        $station_long = $request->station_long;
        $station_description = $request->station_description;
        if ($request->hasFile('station_image')) {
            if($request->file('station_image')->isValid()) {
                try {
                    $file = $request->file('station_image');
                    $station_image = time() . '.' . $file->getClientOriginalExtension();
                    $request->file('station_image')->move("uploads", $station_image);
                    $station_image = $station_image;
                    $data=DB::table('stations')->where('id', $id)->first();
                    if(file_exists("uploads/".$data->station_image)){
                        File::delete("uploads/".$data->station_image);
                    }

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
        
                }
            }
        }else{
            $data=DB::table('stations')->where('id', $id)->first();
            $station_image=$data->station_image;
        } 
        DB::table('stations')->where('id', $id)->update(['station_name' => $station_name, 'station_type' => $station_type, 'station_description' => $station_description, 'station_image' => $station_image, 'station_lat' => $station_lat, 'station_long' => $station_long]);

        $request->session()->flash('alert-success', 'Station successful added!');
        return redirect()->route("user.station");
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $station=DB::table('stations')->find($id);
        if(isset($station)){
            if(file_exists("uploads/".$station->station_image)){
                File::delete("uploads/".$station->station_image);
            }
        }
        DB::table('stations')->delete($id);
        Session::flash('success','Station deleted');            
        return redirect()->back();
    }
}
