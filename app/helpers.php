<?php

use App\Models\EmpClient;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function available_client()
{
   $auth = auth()->user();
   if ($auth->role == 'emp') {
      $list = EmpClient::where('emp_id' , $auth->id)->pluck('client_id');
      $clients = User::whereIn('id', $list)->where('active', 1)->get();
   } else {
      $clients = User::where(['role' => 'client', 'active' => 1])->get();
   }
   return $clients;
}

function permission($slug)
{
   $user_role = [
      'admin' => ' client, admin, manager, emp',
      'manager' => ' client, manager, emp',
      'emp' => ' client, emp',
      'client' => ' client',
   ];

   $role = auth()->user()->role;
   $permisson = $user_role[$role];
   return strpos($permisson, $slug);
}

function notifications()
{
   $auth = auth()->user();
   if ($auth->role == 'emp') {
      $clients = EmpClient::where('emp_id', $auth->id)->pluck('client_id');
      $global_notifications = Notification::where('type', '!=', 'admin')->whereIn('client_id', $clients)->where('status', 0)->get();
   } else {
      $global_notifications = [];
   }
   return $global_notifications;
}

function admin_notifications()
{
   $auth = auth()->user();
   $admin_notifications=Notification::where(['type'=>'admin', 'client_id' => Auth::user()->id, 'status'=> 0])->get();
   // if ($auth->role == 'emp') {
   //    $clients = EmpClient::where('emp_id', $auth->id)->pluck('client_id');
   //    $global_notifications = Notification::whereIn('client_id', $clients)->where('status', 0)->get();
   // } else {
   //    $global_notifications = [];
   // }
   return $admin_notifications;
}

function getEmpName($client_id)
{
   $empClient = EmpClient::where('client_id', $client_id)->first();
   if (!$empClient) {
      return '';
   }
   return User::find($empClient->emp_id)->name;
}

function activeEmps()
{
   $emps = User::where(['role' => 'emp', 'active' => 1])->get();
   return $emps;
}

// function activeClients()
// {
//    $emps = User::where(['role' => 'client', 'active' => 1])->get();
//    return $emps;
// }
