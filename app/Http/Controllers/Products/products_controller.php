<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\products_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class products_controller extends Controller
{
    public function get_products()
    {
        $products = products_model::all();

        $products = DB::select("SELECT * FROM products , brands where products.brand_id_fk = brands.brand_id");
        return response()->json($products,200);
    }
    public function add_product(Request $request)
    {
        $product = new products_model();
        if($request->product_slide == true)
        {
            $request->product_slide=1;
        }else{
            $request->product_slide = 0;
        }
        $product->product_title_ar = $request->product_title_ar;
        $product->product_title_en = $request->product_title_en;
        $product->product_desc_ar = $request->product_desc_ar;
        $product->product_desc_en = $request->product_desc_en;
        $product->brand_id_fk = $request->brand_id_fk;
        $product->product_slide= $request->product_slide;
        
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
        $product->product_image = $filename;
        if($product->save())
            {
                
            return response()->json(['msg'=>'تم الحفظ بنجاح'],200);
              
            }
    }

    public function edit_product(Request $request)
    {
        $product = new products_model();
        
         $product_slide = $request->product_slide ;
        
        if($request->file('image') ==null)
        {
            products_model::where('product_id',$request->product_id)->update([
                'product_title_ar'=> $request->product_title_ar,
                'product_title_en'=> $request->product_title_en,
                'product_desc_ar'=> $request->product_desc_ar,
                'product_desc_en'=> $request->product_desc_en,
                'product_slide'=>  $product_slide,
                'brand_id_fk'=> $request->brand_id_fk,
            ]);
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
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

        products_model::where('product_id',$request->product_id)->update([
            'product_title_ar'=> $request->product_title_ar,
            'product_title_en'=> $request->product_title_en,
            'product_desc_ar'=> $request->product_desc_ar,
            'product_desc_en'=> $request->product_desc_en,
            'product_slide'=> $product_slide,
            'brand_id_fk'=> $request->brand_id_fk,
            'product_image'=> $filename,
        ]);
       
                
            return response()->json(['msg'=>'تم التعديل بنجاح'],200);
              
            
    }

    public function delete_product(Request $request)
    {
        
        products_model::where('product_id',$request->product_id)->delete();
        $image = public_path('images/').$request->product_image;
        if(file_exists($image))
        {
            unlink($image);
        }
        return response()->json(['msg'=>'تم حذف المنتج بنجاح'],200);
    }
    
    public function view_product(Request $request)
    {
        
        $product = products_model::where('product_id',$request->product_id)->get();
        
        return response()->json($product,200);
    }
    


}
