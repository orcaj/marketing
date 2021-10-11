<?php

namespace App\Http\Controllers;

use App\Models\EmpClient;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();



        if ($auth->role == 'emp') {
            $clients = EmpClient::where('emp_id', $auth->id)->pluck('client_id');
            $data['notifications'] = Notification::where('type', '!=', 'admin')->whereIn('client_id', $clients)->get();
            Notification::whereIn('client_id', $clients)->update([
                'status' => 1
            ]);

            $data['admin_notifications'] = Notification::where('type', 'admin')->where('client_id', $auth->id)->get();
            Notification::where('type', 'admin')->where('client_id', $auth->id)->update([
                'status' => 1
            ]);
        } elseif ($auth->role === 'admin' || $auth->role === 'manager') {
            $data['admin_notifications'] = Notification::where('type', 'admin')->get();
        } else {
            $data['admin_notifications'] = Notification::where('type', 'admin')->where('client_id', $auth->id)->get();
            Notification::where('type', 'admin')->where('client_id', $auth->id)->update([
                'status' => 1
            ]);
        }

        return view('other.notification', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = User::find(auth()->user()->id);
        $client_name = $client->name;
        $id = $request->id;

        switch ($request->type) {
            case 'digital':
                $content = "I am the ${client_name}. I want to create a digital campaign.";
                break;
            case 'creative':
                $content = "I am the ${client_name}. I want to Request Creative Idea.";
                break;
            default:
                $content = "";
                break;
        }
        Notification::create([
            'client_id' => auth()->user()->id,
            'type' => $request->type,
            'content' => $content,
            'status' => 0
        ]);
        return response()->json('true');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function admin_create()
    {
        $data['users'] = User::where('role', '!=', 'admin')->where('role', '!=', 'manager')->get();
        return view('other.notif-create', $data);
    }

    public function admin_store(Request $request)
    {
        $user_type = $request->user_type;
        $user = $request->user;
        if($user_type){
            foreach ($user_type as $key => $type) {
                $type_users = User::where('role', $type)->pluck('id');
                foreach ($type_users as $type_key => $user_id) {
                    Notification::create([
                        'client_id' => $user_id,
                        'type' => 'admin',
                        'content' => $request->msg,
                        'status' => 0
                    ]);
                }
            }
        }
        if($user){
            foreach ($user as $key => $value) {
                $receiver = User::find($value);
                if($user_type){
                    if (!in_array($receiver->role, $user_type)) {
                        Notification::create([
                            'client_id' => $value,
                            'type' => 'admin',
                            'content' => $request->msg,
                            'status' => 0
                        ]);
                    }
                }else{
                    Notification::create([
                        'client_id' => $value,
                        'type' => 'admin',
                        'content' => $request->msg,
                        'status' => 0
                    ]);
                }
            }
        }
        return redirect()->route('notification.index')->with(['success' => 'Create notification']);
    }
}
