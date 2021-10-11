<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $data['user']= Auth::user();
        return view('other.profile', $data);
    }

    public function update(ProfileRequest $request, $user_id){
        $user=User::Find($user_id);
        
        $updated_user=[
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];
        if($request->file){
            $file=$request->file;
            $filename=time().".".$request->file->extension();
            $file->move(public_path('assets/profile'), $filename);
            $updated_user['photo']=$filename;
        }
        $user->update($updated_user);
        return back()->with(['success'=>true, 'message'=>'success']);
    }

    public function change_password(ResetPasswordRequest $request){
        $user=auth()->user();
        if(!Hash::check($request->current_password, $user->password)){
            return back()->with(['error'=>true, 'message'=>'error']);
        }
        $user=User::find($user->id)->update([
            'password' => Hash::make($request->password),
        ]);
        return back()->with(['success'=>true, 'message'=>'success']);
        // 
        // 
    }
}
