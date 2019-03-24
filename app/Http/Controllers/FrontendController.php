<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FrontendController extends Controller
{
    public function index()
    {
        $stations = DB::table('stations')->get();
        return view('welcome',compact('stations'));
    }

    public function search()
    {
        return view('search');
    }

    public function about()
    {
        return view('about');
    }

    public function docs()
    {
        return view('docs');
    }
    public function contact()
    {
        return view('contact');
    }
    public function transport_profile()
    {
        return view('transport_profile');
    }
    public function station_profile()
    {
        return view('station_profile');
    }
    public function search_route()
    {
        return view('search_route');
    }
    public function search_result()
    {
        return view('search_result');
    }
    public function give_feedback()
    {
        return view('give_feedback');
    }
}
