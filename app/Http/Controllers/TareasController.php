<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class TareasController extends Controller
{
    public function mostrarTareas()
    {
        session_start();
        $listaTareas = $this->obtenerTareas($_SESSION['idProyecto']);

        return view('tareas', compact('listaTareas'));
    }

    public function obtenerTareas($idProyecto)
    {
        $client = new Client();

        $response = $client->get("http://localhost/Apis/Tareas/apiTareas.php?proyecto=". $idProyecto);

        $listaParticipantes = json_decode($response->getBody(), true);
        return $listaParticipantes;
    }

    public function establecerTareas(Request $peticion)
    {
        
        $idProyecto = $peticion->input("idProyecto");

        session_start();
        $_SESSION['idProyecto'] = $idProyecto;
        echo json_encode($_SESSION['idProyecto']);
    }
    public function insertarTareas(Request $peticion)
    {
        $nombre = $peticion->input("nombre");
        $descripcion = $peticion->input("descripcion");

        if ($nombre == '' || $descripcion == '') {
            return false;
        }

        $cliente = new Client();

        $url = "http://localhost/Apis/Tareas/apiTareas.php";

        session_start();

        $datos = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'proyecto' => $_SESSION['idProyecto']
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

    public function actualizarTareas(Request $peticion)
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

        $url = "http://localhost/Apis/Tareas/apiTareas.php";

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

    public function eliminarTareas(Request $peticion)
    {
        $cedula = $peticion->input("cedula");

        if ($cedula == '') {
            return false;
        }

        $client = new Client();

        $url = "http://localhost/Apis/Tareas/apiTareas.php";

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
