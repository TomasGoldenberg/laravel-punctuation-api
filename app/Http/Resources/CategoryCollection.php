<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{

    public $collects = CategoryResource::class;
    
    public function toArray($request)
    {
        return [
            "data" => $this->collection,
            "links"=> "alguna metadata"
        ];
    }
}
