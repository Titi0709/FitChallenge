<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CalculateurDefi;

class CalculateurDefiTest extends TestCase
{
    public function test_calcul_cardio()
    {
        $calc = new CalculateurDefi();
        $this->assertEquals(20, $calc->calculerPoints(10, 'Cardio'));
    }

    public function test_calcul_force()
    {
        $calc = new CalculateurDefi();
        $this->assertEquals(30, $calc->calculerPoints(10, 'Force'));
    }

    public function test_calcul_souplesse()
    {
        $calc = new CalculateurDefi();
        $this->assertEquals(10, $calc->calculerPoints(10, 'Souplesse'));
    }

    public function test_calcul_type_inconnu()
    {
        $calc = new CalculateurDefi();
        $this->assertEquals(10, $calc->calculerPoints(10, 'Autre'));
    }
}
