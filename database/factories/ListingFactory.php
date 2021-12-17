<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Listing;

class ListingFactory extends Factory
{

    protected $model = Listing::class;

    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'description' =>$this->faker->text(200),
            'price' => rand(10,999)
        ];
    }
}
