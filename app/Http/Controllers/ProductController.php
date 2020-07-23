<?php

namespace App\Http\Controllers;

use App\Product;

//validations
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;

//resources
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;


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
        return new ProductCollection(Product::all());
    }


    public function store(StoreProductRequest $request)
    {
       $product = Product::create($request->all());

       return $product;
    }

    public function show(Product $product)
    {
        $product = new ProductResource($product) ;
        return $product; //redefinimos el model con el que trabajaremos aqui
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json();
    }
}
