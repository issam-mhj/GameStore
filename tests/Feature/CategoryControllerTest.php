<?php

namespace Tests\Feature;

use App\Models\Categorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_categories()
    {
        Categorie::factory()->count(3)->create();

        $response = $this->getJson('/api/categorie');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }
    public function test_can_create_category()
    {
        $data = [
            'name' => 'Technology',
            'slug' => 'technology'
        ];

        $response = $this->postJson('/api/categorie', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_cannot_create_category_with_invalid_data()
    {
        $response = $this->postJson('/api/categorie', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'slug']);
    }

    public function test_can_view_a_single_category()
    {
        $category = Categorie::factory()->create();

        $response = $this->getJson("/api/categorie/{$category->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $category->name,
                'slug' => $category->slug
            ]);
    }

    public function test_cannot_view_non_existing_category()
    {
        $response = $this->getJson('/api/categorie/999');

        $response->assertStatus(404)
            ->assertJson(['message' => 'category not found']);
    }

    public function test_can_update_category()
    {
        $category = Categorie::factory()->create();

        $updateData = ['name' => 'Updated Name', 'slug' => 'updated-slug'];

        $response = $this->putJson("/api/categorie/{$category->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment($updateData);

        $this->assertDatabaseHas('categories', $updateData);
    }

    public function test_cannot_update_non_existing_category()
    {
        $response = $this->putJson('/api/categorie/999', ['name' => 'New Name']);

        $response->assertStatus(404)
            ->assertJson(['message' => 'category not found']);
    }

    public function test_can_delete_category()
    {
        $category = Categorie::factory()->create();

        $response = $this->deleteJson("/api/categorie/{$category->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_cannot_delete_non_existing_category()
    {
        $response = $this->deleteJson('/api/categorie/999');

        $response->assertStatus(404)
            ->assertJson(['message' => 'category not found']);
    }

}
