<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class ParticipantesController extends Controller
{
    public function mostrarParticipantes(){
 
         $listaParticipantes = $this -> obtenerParticipantes();
 
         return view('participantes', compact('listaParticipantes'));
    }

    public function obtenerParticipantes(){
        $client = new Client();

         $response = $client->get("http://localhost/Apis/Personas/apiPersonas.php");
 
         $listaParticipantes = json_decode($response->getBody(), true);
         return $listaParticipantes;
    }

    public function insertarParticipantes(Request $peticion){
        $cedula = $peticion->input("cedula");
        $nombre=$peticion->input("nombre");
        $apellido= $peticion->input("apellido");
        $fechaNacimiento= $peticion->input("fechaNacimiento");
        $clave = $peticion->input("clave");

        if($cedula==''|| $nombre ==''|| $apellido =='' || $fechaNacimiento =='' || $clave ==''){
            return false;
        }

        $cliente = new Client();

        $url = "http://localhost/Apis/Personas/apiPersonas.php";
    
        $datos = [
            'cedula' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'fechaNacimiento' => $fechaNacimiento,
            'clave' => $clave
        ];
    
        $respuesta = $cliente->request('POST', $url, [
            'form_params' => $datos,
        ]);

        $contenido = $respuesta->getBody()->getContents();
        if($contenido == 'true'){
            return true;
        }else{
            return false;
        }
    }

    public function actualizarParticipantes(Request $peticion){
        $cedula = $peticion->input("cedula");
        $nombre = $peticion->input("nombre");
        $apellido = $peticion->input("apellido");
        $fechaNacimiento = $peticion->input("fechaNacimiento");
        $rol = $peticion->input("rol");
        $clave = $peticion->input("clave");

        if($cedula==''|| $nombre ==''|| $apellido =='' || $fechaNacimiento =='' || $rol =='' || $clave ==''){
            return false;
        }

        $client = new Client();
    
        $url = "http://localhost/Apis/Personas/apiPersonas.php";
    
        $data = [
            'cedula' => $cedula,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'fechaNacimiento' => $fechaNacimiento,
            'rol' => $rol,
            'clave' => $clave,
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

    public function eliminarParticipantes(Request $peticion){
        $cedula = $peticion->input("cedula");

        if($cedula==''){
            return false;
        }

        $client = new Client();
    
        $url = "http://localhost/Apis/Personas/apiPersonas.php";
    
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
