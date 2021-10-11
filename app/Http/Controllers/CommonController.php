<?php

namespace App\Http\Controllers;

use App\Models\AddReport;
use App\Models\Creative;
use Illuminate\Http\Request;
use App\Models\Digital;
use App\Models\SocialMedia;

class CommonController extends Controller
{
    public function check_duplicate(Request $request){
        $type=$request->type;
        $name=$request->name;
        $ext=$request->ext;
        $vaild=1;
        
        switch ($type) {
            case 'digital':
                $count=Digital::where(['name'=>$name, 'ext'=>$ext])->count();
                $vaild=$count > 0 ? 0 : 1;
                break;
            case 'social_media':
                $count=SocialMedia::where(['name'=>$name, 'ext'=>$ext])->count();
                $vaild=$count > 0 ? 0 : 1;
                break;
            case 'creative':
                $count=Creative::where(['name'=>$name, 'ext'=>$ext])->count();
                $vaild=$count > 0 ? 0 : 1;
                break;
            case 'report':
                $count=AddReport::where(['name'=>$name, 'ext'=>$ext])->count();
                $vaild=$count > 0 ? 0 : 1;
                break;
            default:
                $vaild=1;
                break;
        }
        return response()->json($vaild);
    }

    public function check_update_duplicate(Request $request){
        $type=$request->type;
        $name=$request->name;
        $id=$request->id;
        $vaild=1;
        
        switch ($type) {
            case 'digital':
                $exist=Digital::find($id);
                $count=Digital::where(['name'=>$name, 'ext'=>$exist->ext])->count();
                $vaild=$count > 0 ? 0 : 1;
                break;

            case 'social_media':
                $exist=SocialMedia::find($id);
                $count=SocialMedia::where(['name'=>$name, 'ext'=>$exist->ext])->count();
                $vaild=$count > 0 ? 0 : 1;
                break;
            
            default:
                $vaild=1;
                break;
        }
        return response()->json($vaild);
    }

    
}
