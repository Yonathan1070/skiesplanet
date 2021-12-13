<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoReserva;

class PlanesController extends Controller
{
    public function index()
    {
        $planes = TipoReserva::obtener();
        return view('administracion.planes.listar', compact('planes'));
    }

    public function crear(Request $request)
    {
        if($request->ajax()){
            return view('administracion.planes.crear');
        }
        abort(404);
    }
}
