<?php

namespace App\Http\Controllers\market;

use App\Http\Controllers\Controller;

use App\Models\Creative;
use Illuminate\Http\Request;
use App\Models\EmpClient;
use App\Models\User;
use File;

class CreativeController extends Controller
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
            $files=Creative::where('client_id' , $client->id);
            
            if($request->keyword){
                $files->where('name', 'like', '%'.$request->keyword.'%');
            }

            if($request->sort && $request->sort == 'oldest'){
                $files->orderBy('updated_at', 'ASC');
            }else{
                $files->orderBy('updated_at', 'DESC');
            }
            
            $data['digitals']=$files->paginate(6);
            return view('main.creative.client-index', $data);
        }else{
            $digitals=Creative::orderby('updated_at', 'DESC');
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
            return view('main.creative.index', $data);
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
        return view('main.creative.create', $data);
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
            $exist=Creative::where('name', $request->name)->first();

            $old_filepath = public_path('upload/creative/').$exist->full_name;
            if(File::exists($old_filepath)) {
                File::delete($old_filepath);
            }
            
            $file=$request->file;
            $file->move(public_path('upload/creative'), $exist->full_name);
            return redirect()->route('creative.index')->with(['success' => __('general.Replace Success')]);

        }else{
            $client=$request->client;
            $name=$request->name;
            $file=$request->file;
            $type=explode('/', $file->getMimeType())[0];

            $ext=$file->getClientOriginalExtension();

            $file->move(public_path('upload/creative'), $name.".".$ext);
            $digital=Creative::create([
                'user_id' => auth()->user()->id,
                'client_id' => $client,
                'name'=> $name,
                'ext' => $ext,
                'type'=>$type
            ]);
            
            return redirect()->route('creative.index')->with(['success' => __('general.Create Success')]);
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
        $data['digital']=Creative::find($id);
        $data['clients']=available_client();
        return view('main.creative.edit', $data);
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
        
        $digital=Creative::find($id);
        $file=$request->file;
        $name=$request->name;

        if($file){
            $old_filepath = public_path('upload/creative/').$digital->full_name;
            if(File::exists($old_filepath)) {
                File::delete($old_filepath);
            }

            $type=explode('/', $file->getMimeType())[0];
            $ext=$file->getClientOriginalExtension();
            $file->move(public_path('upload/creative'), $name.".".$ext);
            $digital->ext=$ext;
            $digital->type=$type;
        }else{
            rename(public_path('upload/creative/').$digital->full_name, public_path('upload/creative/').$name.".".$digital->ext);
        }
        $digital->name=$name;
        $digital->client_id=$client;
        $digital->user_id=auth()->user()->id;
        $digital->save();
        
        return redirect()->route('creative.index')->with(['success' => __('general.Update Success')]);
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
        // $file->move(public_path('upload/creative'), $name);

        // $digital=Creative::create([
        //     'user_id' => auth()->user()->id,
        //     'name'=> $name
        // ]);
        // return response()->json($digital);
    
    }

    public function delete(Request $request){
        $digital=Creative::find($request->id);
        $filepath = public_path('upload/creative/').$digital->full_name;
        if(File::exists($filepath)) {
            File::delete($filepath);
        }
        Creative::destroy($request->id);
        return response()->json(true); 
    }
}
