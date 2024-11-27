<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function show(string $id){
            return Product::find($id);
    }

    public function store(Request $request){
        $fields = $request->validate([
            "name" => "required|string",
            "qty" => "required",
            "price" => "required|decimal:0,2",
            "description" => "nullable",
        ]);

        $products = Product::create([
            "name" => $fields['name'],
            "qty" => $fields['qty'],
            "price" => $fields['price'],
            "description" => $fields['description']
        ]);

        return response([
            "products" => $products,
            'message' => 'Successfully Created product'
        ]);
    }

    public function update(Request $request, string $id){
        $fields = $request->validate([
            "name" => "required|string",
            "qty" => "required",
            "price" => "required|decimal:0,2",
            "description" => "nullable",
        ]);

        $products = Product::find($id);

        $products->update([
            "name" => $fields['name'],
            "qty" => $fields['qty'],
            "price" => $fields['price'],
            "description" => $fields['description']
        ]);

        return response([
            "products" => $products,
            'message' => 'Successfully Update product'
        ]);
    }

    public function destroy(string $id){
        Product::destroy($id);
        return ['message' => 'Successfully Deleted product'];

    }

    public function search($name){
            return Product::where('name','like','%'.$name.'%')-get();
    }
}
