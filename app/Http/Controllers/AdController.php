<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['ads'] = Ad::orderBy('updated_at', 'DESC')->get();
        return view('other.ad.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('other.ad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ad::create([
            'user_type' => $request->user_type,
            'msg' => $request->msg,
        ]);
        return redirect()->route('ad.index')->with(['success' => 'Create Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(ad $ad)
    {
        return view('other.ad.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ad $ad)
    {
        $ad->user_type=$request->user_type;
        $ad->msg=$request->msg;
        $ad->save();
        return redirect()->route('ad.index')->with(['success' => 'Ad is updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(ad $ad)
    {
        //
    }

    public function delete(Request $request){
        Ad::destroy($request->id);
        return response()->json(true); 
    }
}
