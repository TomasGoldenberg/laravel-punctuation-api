<?php

namespace App\Observers;

use App\Product;

class ProductObserver
{

    public function created(Product $product)
    {
        $faker = \Faker\Factory::create();
        $product->image_url = $faker->imageUrl();

        if (!$product->createdBy()->exists()) {
            $product->createdBy()->associate(auth()->user());
        };
    }


    public function updated(Product $product)
    {
        //
    }


    public function deleted(Product $product)
    {
        //
    }


    public function restored(Product $product)
    {
        //
    }

 
    public function forceDeleted(Product $product)
    {
        //
    }
}
