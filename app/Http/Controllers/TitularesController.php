<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Reserva;

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

    public function cambiar(Request $request, $id){
        $pago = Pago::where('id', $id)
            ->with('reserva')
            ->with('reserva.titular')
            ->with('reserva.tipo_reserva')
            ->first();
        if($pago){
            $hora = $request->hora;
            return view('administracion.titulares.cambiar', compact('pago', 'hora'));
        }
        return response()->json(['mensaje'=>Lang::get('messages.titularNoExiste'), 'titulo'=>Lang::get('messages.appName'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
    }
}
