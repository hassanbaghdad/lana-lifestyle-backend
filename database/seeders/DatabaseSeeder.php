<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            $user = new \App\Models\User();
        
            $user->username = 'hassan';
            $user->password = Hash::make('123456');
            $user->name = 'Hassan Mohammed';
            $user->save();
        
           // dd("User Created");
            $brand = new \App\Models\brands_model();
            
            $brand->brand_name_en = 'Nike';
            $brand->brand_name_ar = 'نايك';
            $brand->brand_website = 'www.nike.com';
            $brand->brand_logo = 'logo.png';
            $brand->save();
    
           // dd("brand Created");

            $product = new \App\Models\products_model();
            $product->product_title_ar = "شامبو";
            $product->product_title_en = "Shampo";
            $product->product_desc_ar = " تفاصيل شامبو";
            $product->product_desc_en = " Details Shampo";
            $product->product_image = "img.png";
            $product->brand_id_fk = 1;
            $product->save();

            $message = new \App\Models\messages_model();
            $message->name = "Hassan Mohammed";
            $message->email = "mr.iraq1994@gmail.com";
            $message->phone = "07714283610";
            $message->message = "Welcome Friends";
            $message->save();

            $setting = new \App\Models\settings_model();

            $setting->website_title_ar = "لانا";
            $setting->website_title_en = "Lana";
            $setting->website_email = "info@lanastyle.com";
            $setting->website_phone = "07701234567";
            $setting->address = "Iraq-Baghdad";
            $setting->save();
            
            dd(" Created");



       
    }
}
