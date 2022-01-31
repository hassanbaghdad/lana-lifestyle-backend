<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $attr = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($attr)) {
            return response()->json(['msg'=>'Unauthintecation'],401);
        }
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $user = auth()->user();
        $user["token"] = $token;
        
        return response()->json($user,200);

    }

    public function logout()
    {
       
        Auth::user()->tokens()->delete();
        //auth()->logout();
        
        return response()->json(['msg'=>'تم الخروج'],200);

    }
    public function update_account(Request $request)
    {
        // $attr = $request->validate([
        //     'username' => 'required|string',
        //     'password' => 'required|string'
        // ]);
            if($request->new_password1 != $request->new_password2)
            {
                return response()->json(['msg'=>'كلمات المرور غير متطابقتان'],401);
            }
       
            \App\Models\User::where('username',$request->username)->update([
                'password'=>Hash::make($request->new_password1)
            ]);
            return response()->json(['msg'=>'تم الحفظ بنجاح'],200);
        
        
        

    }
    
}
