<?php

namespace App\Http\Controllers;

use App\Models\TipoReserva;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    public function index()
    {
        return view('administracion.index');
    }
}
