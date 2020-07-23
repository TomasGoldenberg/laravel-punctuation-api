<?php

namespace Tests\Feature;
use Laravel\Sanctum\Sanctum;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Category;
use App\Product;
use App\User;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        

      
    }
    public function test_a_product_belongs_to_category()
    {
       
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(["category_id" => $category->id]);

        $this->assertInstanceOf(Category::class,$product->category);
    }
}
