<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
Use Session;
use Auth;
class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $userId = Auth::id();
        $feedbacks = DB::table('feedbacks')->where('given_by',$userId)->simplePaginate(10);
        $stations = DB::table('stations')->get();
        $transports = DB::table('transports')->get();
        return view('user.feedback',compact('feedbacks'));
    }

    public function destroy($id)
    {
        DB::table('feedbacks')->delete($id);
        Session::flash('success','Feedback deleted');            
        return redirect()->back();
    }
}
