<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VideoDefi>
 */
use App\Models\Defi;   
use App\Models\VideoDefi;

class VideoDefiFactory extends Factory
{
    protected $model = VideoDefi::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'titre' => $this->faker->word() . '.mp4',
            'url' => 'videos/7BhKZA3KSqALSN8CMf84149J1yRkOcnMRZv7yHE9.mp4',
            'id_defi' => Defi::factory(), 
        ];
    }
}
