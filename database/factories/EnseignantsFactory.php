<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EnseignantsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'matricule' => $this->faker->name(),
            'nom' => $this->faker->name(),
            'tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'prenom' => $this->faker->name()
        ];
    }
}
