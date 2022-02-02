<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class settings_controller extends Controller
{
    public function get_settings()
    {
        $settings = \App\Models\settings_model::all();

        return response()->json($settings,200);
    }

    public function save_settings(Request $request)
    {
        \App\Models\settings_model::where('id',1)->update([
            'website_title_ar'=>$request->website_title_ar,
            'website_title_en'=>$request->website_title_en,
            'website_email'=>$request->website_email,
            'website_phone'=>$request->website_phone,
            'website_phone2'=>$request->website_phone2,
            'address'=>$request->address,
            'web1'=>$request->web1,
            'web2'=>$request->web2,
            'web3'=>$request->web3,
            'web4'=>$request->web4,
            'web5'=>$request->web5,
            'about_ar'=>$request->about_ar,
            'about_en'=>$request->about_en,
            
        ]);

            return response()->json(['msg'=>'تم الحفظ بنجاح'],200);
    }
}
