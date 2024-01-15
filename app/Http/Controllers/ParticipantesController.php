<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class ParticipantesController extends Controller
{
    public function establecerParticipante(Request $peticion){
        $cedula = $peticion->input("cedula");
        session_start();
        $_SESSION['usuario']=$cedula;
        return redirect()->route('mostrarProyectos');
    }

    public function mostrarParticipantes(){
 
         session_start();
         if(isset($_SESSION['usuario']) && $_SESSION['rol'] == 'SCRUM MASTER'){
            $listaParticipantes = $this -> obtenerParticipantes();
            $usuario = $_SESSION['usuario'];
            return view('participantes', compact('listaParticipantes','usuario'));
         }else{
            if($_SESSION['rol'] != 'SCRUM MASTER'){
                return redirect()->route('mostrarProyectos');
            }else{
                return view('login');
            }
         }
    }

    public function obtenerParticipantes(){
        $client = new Client();

         $response = $client->get(env('API_URL')."/Apis/Personas/apiPersonas.php?idProyecto=".$_SESSION['idProyecto']);
 
         $listaParticipantes = json_decode($response->getBody(), true);
         return $listaParticipantes;
    }

    public function agregarParticipantes(Request $peticion){
        try {
            $cedula = $peticion->input("cedula");
            session_start();
    
            if ($cedula == '' || $cedula == null) {
                return response()->json(['success' => false, 'message' => 'Cédula vacía o no identificada']);
            }
    
            $cliente = new Client();
            $url = env('API_URL') . "/Apis/Personas/apiPersonas.php";
        
            $datos = [
                'cedula' => $cedula,
                'idProyecto' => $_SESSION['idProyecto']
            ];
    
            $respuesta = $cliente->request('POST', $url, [
                'form_params' => $datos,
            ]);
    
            $contenido = $respuesta->getBody()->getContents();
    
            if ($contenido == 'true') {
                return response()->json(['success' => true, 'message' => 'Proceso realizado con éxito']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error de proceso: cédula no identificada']);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error en la solicitud: ' . $ex->getMessage()]);
        }
    }

    public function insertarParticipantes(Request $peticion){
        $cedula = $peticion->input("cedula");
        $nombre = $peticion->input("nombre");
        $apellido = $peticion->input("apellido");
        $fechaNacimiento = $peticion->input("fechaNacimiento");
        $clave = $peticion->input("clave");

        if($cedula==''|| $nombre ==''|| $apellido =='' || $fechaNacimiento =='' || $clave ==''){
            return false;
        }

        $client = new Client();
    
        $url = env('API_URL')."/Apis/Personas/apiPersonas.php";
    
        $data = [
            'cedula' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'fechaNacimiento' => $fechaNacimiento,
            'clave' => $clave,
            'insertar'=> "abc"
        ];
    
        $respuesta = $client->request('POST', $url, [
            'form_params' => $data,
        ]);

        $contenido = $respuesta->getBody()->getContents();
        if($contenido == 'true'){
            return true;
        }else{
            return false;
        }
    }

    public function eliminarParticipantes(Request $peticion){
        $cedula = $peticion->input("cedula");

        if($cedula==''){
            return false;
        }

        $client = new Client();
    
        $url = env('API_URL')."/Apis/Personas/apiPersonas.php";
        session_start();
        $data = [
            'cedula' => $cedula,
            'idProyecto' => $_SESSION['idProyecto']
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
