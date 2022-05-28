<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    public function definition()
    {
        $nameOfBook = $this->faker->unique()->word;
        $tag = Str::slug($nameOfBook);
        return [
            'name' => $nameOfBook,
            'tag' => $tag,
            'description' => $this->faker->sentences(4, true),
            'price' => $this->faker->randomFloat(2, 10, 10000),
        ];
    }
}
