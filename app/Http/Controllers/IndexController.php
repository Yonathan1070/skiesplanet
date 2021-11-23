<?php

namespace App\Http\Controllers;

use App\Models\TipoReserva;
use App\Models\Pais;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $horas0_12 = [['0-1', '0'],['1-2', '0'],['2-3', '0'],['3-4', '0'],['4-5', '0'],['5-6', '0'],['6-7', '0'],['7-8', '0'],['8-9', '0'],['9-10', '0'],['10-11', '0'],['11-12', '0']];
        $horas12_24 = [['12-13', '0'],['13-14', '0'],['14-15', '0'],['15-16', '0'],['16-17', '0'],['17-18', '0'],['18-19', '0'],['19-20', '0'],['20-21', '0'],['21-22', '0'],['22-23', '0'],['23-24', '0']];
        if($request->has('paisId')){
            $pais = Pais::get($request->paisId);
        }
        if($request->has('ciudadId')){
            $ciudad = Ciudad::get($request->ciudadId);
        }
        return view('reservar', compact('tipoReserva', 'fecha', 'pais', 'ciudad', 'horas0_12', 'horas12_24'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agregarHora(Request $request)
    {
        $horas_array = str_replace(",,", "", $request->horas_array);
        if($request->selected == 0){
            $horas_array = $horas_array.",".$request->hora;
        }else{
            $horas_array = str_replace($request->hora, "", $horas_array);
        }
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
    public function actualizarHoras(Request $request)
    {
        $horas0_12 = [['0-1', '0'],['1-2', '0'],['2-3', '0'],['3-4', '0'],['4-5', '0'],['5-6', '0'],['6-7', '0'],['7-8', '0'],['8-9', '0'],['9-10', '0'],['10-11', '0'],['11-12', '0']];
        $horas12_24 = [['12-13', '0'],['13-14', '0'],['14-15', '0'],['15-16', '0'],['16-17', '0'],['17-18', '0'],['18-19', '0'],['19-20', '0'],['20-21', '0'],['21-22', '0'],['22-23', '0'],['23-24', '0']];
        $horas0_12_new = [];
        $horas12_24_new = [];
        $horas_array = explode(",",$request->horas_array);
        foreach ($horas0_12 as $hora) {
            if(in_array($hora[0], $horas_array)){
                $hora[1] = '1';
            }

            array_push($horas0_12_new, $hora);
        }
        $horas0_12 = $horas0_12_new;

        foreach ($horas12_24 as $hora) {
            if(in_array($hora[0], $horas_array)){
                $hora[1] = '1';
            }
            array_push($horas12_24_new, $hora);
        }
        $horas12_24 = $horas12_24_new;
        
        return view('horas_lista', compact('horas0_12', 'horas12_24'));
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
