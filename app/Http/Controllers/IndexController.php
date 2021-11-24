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
     * Muestra la vista de inicio
     *
     * @return view index
     * 
     * Yonathan Bohorquez - 17/11/2021
     */
    public function index()
    {
        $tipoReservas = TipoReserva::get();
        return view('index', compact('tipoReservas'));
    }

    /**
     * Muestra la vista para el select de paises
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view selectPais
     * 
     * Yonathan Bohorquez - 17/11/2021
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
     * Muestra la vista para el select de ciudades
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view selectCiudad
     * 
     * Yonathan Bohorquez - 17/11/2021
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
     * Muestra la vista para el formulario de reserva y selección de horas disponibles
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view reservar
     * 
     * Yonathan Bohorquez - 22/11/2021
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
     * Muestra la vista actualizar la sección de la reserva y listado de horas seleccionadas
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view horas
     * 
     * Yonathan Bohorquez - 23/11/2021
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

        $cantidad = 0;
        foreach($horas as $hora){
            if($hora != ""){
                $cantidad++;
            }
        }
        
        return view('horas', compact('horas', 'horas_array', 'cantidad'));
    }

    /**
     * Muestra la vista para actualizar la sección de horas disponibles y seleccionadas
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view horas_lista
     * 
     * Yonathan Bohorquez - 23/11/2021
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
     * Muestra la vista para finalizar la reserva
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view finalizar
     * 
     * Yonathan Bohorquez - 23/11/2021
     */
    public function reservar(Request $request)
    {
        $tipoReserva = TipoReserva::get($request['tipo-reserva']);
        if($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('paisId')){
            $pais = Pais::get($request->paisId);
        }

        if($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $request->has('ciudadId')){
            $ciudad = Ciudad::get($request->ciudadId);
        }

        $fecha = $request->fecha;
        $horas_array = explode(',', $request['horas-array']);
        $total = $request['cantidad-horas'] * $tipoReserva->TTR_Costo_Tipo_Reserva;
        
        return view('finalizar', compact('tipoReserva', 'pais', 'ciudad', 'fecha', 'horas_array', 'total'));
    }
}
