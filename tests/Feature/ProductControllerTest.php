<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \App\Models\Categorie::factory()->create();
    }
    public function test_can_list_products()
    {
        Product::factory()->count(3)->create();


        $response = $this->getJson(route('products.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }
    public function test_can_store_a_product()
    {
        $category = \App\Models\Categorie::factory()->create();

        $product = \App\Models\Product::create([
            'name' => 'Test Product',
            'slug' =>  Str::slug('Test Product-' . uniqid()),
            'price' => 100,
            'stock' => 10,
            'status' => 1,
            'category_id' => $category->id,
        ]);
        $data = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 99.99,
            'stock' => 10,
            'status' => true,
            'category_id' => 1,
        ];

        $response = $this->postJson(route('products.store'), $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test Product']);

        $this->assertDatabaseHas('products', $data);
    }

    public function test_cannot_store_product_without_name()
    {

        $data = [
            'price' => 10.5,
        ];


        $response = $this->postJson(route('products.store'), $data);


        $response->assertStatus(422);


        $response->assertJsonValidationErrors('name');
    }

    public function test_can_show_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(route('products.show', $product->id));

        $response->assertStatus(200)
            ->assertJson(['id' => $product->id]);
    }

    public function test_can_update_a_product()
    {
        $product = Product::factory()->create();

        $updateData = [
            'name' => 'Updated Product',
            'price' => 200,
        ];
        $response = $this->putJson(route('products.update', $product->id), $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Product']);

        $this->assertDatabaseHas('products', $updateData);
    }

    public function test_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(route('products.destroy', $product->id));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
