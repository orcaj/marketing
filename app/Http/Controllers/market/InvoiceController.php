<?php

namespace App\Http\Controllers\market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmpClient;
use App\Models\Invoice;
use App\Models\User;
use File;



class InvoiceController extends Controller
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
            $invoices=Invoice::where('client_id', $user->id)->orderby('updated_at', 'DESC');
        }else{
            $invoices=Invoice::orderby('updated_at', 'DESC');
        }
        
        if($role == 'emp'){
            $clients_list = EmpClient::where('emp_id' , $user->id)->pluck('client_id');
            $invoices->whereIn('client_id', $clients_list);
        }

        if($request->client){
            $invoices->where('client_id', $request->client);
        }
        if($request->emp){
            $clients=EmpClient::where('emp_id', $request->emp)->pluck('client_id');
            $invoices->whereIn('client_id', $clients);
        }
        $data['digitals']=$invoices->get();
        $data['users']=User::where('role' , '!=', 'client')->get();
        return view('main.invoice.index', $data);


        // $user=auth()->user();
        // $role=$user->role;
        // if($role == 'client'){
        //     $client=auth()->user();
        //     $files=Invoice::where('client_id' , $client->id);
            
        //     if($request->keyword){
        //         $files->where('name', 'like', '%'.$request->keyword.'%');
        //     }

        //     if($request->sort && $request->sort == 'oldest'){
        //         $files->orderBy('updated_at', 'ASC');
        //     }else{
        //         $files->orderBy('updated_at', 'DESC');
        //     }
            
        //     $data['digitals']=$files->paginate(6);
        //     return view('main.invoice.client-index', $data);
        // }else{
        //     $invoices=Invoice::orderby('updated_at', 'DESC');
        //     if($role == 'emp'){
        //         $clients_list = EmpClient::where('emp_id' , $user->id)->pluck('client_id');
        //         $invoices->whereIn('client_id', $clients_list);
        //     }

        //     if($request->client){
        //         $invoices->where('client_id', $request->client);
        //     }
        //     if($request->emp){
        //         $clients=EmpClient::where('emp_id', $request->emp)->pluck('client_id');
        //         $invoices->whereIn('client_id', $clients);
        //     }
        //     $data['digitals']=$invoices->get();
        //     $data['users']=User::where('role' , '!=', 'client')->get();
        //     return view('main.invoice.index', $data);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['clients']=available_client();
        return view('main.invoice.create', $data);
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
            'invoice_id' => ['required'],
            'billing_name' => ['required','unique:invoices'],
            'amount' => ['required'],
            'status' => ['required'],
            'client' => ['required'],
        ]);

        $replace=$request->replace;
        if($replace == 1){
            $exist=Invoice::where('name', $request->name)->first();

            $old_filepath = public_path('upload/invoice/').$exist->billing_name;
            if(File::exists($old_filepath)) {
                File::delete($old_filepath);
            }
            
            $file=$request->file;
            $file->move(public_path('upload/invoice'), $exist->billing_name);
            return redirect()->route('invoice.index')->with(['success' => __('general.Replace Success')]);

        }else{
            $client=$request->client;
            $billing_name=$request->billing_name;
            $file=$request->file;
            $ext=$file->getClientOriginalExtension();
            $file->move(public_path('upload/invoice'), $billing_name.".".$ext);

            $invoice=Invoice::create([
                'user_id' => auth()->user()->id,
                'client_id' => $client,
                'billing_name'=> $billing_name,
                'invoice_id'=> $request->invoicd,
                'amount'=> $request->amount,
                'status'=> $request->status,
                'invoice_id'=> $request->invoice_id,
                'type' => $ext
            ]);
            
            return redirect()->route('invoice.index')->with(['success' => __('general.Create Success')]);
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
        $data['invoice']=Invoice::find($id);
        $data['clients']=available_client();
        return view('main.invoice.edit', $data);
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
            'invoice_id' => ['required'],
            'billing_name' => ['required'],
            'amount' => ['required'],
            'status' => ['required'],
            'client' => ['required'],
        ]);
        
        $invoice=Invoice::find($id);
        $file=$request->file;
        $billing_name=$request->billing_name;

        if($file){
            $old_filepath = public_path('upload/invoice/').$invoice->full_name;
            if(File::exists($old_filepath)) {
                File::delete($old_filepath);
            }

            $ext=$file->getClientOriginalExtension();
            $new_billing_name=$billing_name.".".$ext;
            $file->move(public_path('upload/invoice'), $new_billing_name);
            $invoice->type=$ext;
        }else{
            rename(public_path('upload/invoice/').$invoice->full_name, public_path('upload/invoice/').$billing_name.".".$invoice->type);
        }
        $invoice->billing_name=$billing_name;
        $invoice->client_id=$request->client;
        $invoice->invoice_id=$request->invoice_id;
        $invoice->amount=$request->amount;
        $invoice->status=$request->status;
        $invoice->user_id=auth()->user()->id;
        $invoice->save();
        
        return redirect()->route('invoice.index')->with(['success' => __('general.Update Success')]);
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
        // $file->move(public_path('upload/invoice'), $name);

        // $invoice=Invoice::create([
        //     'user_id' => auth()->user()->id,
        //     'name'=> $name
        // ]);
        // return response()->json($invoice);
    
    }

    public function delete(Request $request){
        $invoice=Invoice::find($request->id);
        $filepath = public_path('upload/invoice/').$invoice->full_name;
        if(File::exists($filepath)) {
            File::delete($filepath);
        }
        Invoice::destroy($request->id);
        return response()->json(true); 
    }
}
