<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => Str::slug($this->faker->unique()->words(2, true)),
        ];
    }
}
