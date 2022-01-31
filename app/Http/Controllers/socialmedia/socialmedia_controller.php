<?php

namespace App\Http\Controllers\socialmedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class socialmedia_controller extends Controller
{
    public function get_socials()
    {
        $socials = \App\Models\socialmedia_model::all();
        return response()->json($socials,200);
    }

    public function add_social(Request $request)
    {
        $social = new \App\Models\socialmedia_model();

        $social->title = $request->title;
        $social->url = $request->url;
        $social->icon = $request->icon;

        if($social->save()){
            return response()->json(['msg'=>'تم حفظ الموقع بنجاح'],200);
        }
        
    }

    public function edit_social(Request $request)
    {
         \App\Models\socialmedia_model::where('id',$request->id)->update([
            'title'=>$request->title,
            'url'=>$request->url,
            'icon'=>$request->icon
        ]);

            return response()->json(['msg'=>'تم تعديل الموقع بنجاح'],200);
        
        
    }

    public function delete_social(Request $request)
    {
         \App\Models\socialmedia_model::where('id',$request->id)->delete();

            return response()->json(['msg'=>'تم حذف الموقع بنجاح'],200);
        
        
    }

    
}
