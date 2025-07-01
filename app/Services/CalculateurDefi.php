<?php

namespace App\Services;

class CalculateurDefi
{
    // Utilise PHPUnit\Framework\TestCase (test unitaire pur sans base de données ni Laravel).
    
    public function calculerPoints(int $duree, string $typeExercice): int
    {
        $coefficient = match($typeExercice) {
            'Cardio' => 2,
            'Force' => 3,
            'Souplesse' => 1,
            default => 1,
        };

        return $duree * $coefficient;
    }
}
