<?php

namespace App\Http\Controllers\Render;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brands_model;
use App\Models\products_model;
use App\Models\messages_model;
use App\Models\settings_model;
use App\Models\socialmedia_model;


class render_controller extends Controller
{
    public function render()
    {
        $slides = products_model::where('product_slide',1)->get();

        $brands = brands_model::all();

        $products = products_model::all();

        $settings = settings_model::all();

        $socials = socialmedia_model::all();

        return response()->json(
            [
                'slides'=>$slides,
                'brands'=>$brands,
                'products'=>$products,
                'settings'=>$settings,
                'socials'=>$socials,
                
             ]
            );
    }
}
