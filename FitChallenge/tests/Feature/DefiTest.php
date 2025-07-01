<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Defi;
use App\Models\VideoDefi;
use Tests\TestCase;

class DefiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
public function test_defi_creation_via_factory(): void
{
   

    $defi = Defi::factory()->create();

    $this->assertDatabaseHas('defi', [
        'id_defi' => $defi->id_defi,
    ]);
}

public function test_video_defi_creation(): void
{
    $video = VideoDefi::factory()->create();

    $this->assertDatabaseHas('video_defi', [
        'id_defi' => $video->id_defi,
    ]);
}


}
