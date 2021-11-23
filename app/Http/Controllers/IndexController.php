<?php

namespace App\Http\Controllers;

use App\Models\TipoReserva;
use App\Models\Pais;
use App\Models\Ciudad;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoReservas = TipoReserva::get();
        return view('index', compact('tipoReservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaises(Request $request)
    {
        $tipoReserva = ($request->tipoReserva != null || $request->tipoReserva != 0) ? TipoReserva::get($request->tipoReserva) : null;
        $paises = null;
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1) {
            $paises = Pais::get();
        }
        return view('selectPais', compact('tipoReserva', 'paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCiudades(Request $request)
    {
        $pais = Pais::get($request->pais);

        if($pais) {
            $ciudades = Ciudad::getPorPais($pais->id);
        }
        return view('selectCiudad', compact('ciudades'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function seleccionarReserva(Request $request)
    {
        $tipoReserva = TipoReserva::get($request->tipoId);
        $fecha = $request->fecha;
        $pais = null;
        $ciudad = null;
        if($request->has('paisId')){
            $pais = Pais::get($request->paisId);
        }
        if($request->has('ciudadId')){
            $ciudad = Ciudad::get($request->ciudadId);
        }
        return view('reservar', compact('tipoReserva', 'fecha', 'pais', 'ciudad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agregarHora(Request $request)
    {
        //dd($request->horas_array);
        $horas_array = $request->horas_array.",".$request->hora;
        $horas = explode(',',$horas_array);
        
        return view('horas', compact('horas', 'horas_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
