<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\messages_model;

class messages_controller extends Controller
{
    public function get_messages()
    {
        $messages = messages_model::all();

        return response()->json($messages,200);
    }

    public function delete_message(Request $request)
    {
        messages_model::where('id',$request->id)->delete();
        return response()->json(['msg'=>'تم حذف الرسالة بنجاح'],200);
    }

    public function send_message(Request $request)
    {
        $message = new messages_model();

        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->message = $request->message;
        if($message->save())
        {
            return response()->json(['msg'=>'تم الاسال بنجاح'],200);
        }
        
    }

    
}
