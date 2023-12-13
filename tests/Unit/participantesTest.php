<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ParticipantesController;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests; 


class participantesTest extends TestCase
{
    use MakesHttpRequests;

    

    public function testCrearParticipanteExitoso(): void
    {

        $peticion = Request::create('/principal/participantes', 'POST', [
            'cedula' => '1804124160',
            'nombre' => 'Sebastian',
            'apellido' => 'Ilbay',
            'fechaNacimiento' => '2002-06-01',
            'rol' => 'desarrollador',
            'clave' => '123abc'
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->insertarParticipantes($peticion);
        $this->assertTrue($respuesta);
    }

    public function testCargarParticipantesExitoso(): void
    {
        $peticion = Request::create('/principal/participantes', 'GET', []);
        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->obtenerParticipantes($peticion);
        $this->assertNotNull($respuesta);
    }

    public function testNoCrearParticipanteCedulaDuplicada(): void
    {

        $peticion = Request::create('/principal/participantes', 'POST', [
            'cedula' => '1804124160',
            'nombre' => 'Sebastian',
            'apellido' => 'Ilbay',
            'fechaNacimiento' => '2002-06-01',
            'rol' => 'desarrollador',
            'clave' => '123abc'
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->insertarParticipantes($peticion);
        $this->assertFalse($respuesta);
    }

    public function testNoCrearParticipanteCamposIncompletos(): void
    {

        $peticion = Request::create('/principal/participantes', 'POST', [
            'cedula' => '1804124160',
            'nombre' => 'Sebastian',
            'apellido' => '',
            'fechaNacimiento' => '2002-06-01',
            'rol' => 'desarrollador',
            'clave' => '123abc'
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->insertarParticipantes($peticion);
        $this->assertFalse($respuesta);
    }

    public function testNoCrearParticipanteCamposNulos(): void
    {

        $peticion = Request::create('/principal/participantes', 'POST', [
            'cedula' => null,
            'nombre' => null,
            'apellido' => null,
            'fechaNacimiento' => null,
            'rol' => null,
            'clave' => null
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->insertarParticipantes($peticion);
        $this->assertFalse($respuesta);
    }


    public function testEliminarParticipanteExitoso(): void
    {

        $peticion = Request::create('/principal/participantes', 'DELETE', [
            'cedula' => '1804124160',
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->eliminarParticipantes($peticion);
        $this->assertTrue($respuesta);
    }

    public function testNoEliminarParticipanteNoExistente(): void
    {

        $peticion = Request::create('/principal/participantes', 'DELETE', [
            'cedula' => '010',
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->eliminarParticipantes($peticion);
        $this->assertFalse($respuesta);
    }


    public function testActualizarParticipanteExitoso(): void
    {

        $peticion = Request::create('/principal/participantes', 'PUT', [
            'cedula' => '1804124160',
            'nombre' => 'Sebastian',
            'apellido' => 'Rodriguez',
            'fechaNacimiento' => '2002-06-01',
            'rol' => 'desarrollador',
            'clave' => '123abc'
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->actualizarParticipantes($peticion);
        $this->assertTrue($respuesta);
    }

    public function testNoActualizarParticipanteDatosIncompletos(): void
    {

        $peticion = Request::create('/principal/participantes', 'PUT', [
            'cedula' => '1804124160',
            'nombre' => 'Sebastian',
            'apellido' => '',
            'fechaNacimiento' => '2002-06-01',
            'rol' => 'desarrollador',
            'clave' => ''
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->actualizarParticipantes($peticion);
        $this->assertFalse($respuesta);
    }

    public function testNoActualizarParticipanteDatosNulos(): void
    {

        $peticion = Request::create('/principal/participantes', 'PUT', [
            'cedula' => null,
            'nombre' => null,
            'apellido' => null,
            'fechaNacimiento' => null,
            'rol' => null,
            'clave' => null
        ]);

        $participanteController = new ParticipantesController();
        $respuesta = $participanteController->actualizarParticipantes($peticion);
        $this->assertFalse($respuesta);
    }
}
