<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
class UtilisateurFactory extends Factory
{
    protected $model = Utilisateur::class;
    
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */

//  faker est un générateur de fausses données réalistes
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'mot_de_passe' => Hash::make('password'),
            'role' => 'utilisateur',
            'date_inscription' => now(),
        ];
    }
}
