<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    
    function post(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->active = $request->active;
        $product->description = $request->description;

        $product->save();

        return response()->json(
            [
                "message" => "success",
                "data" => $product
            ]
        );
    }

    function get()
    {
        $data = Product::all();

        return response()->json(
            [
                "message" => "success",
                "data" => $data
            ]
        );
    }

    function getById($id)
    {
        $data = Product::where('id', $id)->first();
        if($data){
            return response()->json(
                [
                    "message" => "success",
                    "data" => $data
                ]
            );
        }
        return response()->json(
            [
                "message" => "data not found"
            ]
        );
    }


    function put($id, Request $request)
    {
        $product = Product::where('id', $id)->first();

        if($product){
            $product->name = $request->name ? $request->name : $product->name;
            $product->price = $request->price ? $request->price : $product->price;
            $product->qty = $request->qty ? $request->qty : $product->qty;
            $product->active = $request->active ? $request->active : $product->active;
            $product->description = $request->description ? $request->description : $product->description;
            return response()->json(
                [
                    "message" => "Put Method Success" .$id,
                    "data" => $product
                ]
            );
        }
        return response()->json(
            [
                "message" => "Put Failed" .$id
            ]
        );
    }

    function delete($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        if($product){
            return response()->json(
                [
                    "message" => "Delete Method Success" . $id
                ]
            );
        }
        return response()->json(
            [
                "message" => "Delete Method " . $id . " not found"
            ], 400
        );
    }
}
