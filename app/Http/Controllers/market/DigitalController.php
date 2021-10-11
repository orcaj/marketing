<?php

namespace App\Http\Controllers\market;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Emp;
use App\Models\Digital;
use App\Models\EmpClient;
use App\Models\User;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use File;

class DigitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=auth()->user();
        $role=$user->role;
        if($role == 'client'){
            $client=auth()->user();
            $files=Digital::where('client_id' , $client->id);
            
            if($request->keyword){
                $files->where('name', 'like', '%'.$request->keyword.'%');
            }

            if($request->sort && $request->sort == 'oldest'){
                $files->orderBy('updated_at', 'ASC');
            }else{
                $files->orderBy('updated_at', 'DESC');
            }
            
            $data['digitals']=$files->paginate(6);
            return view('main.digital.client-index', $data);
        }else{
            $digitals=Digital::orderby('updated_at', 'DESC');
            if($role == 'emp'){
                $clients_list = EmpClient::where('emp_id' , $user->id)->pluck('client_id');
                $digitals->whereIn('client_id', $clients_list);
            }

            if($request->client){
                $digitals->where('client_id', $request->client);
            }
            if($request->emp){
                $clients=EmpClient::where('emp_id', $request->emp)->pluck('client_id');
                $digitals->whereIn('client_id', $clients);
            }
            $data['digitals']=$digitals->get();
            $data['users']=User::where('role' , '!=', 'client')->get();
            return view('main.digital.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['clients']=available_client();
        return view('main.digital.create', $data);
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
            'name' => ['required']
        ]);

        $replace=$request->replace;
        if($replace == 1){
            $exist=Digital::where('name', $request->name)->first();

            $old_filepath = public_path('upload/digital/').$exist->full_name;
            if(File::exists($old_filepath)) {
                File::delete($old_filepath);
            }
            
            $file=$request->file;
            $file->move(public_path('upload/digital'), $exist->full_name);
            return redirect()->route('digital.index')->with(['success' => __('general.Replace Success')]);

        }else{
            $client=$request->client;
            $name=$request->name;
            $file=$request->file;
            $type=explode('/', $file->getMimeType())[0];

            $ext=$file->getClientOriginalExtension();

            $file->move(public_path('upload/digital'), $name.".".$ext);
            $digital=Digital::create([
                'user_id' => auth()->user()->id,
                'client_id' => $client,
                'name'=> $name,
                'ext' => $ext,
                'type'=>$type
            ]);
            
            return redirect()->route('digital.index')->with(['success' => __('general.Create Success')]);
        }
        
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
        $data['digital']=Digital::find($id);
        $data['clients']=available_client();
        return view('main.digital.edit', $data);
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
            'name' => ['required']
        ]);
        $client=$request->client;
        
        $digital=Digital::find($id);
        $file=$request->file;
        $name=$request->name;

        if($file){
            $old_filepath = public_path('upload/digital/').$digital->full_name;
            if(File::exists($old_filepath)) {
                File::delete($old_filepath);
            }

            $type=explode('/', $file->getMimeType())[0];
            $ext=$file->getClientOriginalExtension();
            $file->move(public_path('upload/digital'), $name.".".$ext);
            $digital->ext=$ext;
            $digital->type=$type;
        }else{
            rename(public_path('upload/digital/').$digital->full_name, public_path('upload/digital/').$name.".".$digital->ext);
        }
        $digital->name=$name;
        $digital->client_id=$client;
        $digital->user_id=auth()->user()->id;
        $digital->save();
        
        return redirect()->route('digital.index')->with(['success' => __('general.Update Success')]);
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

    public function upload(Request $request){
        // $file=$request->file;
        
        // $name=time().rand(1000, 9999).".".$file->extension();
        // $file->move(public_path('upload/digital'), $name);

        // $digital=Digital::create([
        //     'user_id' => auth()->user()->id,
        //     'name'=> $name
        // ]);
        // return response()->json($digital);
    
    }

    public function delete(Request $request){
        $digital=Digital::find($request->id);
        $filepath = public_path('upload/digital/').$digital->full_name;
        if(File::exists($filepath)) {
            File::delete($filepath);
        }
        Digital::destroy($request->id);
        return response()->json(true); 
    }

    // public function client_digital(Request $request){
    //     $client=auth()->user();
    //     $digitals=ClientFile::where(['type'=>'digital', 'client_id' => $client->id])->with('digital')->get();
    //     return response()->json(['productList' => $digitals]);
    // }
}
