<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "article_id" => rand(1,10),
            "dateDebut" => $this->faker->dateTimeBetween("2022-01-02","2022-04-04"),
            "dateFin" => $this->faker->dateTimeBetween("2022-01-02","2022-10-10"),
            "client_id" => rand(1,10),
            "user_id" => rand(1,4),
            "statut_location_id" => rand(1,3),

        ];
    }
}
