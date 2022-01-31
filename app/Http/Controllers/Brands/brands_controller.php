<?php

namespace App\Http\Controllers\Brands;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brands_model;

class brands_controller extends Controller
{
    public function get_brands()
    {
        $brands = brands_model::all();

        return response()->json($brands,200);
    }
    public function add_brand(Request $request)
    {
        $brand = new brands_model();

        $brand->brand_name_ar = $request->brand_name_ar;
        $brand->brand_name_en = $request->brand_name_en;
        $brand->brand_website = $request->brand_website;
        
        $filename =  date("Y-m-d-h-i-s").'.png';
        $upload = $request->file('image')->move(public_path('images/'),$filename);
        $brand->brand_logo = $filename;
        $ext = $request->file('image')->getClientOriginalExtension();
        
        $allowed_extensions = ['jpg','png','gif','bmp','jpeg'];

        if(!in_array($ext,$allowed_extensions))
        {
            return response()->json(['msg'=>'هذه الصيغة غير مسموحة'],400);
        }
        if(!file_exists(public_path('images/').$filename))
        {
            return response()->json(['msg'=>'فشل رفع الملف'],400);
        }
        if($brand->save())
            {
                
            return response()->json(['msg'=>'تم الحفظ بنجاح'],200);
              
            }
        
    }

    public function edit_brand(Request $request)
    {
        if($request->file('image') ==null)
        {
            brands_model::where('brand_id',$request->brand_id)->update([
                'brand_name_ar'=>$request->brand_name_ar,
                'brand_name_en'=>$request->brand_name_en,
                'brand_website'=>$request->brand_website
                ]);
    
              
                return response()->json(['msg'=>'2تم الحفظ بنجاح'],200);
        }

        $filename =  date("Y-m-d-h-i-s").'.png';
        $upload = $request->file('image')->move(public_path('images/'),$filename);
       
        $ext = $request->file('image')->getClientOriginalExtension();
        
        $allowed_extensions = ['jpg','png','gif','bmp','jpeg'];

        if(!in_array($ext,$allowed_extensions))
        {
            return response()->json(['msg'=>'هذه الصيغة غير مسموحة'],400);
        }
        if(!file_exists(public_path('images/').$filename))
        {
            return response()->json(['msg'=>'فشل رفع الملف'],400);
        }
        
        $old_logo = public_path('images/').$request->brand_logo;
        if(file_exists($old_logo))
        {
            unlink($old_logo);
            
        }
        
            brands_model::where('brand_id',$request->brand_id)->update([
            'brand_name_ar'=>$request->brand_name_ar,
            'brand_name_en'=>$request->brand_name_en,
            'brand_website'=>$request->brand_website,
            'brand_logo'=>$filename
            ]);

            return response()->json(['msg'=>'تم الحفظ بنجاح'],200);
        
    }

    

   

    public function delete_brand(Request $request)
    {
        
        brands_model::where('brand_id',$request->brand_id)->delete();
        $image = public_path('images/').$request->brand_logo;
        if(file_exists($image))
        {
            unlink($image);
        }
        return response()->json(['msg'=>'تم حذف الماركة بنجاح'],200);
    }

   
}
