<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function mostrarProyectos()
    {
        session_start();
        if(isset($_SESSION['usuario'])){
            $listaProyectos = $this->obtenerProyectos();
            return view('proyectos', compact('listaProyectos'));
        }else{
            return view('login');
        }
    }

    public function obtenerProyectos()
    {
        $client = new Client();
        $response = $client->get(env('API_URL')."/Apis/Proyectos/apiProyectos.php?participante=".$_SESSION['usuario']);
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
        $participante = $_SESSION['usuario'];

        if ($nombre == '' || $descripcion == '' || $fechaInicio == '' || $fechaFin == '') {
            return false;
        }

        $cliente = new Client();

        $url = env('API_URL')."/Apis/Proyectos/apiProyectos.php";

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
        $nombre = $peticion->input("nombreProyectoEditar");
        $descripcion = $peticion->input("descripcionProyectoEditar");
        $fechaInicio = $peticion->input("fechaInicioEditar");
        $fechaFin = $peticion->input("fechaFinEditar");
        $estado = $peticion->input("estado");

        if ($nombre == '' || $descripcion == '' || $fechaInicio == '' || $fechaFin == '') {
            return false;
        }

        $client = new Client();

        $url = env('API_URL')."/Apis/Proyectos/apiProyectos.php";

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

        $url = env('API_URL')."/Apis/Proyectos/apiProyectos.php";

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
