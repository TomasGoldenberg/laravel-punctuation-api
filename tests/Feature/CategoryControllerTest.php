<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Laravel\Sanctum\Sanctum;
use App\Category;
use App\User;


class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(
            factory(User::class)->create()
        );
    }

    public function test_index()
    {
        factory(Category::class, 5)->create();

        $response = $this->getJson('/api/categories');

        $response->assertSuccessful();
        
        
        $response->assertJsonCount(5,"data");
    }

    public function test_create_new_cateory()
    {
        $data = [
            'name' => 'blue',
            
        ];
        $response = $this->postJson('/api/categories', $data);

        $response->assertSuccessful();
        
        $this->assertDatabaseHas('categories', $data);
    }

    public function test_update_cateory()
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $data = [
            'name' => 'black',
            
        ];

        $response = $this->patchJson("/api/categories/{$category->getKey()}", $data);
        $response->assertSuccessful();
        
    }

    public function test_show_cateory()
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $response = $this->getJson("/api/categories/{$category->getKey()}");

        $response->assertSuccessful();
        
    }

    public function test_delete_category()
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $response = $this->deleteJson("/api/categories/{$category->getKey()}");

        $response->assertSuccessful();
        
        $this->assertDeleted($category);
    }
}
