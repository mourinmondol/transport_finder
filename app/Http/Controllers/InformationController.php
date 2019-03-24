<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $informations = DB::table('informations')->simplePaginate(10);
        return view('information',compact('informations'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'information_type'=>'required|max:255',
            'information_description'=>'required|max:255',
        ]);
        $information_type = $request->input('information_type');
        $information_description = $request->input('information_description');
        $data=array('information_type'=>$information_type,'information_description'=>$information_description);
        DB::table('informations')->insert($data);
        $request->session()->flash('alert-success', 'Information successful added!');
        return redirect()->route("admin.information");
    }

    public function show($id)
    {
        $post = Post::with('group','member','image','video')->where('id', $id)->first();
        return view('postDetails',compact('post'));
    }

    public function edit($id){

        $informations = DB::table('informations')->simplePaginate(10);
        $informationEditInfo = DB::table('informations')->find($id);
        return view('information',compact('informations','informationEditInfo'));
    }

    public function update(Request $request, $id)
    {
        $informations=DB::table('informations')->where('id', $id)->first();
        $information_type = $request->information_type;
        $information_description = $request->information_description;
        DB::table('informations')->where('id', $id)->update(['information_type' => $information_type, 'information_description' => $information_description]);

        $request->session()->flash('alert-success', 'Information successful updated!');
        return redirect()->route("admin.information");
    }

    public function destroy($id)
    {
        DB::table('informations')->delete($id);
        Session::flash('success','Information deleted');            
        return redirect()->back();
    }
}
