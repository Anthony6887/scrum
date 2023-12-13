<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class participantesTest extends TestCase
{

    public function recuperarVistaParticipantes(): void
    {
        $response = $this->get('/principal/participantes');

        $response->assertStatus(200);
    }
}
