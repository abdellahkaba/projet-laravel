<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nom" => $this->faker->lastName,
            "prenom" => $this->faker->firstName,
            "sexe" => array_rand(['F','H'] , 1),
            "dateNaiss" => $this->faker->dateTimeBetween("1980-01-01","2002-11-11"),
            "lieuNaiss" => $this->faker->city,
            "ville" => $this->faker->city,
            "adresse" => $this->faker->address,
            "telephone" => $this->faker->phoneNumber,

        ];
    }
}
