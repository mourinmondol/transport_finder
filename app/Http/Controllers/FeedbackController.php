<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $feedbacks = DB::table('feedbacks')->simplePaginate(10);
        $stations = DB::table('stations')->get();
        $transports = DB::table('transports')->get();
        return view('feedback',compact('feedbacks'));
    }

    public static function getUser($id){
        $user = DB::table('users')->where('id',$id)->first();
        return $user->name;
    }
    public static function getBus($id){
        $transport = DB::table('transports')->where('id',$id)->first();
        return $transport;
    }
    public static function getStation($id){
        $stations = DB::table('stations')->where('id',$id)->first();
        return $stations->station_name;
    }

    public function edit($id){

        $feedbacks = DB::table('feedbacks')->simplePaginate(10);
        $stations = DB::table('stations')->get();
        $transports = DB::table('transports')->get();
        $all_route = DB::table('routes')->get();
        $feedbackEditInfo = DB::table('feedbacks')->find($id);
        return view('feedback',compact('feedbacks','feedbackEditInfo','all_route','stations','transports'));
    }

    public function update(Request $request, $id)
    {
        $station=DB::table('feedbacks')->where('id', $id)->first();
        $feedback_status = $request->feedback_status;
        DB::table('feedbacks')->where('id', $id)->update(['feedback_status' => $feedback_status]);

        $request->session()->flash('alert-success', 'Feedback successful updated!!');
        return redirect()->route("admin.feedback");
    }

    public function destroy($id)
    {
        DB::table('feedbacks')->delete($id);
        Session::flash('success','Feedback deleted');            
        return redirect()->back();
    }
}
