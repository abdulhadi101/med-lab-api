<?php

namespace Database\Factories;

use App\Models\LabTest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LabTest>
 */
class LabTestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $labNames = [
            'Chest',
            'Fingers',
            'Breast',
            'Pelvis',
            'Foot',
            'Toe',
            'Abnominal',
            'Cervical Verterbrae',
        ];
        return [
            'name' =>  $this->faker->randomElement($labNames),
            'description' => $this->faker->sentence,

        ];
    }
}
