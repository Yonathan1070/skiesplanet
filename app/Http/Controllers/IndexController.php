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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
