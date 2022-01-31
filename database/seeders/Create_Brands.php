<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Create_Brands extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = new \App\Models\brands_model();
        
        $brand->brand_name_en = 'hassan';
        $brand->brand_name_ar = 'hassan';
        $brand->brand_website = 'www.google.com';
        $brand->brand_logo = 'logo.png';
        $brand->save();

        dd("brand Created");
    }
}
