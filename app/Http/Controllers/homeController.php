<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    // Cargar la plantilla inicial
    public function plantilla()
    {
        return view('landing.plantilla');
    }

    // Cargar el panel
    public function index()
    {
        return view('panel.index');
    }
}
