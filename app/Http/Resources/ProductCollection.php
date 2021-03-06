<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ProductResource;

class ProductCollection extends ResourceCollection
{

    public $collects = ProductResource::class;
    public function toArray($request)
    {
        return [
            "data" => $this->collection,
            "links" => "metadata qeu quieras"
        ];
    }
}
