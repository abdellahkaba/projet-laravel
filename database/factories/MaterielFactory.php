<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materiel>
 */
class MaterielFactory extends Factory
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
            "description" => $this->faker->title,
            "estDisponible" => rand(0,1) ,
            "photo" => "images/imageplaceholder.png",
            "categorie_id" => rand(1,4),    
        ];
    }
}
