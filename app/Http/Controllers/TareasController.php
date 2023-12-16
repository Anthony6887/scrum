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
        $usuario = $_SESSION['usuario'];
        return view('tareas', compact('listaTareas','usuario'));
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
        $idTarea = $peticion->input("idTarea");
        $estado = $peticion->input("estado");
        session_start();
        $participante = $_SESSION["usuario"];
        


        $client = new Client();

        $url = "";

        if($estado == 'progreso'){
            $url = "http://localhost/Apis/Tareas/apiTareas.php?progreso=0";
        }else{
            $url = "http://localhost/Apis/Tareas/apiTareas.php";
        }


        $data = [
            'idTarea' => $idTarea,
            'encargado' => $participante
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
        $idTarea = $peticion->input("idTarea");

        if ($idTarea == '') {
            return false;
        }

        $client = new Client();

        $url = "http://localhost/Apis/Tareas/apiTareas.php";

        $data = [
            'idTarea' => $idTarea
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
