<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Resources\ProductResource;

class ProductController extends Controller
{    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["index", "show"]);
    }

    public function index()
    {
        return ProductResource::collection(Product::all());
    }


    public function store(Request $request)
    {
       $product = Product::create($request->all());

       return $product;
    }

    public function show(Product $product)
    {
        $product = new ProductResource($product) ;
        return $product; //redefinimos el model con el que trabajaremos aqui
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json();
    }
}
