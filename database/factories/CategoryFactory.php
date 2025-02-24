<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'title' => $this->faker->word,
            // Certifique-se de associar um site existente:
            'site_id' => \App\Models\Site::factory(),
        ];
    }
}
