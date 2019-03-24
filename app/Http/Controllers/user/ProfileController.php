<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use FIle;
Use Session;
use Auth;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $userId = Auth::id();
        $users = DB::table('users')->where('id',$userId)->simplePaginate(10);
        return view('user.profile',compact('users'));
    }

    public function edit($id){

        $userId = Auth::id();
        $users = DB::table('users')->where('id',$userId)->simplePaginate(10);
        $userEditInfo = DB::table('users')->find($id);
        return view('user.profile',compact('users','userEditInfo'));
    }

    public function update(Request $request, $id)
    {
        $users=DB::table('users')->where('id', $id)->first();
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        DB::table('users')->where('id', $id)->update(['name' => $name, 'email' => $email, 'password' => $password]);

        $request->session()->flash('alert-success', 'User successful updated!');
        return redirect()->route("user.profile");
    }

    public function destroy($id)
    {
        DB::table('users')->delete($id);
        Session::flash('success','User deleted');            
        return redirect()->back();
    }
}
