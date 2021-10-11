<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Models\EmpClient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users']=User::where('id', '!=', Auth::user()->id)->where('role','client')->where('active', 1)->orderby('updated_at', 'DESC')->get();
        return view('manage.client.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required','email','unique:users']
        ]);
        $file=$request->file;
        $filename=time().".".$request->file->extension();
        $file->move(public_path('assets/profile'), $filename);
        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role' => 'client',
            'photo' => $filename,
        ]);
        return redirect()->route('client.index')->with(['success' => true, 'message'=>'store success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user']=User::find($id);
        return view('manage.client.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
   
        $updated_data=[
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];
        if($request->password){
            $updated_data['password'] = Hash::make($request->password);
        }
        if($request->file){
            $file=$request->file;
            $filename=time().".".$request->file->extension();
            $file->move(public_path('assets/profile'), $filename);
            $updated_data['photo'] = $filename;
        }
        
        User::find($id)->update($updated_data);

        return redirect()->route('client.index')->with(['success'=>true, 'message'=>'update success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request){
        User::find($request->id)->update([
            'active' => 0
        ]);
        return response()->json(true); 
    }
}
