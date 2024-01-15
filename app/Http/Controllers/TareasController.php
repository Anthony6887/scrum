<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class TareasController extends Controller
{
    public function mostrarTareas()
    {
        session_start();

        if(isset($_SESSION['usuario'])){
            $listaTareas = $this->obtenerTareas($_SESSION['idProyecto']);
            $usuario = $_SESSION['usuario'];
            $listaSprints = $this->obtenerSprints();
            $sprint = $_SESSION['sprint'];
            $rol = $_SESSION['rol'];
            return view('tareas', compact('listaTareas','usuario','listaSprints','sprint','rol'));
        }else{
            return view('login');
        }
    }

    public function obtenerSprints()
    {
        $client = new Client();
        $response = $client->get(env('API_URL')."/Apis/Sprint/apiSprint.php?idProyecto=".$_SESSION['idProyecto']."&sprint=".$_SESSION['sprint']);
        $listaParticipantes = json_decode($response->getBody(), true);
        return $listaParticipantes;
    }

    public function obtenerTareas($idProyecto)
    {
        $client = new Client();

        $response = $client->get(env('API_URL')."/Apis/Tareas/apiTareas.php?proyecto=". $idProyecto."&sprint=".$_SESSION['sprint']);

        $listaParticipantes = json_decode($response->getBody(), true);
        return $listaParticipantes;
    }

    public function establecerTareas(Request $peticion)
    {
        
        $idProyecto = $peticion->input("idProyecto");
        $sprint = $peticion->input("sprint");

        session_start();
        $_SESSION['idProyecto'] = $idProyecto;
        $_SESSION['sprint'] = $sprint;
        $this->establecerRol($_SESSION['idProyecto']);
        echo json_encode($_SESSION['idProyecto']);
    }

    public function establecerRol($idProyecto){
        $client = new Client();

        $response = $client->get(env('API_URL')."/Apis/Personas/apiPersonas.php?idProyecto=". $idProyecto."&participante=".$_SESSION['usuario'] . "&rolProyecto=0");

        $rol = json_decode($response->getBody(), true);

        $_SESSION['rol']=$rol;
    }

    public function establecerSprint(Request $peticion){
        $sprint = $peticion->input("sprint");
        session_start();
        $_SESSION['sprint'] = $sprint;
    }
    public function insertarTareas(Request $peticion)
    {
        $nombre = $peticion->input("nombre");
        $descripcion = $peticion->input("descripcion");

        if ($nombre == '' || $descripcion == '') {
            return false;
        }

        $cliente = new Client();

        $url = env('API_URL')."/Apis/Tareas/apiTareas.php";

        session_start();

        $datos = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'proyecto' => $_SESSION['idProyecto'],
            'sprint' =>$_SESSION['sprint']
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
            $url = env('API_URL')."/Apis/Tareas/apiTareas.php?progreso=0";
        }else{
            if($estado =='finalizar'){
                $url = env('API_URL')."/Apis/Tareas/apiTareas.php";
            }else{
                return false;
            }
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

        $url = env('API_URL')."/Apis/Tareas/apiTareas.php";

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
