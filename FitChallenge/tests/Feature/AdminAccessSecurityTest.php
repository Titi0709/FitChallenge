<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Utilisateur;

class AdminAccessSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_utilisateur_non_admin_ne_peut_pas_acceder_admin()
    {
        $user = Utilisateur::factory()->create([
            'role' => 'utilisateur', // pas 'admin'
        ]);

        $this->actingAs($user);

        $response = $this->get('/admin');

        $response->assertStatus(403); // interdit d'accès
    }
}
