<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SprintController extends Controller
{
    public function insertarSprint(Request $peticion)
    {

        $cliente = new Client();

        $url = env('API_URL')."/Apis/Sprint/apiSprint.php";

        session_start();
        
        $datos = [
            'idProyecto' => $_SESSION['idProyecto'],
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

    public function eliminarSprint(Request $peticion)
    {
        session_start();

        $client = new Client();

        $url = env('API_URL')."/Apis/Sprint/apiSprint.php";

        $data = [
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
