<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show_products()
    {
        $products = ProductModel::all();
        if ($products) {
            return response()->json([
                'data' => $products,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not saved'
            ], 404);
        }
    }
    public function show_single_product($id)
    {
        if($id){
            $product = ProductModel::where('id',$id)->first();
        }
        if ($product) {
            return response()->json([
                'data' => $product,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not saved'
            ], 404);
        }
    }

    public function add_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nutrients' => 'required',
            'nutrients_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ingredients' => 'required',
            'ingredients_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'front_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'back_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'expiry' => 'required',
        ]);

        $products = new ProductModel();
        $products->name = $request->name;

        $products->nutrients = $request->nutrients;

        $nutrients_image_name = time() . '.' . $request->nutrients_image->extension();
        $request->nutrients_image->move(public_path('images/nutrients_image'), $nutrients_image_name);
        $products->nutrients_image = $nutrients_image_name;


        $products->ingredients = $request->ingredients;

        $ingredients_image_name = time() . '.' . $request->ingredients_image->extension();
        $request->ingredients_image->move(public_path('images/ingredients'), $ingredients_image_name);
        $products->ingredients_image = $ingredients_image_name;

        $front_image_name = time() . '.' . $request->front_image->extension();
        $request->front_image->move(public_path('images/front_image'), $front_image_name);
        $products->front_image = $front_image_name;

        $back_image_name = time() . '.' . $request->back_image->extension();
        $request->back_image->move(public_path('images/front_image'), $back_image_name);
        $products->back_image = $back_image_name;

        $products->expiry = $request->expiry;

        $products->save();

        if ($products->save()) {
            return response()->json([
                'data' => $products,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not saved'
            ], 404);
        }

    }
}
