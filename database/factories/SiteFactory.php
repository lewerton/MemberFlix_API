<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    protected $model = Site::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'title' => $this->faker->company,
            'domain' => $this->faker->domainName,
        ];
    }
}
