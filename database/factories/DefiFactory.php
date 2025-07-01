<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Defi>
 */

use App\Models\Utilisateur;
use App\Models\Defi;

class DefiFactory extends Factory
{
    protected $model = Defi::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

 public function definition(): array
    {
        return [
            'titre' => $this->faker->text(50),
            'description' => $this->faker->paragraph(),
            'type_exercice' => 'Cardio', 
            'duree' => $this->faker->numberBetween(5, 60), 
            'objectif' => $this->faker->sentence(),
            'image' => 'images/1JTqacO1yiIo0ShPuw0vZJ4JlW8dQBmFJMltsSiW.jpg',
            'date_creation' => now(),
            'statut' => 'en cours',
            'prix' => 0,
            'id_utilisateur' => Utilisateur::factory(), 
        ];
    }
}