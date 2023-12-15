<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function mostrarProyectos(Request $peticion)
    {
        session_start();
        $cedula = '';
        try {
            $cedula = $peticion->input("cedula");
            $_SESSION['cedula']= $cedula;
        } catch (\Throwable $th) {
            $cedula=$_SESSION['cedula'];
        }

        $listaProyectos = $this->obtenerProyectos($cedula);
        return view('proyectos', compact('listaProyectos'));


    }

    public function obtenerProyectos($cedula)
    {
        $client = new Client();

        $response = $client->get("http://localhost/Apis/Proyectos/apiProyectos.php?id=".$cedula);

        $listaParticipantes = json_decode($response->getBody(), true);
        return $listaParticipantes;
    }

    public function insertarProyectos(Request $peticion)
    {
        $nombre = $peticion->input("nombreProyecto");
        $descripcion = $peticion->input("descripcionProyecto");
        $fechaInicio = $peticion->input("fechaInicio");
        $fechaFin = $peticion->input("fechaFin");
        
        session_start();
        $participante = $_SESSION['cedula'];

        if ($nombre == '' || $descripcion == '' || $fechaInicio == '' || $fechaFin == '') {
            return false;
        }

        $cliente = new Client();

        $url = "http://localhost/Apis/Proyectos/apiProyectos.php";

        $datos = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'participante'=> $participante
        ];

        $respuesta = $cliente->request('POST', $url, [
            'form_params' => $datos,
        ]);

        $contenido = $respuesta->getBody()->getContents();
        if ($contenido == 'true') {
            return true;
        } else {
            return false;
        }
    }

    public function actualizarProyectos(Request $peticion)
    {
        $id = $peticion->input("id");
        $nombre = $peticion->input("nombreProyecto");
        $descripcion = $peticion->input("descripcionProyecto");
        $fechaInicio = $peticion->input("fechaInicio");
        $fechaFin = $peticion->input("fechaFin");
        $estado = $peticion->input("estado");

        if ($nombre == '' || $descripcion == '' || $fechaInicio == '' || $fechaFin == '') {
            return false;
        }

        $client = new Client();

        $url = "http://localhost/Apis/Proyectos/apiProyectos.php";

        $data = [
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'estado' => $estado
        ];

        $jsonData = json_encode($data);

        try {
            $response = $client->request('PUT', $url, [
                'body' => $jsonData,
                'headers' => ['Content-Type' => 'application/json'],
            ]);

            $responseContent = $response->getBody()->getContents();

            if ($responseContent == 'true') {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function eliminarProyectos(Request $peticion)
    {
        $cedula = $peticion->input("cedula");

        if ($cedula == '') {
            return false;
        }

        $client = new Client();

        $url = "http://localhost/Apis/Proyectos/apiProyectos.php";

        $data = [
            'cedula' => $cedula
        ];

        $jsonData = json_encode($data);

        try {
            $response = $client->request('DELETE', $url, [
                'body' => $jsonData,
                'headers' => ['Content-Type' => 'application/json'],
            ]);

            $responseContent = $response->getBody()->getContents();

            if ($responseContent == 'true') {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
