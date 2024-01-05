<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function cerrarSesion()
    {
        session_start();

        $_SESSION = array();

        session_destroy();

        return view('login');
    }
}
