<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Session;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $users = DB::table('users')->simplePaginate(10);
        return view('user',compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'password'=>'required',
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->password);
        $data=array('name'=>$name,'email'=>$email,'password'=>$password);
        DB::table('users')->insert($data);
        $request->session()->flash('alert-success', 'User successful added!');
        return redirect()->route("admin.user");
    }

    public function show($id)
    {
        $post = Post::with('group','member','image','video')->where('id', $id)->first();
        return view('postDetails',compact('post'));
    }

    public function edit($id){

        $users = DB::table('users')->simplePaginate(10);
        $userEditInfo = DB::table('users')->find($id);
        return view('user',compact('users','userEditInfo'));
    }

    public function update(Request $request, $id)
    {
        $users=DB::table('users')->where('id', $id)->first();
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        DB::table('users')->where('id', $id)->update(['name' => $name, 'email' => $email, 'password' => $password]);

        $request->session()->flash('alert-success', 'User successful updated!');
        return redirect()->route("admin.user");
    }

    public function destroy($id)
    {
        DB::table('users')->delete($id);
        Session::flash('success','User deleted');            
        return redirect()->back();
    }
}
