<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $transports = DB::table('transports')->where('posted_by',$userId)->count();
        $stations = DB::table('stations')->where('posted_by',$userId)->count();
        $routes = DB::table('routes')->where('posted_by',$userId)->count();
        $feedbacks = DB::table('feedbacks')->where('given_by',$userId)->count();
        return view('home',compact('transports','stations','routes','feedbacks'));
    }
}
