<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;

class TitularesController extends Controller
{
    public function index()
    {
        $titulares = Pago::where('TPG_Estado_Pago', 'Aprobada')
            ->with('reserva')
            ->with('reserva.titular')
            ->with('reserva.tipo_reserva')
            ->get();
        
        return view('administracion.titulares.listar', compact('titulares'));
    }
}
