<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
Use Session;
use Auth;
class TransportController extends Controller
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
        $transports = DB::table('transports')->where('posted_by',$userId)->simplePaginate(10);
        return view('user.transport',compact('transports'));
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
            'transport_name'=>'required|max:255',
            'transport_type'=>'required|max:255',
            'transport_description'=>'nullable',
        ]);
        $transport_name = $request->input('transport_name');
        $transport_type = $request->input('transport_type');
        $transport_description = $request->input('transport_description');
        $posted_by = Auth::id();
        if ($request->hasFile('transport_image')) {
            if($request->file('transport_image')->isValid()) {
                try {
                    $file = $request->file('transport_image');
                    $imagePath = time() . '.' . $file->getClientOriginalExtension();
                    $request->file('transport_image')->move("uploads", $imagePath);
                    $transport_image = $imagePath;
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
        
                }
            } 
        }
        $data=array('transport_name'=>$transport_name,'transport_type'=>$transport_type,'transport_description'=>$transport_description,'transport_image'=>$transport_image,'posted_by'=>$posted_by);
        DB::table('transports')->insert($data);
        $request->session()->flash('alert-success', 'Transport successful added!');
        return redirect()->route("user.transport");
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
        $transports = DB::table('transports')->where('posted_by',$userId)->simplePaginate(10);
        $all_transport = DB::table('transports')->get();
        $transportEditInfo = DB::table('transports')->find($id);
        return view('user.transport',compact('transports','transportEditInfo','all_transport'));
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
        $transport=DB::table('transports')->where('id', $id)->first();
        $transport_name = $request->transport_name;
        $transport_type = $request->transport_type;
        $transport_description = $request->transport_description;
        $transport_image = $request->transport_image;
        if ($request->hasFile('transport_image')) {
            if($request->file('transport_image')->isValid()) {
                try {
                    $file = $request->file('transport_image');
                    $transport_image = time() . '.' . $file->getClientOriginalExtension();
                    $request->file('transport_image')->move("uploads", $transport_image);
                    $transport_image = $transport_image;
                    $data=DB::table('transports')->where('id', $id)->first();
                    if(file_exists("uploads/".$data->transport_image)){
                        File::delete("uploads/".$data->transport_image);
                    }

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
        
                }
            }
        }else{
            $data=DB::table('transports')->where('id', $id)->first();
            $transport_image=$data->transport_image;
        } 
        DB::table('transports')->where('id', $id)->update(['transport_name' => $transport_name, 'transport_type' => $transport_type, 'transport_description' => $transport_description, 'transport_image' => $transport_image]);

        $request->session()->flash('alert-success', 'Transport successful updated!');
        return redirect()->route("user.transport");
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transport=DB::table('transports')->find($id);
        if(isset($transport)){
            if(file_exists("uploads/".$transport->transport_image)){
                File::delete("uploads/".$transport->transport_image);
            }
        }
        DB::table('transports')->delete($id);
        Session::flash('success','Post deleted');            
        return redirect()->back();
    }
}
