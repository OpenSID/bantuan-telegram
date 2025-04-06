<?php

namespace Database\Factories;

use App\Models\FAQ;
use App\Models\Group; // Assuming you have a Group model
use Illuminate\Database\Eloquent\Factories\Factory;

class FAQFactory extends Factory
{
    protected $model = FAQ::class;

    public function definition()
    {
        return [
            'group_id' => Group::factory(), // This will create a Group if one isn't provided
            'question' => $this->faker->sentence,
            'answer' => $this->faker->paragraph,
        ];
    }
}