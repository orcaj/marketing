<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Models\EmpClient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users']=User::where('id', '!=', Auth::user()->id)->where('role','emp')->where('active', 1)->orderby('updated_at', 'DESC')->get();
        return view('manage.emp.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registed_clients=EmpClient::groupby('client_id')->pluck('client_id');
        $data['clients']=User::where('role', 'client')->where('active', 1)->whereNotIn('id',$registed_clients )->get();
        return view('manage.emp.create', $data);
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
            'email' => 'required|email|unique:users',
        ]);
        
        $emp=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => 'emp',
            'password' => Hash::make($request->password),
        ]);

        $clients=$request->client;
        if($clients){
            foreach ($clients as $key => $client) {
                EmpClient::create([
                    'emp_id' => $emp->id,
                    'client_id' => $client
                ]);
            }
        }
        
        return redirect()->route('emp.index')->with(['success' => true, 'message' => 'store success']);
   
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
        $registed_clients=EmpClient::groupby('client_id')->pluck('client_id');
        $own_clients=EmpClient::where('emp_id', $id)->pluck('client_id');
        $data['free_clients']=User::where('role', 'client')->where('active', 1)->whereNotIn('id',$registed_clients )->get();
        $data['own_clients']=User::where('role', 'client')->where('active', 1)->whereIn('id',$own_clients)->get();
        

        $data['emp']=User::find($id);
        return view('manage.emp.edit', $data);
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

        if($request->password){
            $updated_data=[
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ];
        }else{
            $updated_data=[
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
            ];
        }
        $emp=User::find($id)->update($updated_data);

        // delete old data
        EmpClient::where('emp_id', $id)->delete();

        $clients=$request->client;
        if($clients){
            foreach ($clients as $key => $client) {
                EmpClient::create([
                    'emp_id' => $id,
                    'client_id' => $client
                ]);
            }
        }

        return redirect()->route('emp.index')->with(['success' => true, 'message' => 'update success']);
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
