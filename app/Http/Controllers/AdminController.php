<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transports = DB::table('transports')->count();
        $stations = DB::table('stations')->count();
        $routes = DB::table('routes')->count();
        $users = DB::table('users')->count();
        $feedbacks = DB::table('feedbacks')->count();
        $informations = DB::table('informations')->count();
        return view('admin_home',compact('transports','stations','routes','users','feedbacks','informations'));
    }
}
