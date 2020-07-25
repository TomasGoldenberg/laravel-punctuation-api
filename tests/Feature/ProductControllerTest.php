<?php

namespace Tests\Feature;

use App\Product;
use App\Category;
use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        factory(Category::class)->create();
        factory(User::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create()
        );
    }

    public function test_index()
    {
   

        factory(Product::class, 5)->create();

        $response = $this->getJson('/api/products');

        $response->assertSuccessful();
        
        $response->assertJsonCount(5,"data");
    }

    public function test_create_new_product()
    {
        $data = [
            'name' => 'Hola',
            'price' => 1000,
            "category_id" => 1,
            "created_by" => 1,

        ];
        $response = $this->postJson('/api/products', $data);

        $response->assertSuccessful();
        
        $this->assertDatabaseHas('products', $data);
    }

    public function test_update_product()
    {
        /** @var Product $product */
        $product = factory(Product::class)->create();

        $data = [
            'name' => 'Update Product',
            'price' => 20000,
        ];

        $response = $this->patchJson("/api/products/{$product->getKey()}", $data);
        $response->assertSuccessful();
        
    }

    public function test_show_product()
    {
        /** @var Product $product */
        $product = factory(Product::class)->create();

        $response = $this->getJson("/api/products/{$product->getKey()}");

        $response->assertSuccessful();
        
    }

    public function test_delete_product()
    {
        /** @var Product $product */
        $product = factory(Product::class)->create();

        $response = $this->deleteJson("/api/products/{$product->getKey()}");

        $response->assertSuccessful();
        
        $this->assertDeleted($product);
    }

}
