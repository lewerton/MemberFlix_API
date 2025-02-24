<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'title' => $this->faker->sentence,
            'created_at' => now(),
            'category' => \App\Models\Category::factory(),
            'hls_path' => $this->faker->url,
            'description' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl(640, 480, 'video', true),
            'site_id' => \App\Models\Site::factory(),
            'views' => $this->faker->numberBetween(0, 1000),
            'likes' => $this->faker->numberBetween(0, 500),
        ];
    }
}
