<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterSecurityTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Group('skip-ci')]

    public function test_inscription_refuse_email_invalide()
    {
        $response = $this->post('/inscription', [ 
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'pas-un-email', // invalide
            'mot_de_passe' => 'azerty123',
            'confirmation_mot_de_passe' => 'azerty123'
        ]);

        $response->assertSessionHasErrors(['email']);
    }


    #[\PHPUnit\Framework\Attributes\Group('skip-ci')]

    public function test_inscription_refuse_champs_vides()
    {
        $response = $this->post('/inscription', []); 

        $response->assertSessionHasErrors(['nom', 'prenom', 'email', 'mot_de_passe']);
    }
}
