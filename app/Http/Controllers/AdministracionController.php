<?php

namespace App\Http\Controllers;

use App\Models\Traduccion;
use App\Models\TipoReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AdministracionController extends Controller
{
    public function index()
    {
        return view('administracion.index');
    }

    public function traduccion(Request $request)
    {
        if($request->ajax()){
            $traducciones = Traduccion::where('TTD_Tabla_Traduccion', 'TBL_Tipo_Reserva')
                ->where('TTD_Id_Traduccion', $request->id)
                ->get();
            
            $nombre = '';
            $id = 0;
            if($request->tabla == 'TBL_Tipo_Reserva'){
                $reserva = TipoReserva::obtener($request->id);
                $nombre = $reserva->TTR_Nombre_Tipo_Reserva;
                $id = $reserva->id;

                return view('administracion.planes.traducciones', compact('traducciones', 'nombre', 'id'));
            }
        }
    }

    public function crearTraduccion(Request $request)
    {
        if($request->ajax()){
            $traducciones = Traduccion::where('TTD_Tabla_Traduccion', 'TBL_Tipo_Reserva')
                ->where('TTD_Id_Traduccion', $request->id)
                ->get();
            
            if($request->tabla == 'TBL_Tipo_Reserva'){
                return view('administracion.planes.form_traduccion', compact('traducciones'));
            }
        }
    }

    public function guardarTraduccion(Request $request)
    {
        if($request->ajax()){
            if($request->tableName == 'TBL_Tipo_Reserva'){
                $campoNombre = Traduccion::obtenerCampo($request->tableName, $request->idRegistro, $request->TTD_Idioma_Traduccion, $request->campoNombre);
                
                if(!$campoNombre){
                    $traduccion = new Traduccion();
                    $traduccion->TTD_Tabla_Traduccion = $request->tableName;
                    $traduccion->TTD_Id_Traduccion = $request->idRegistro;
                    $traduccion->TTD_Idioma_Traduccion = $request->TTD_Idioma_Traduccion;
                    $traduccion->TTD_Campo_Traduccion = $request->campoNombre;
                    $traduccion->TTD_Descripcion_Traduccion = $request->nombre;
                    $traduccion->save();
                } else{
                    $campoNombre->update(['TTD_Descripcion_Traduccion' => $request->nombre]);
                }

                $campoDescripcion = Traduccion::obtenerCampo($request->tableName, $request->idRegistro, $request->TTD_Idioma_Traduccion, $request->campoDescripcion);
                
                if(!$campoDescripcion){
                    $traduccion = new Traduccion();
                    $traduccion->TTD_Tabla_Traduccion = $request->tableName;
                    $traduccion->TTD_Id_Traduccion = $request->idRegistro;
                    $traduccion->TTD_Idioma_Traduccion = $request->TTD_Idioma_Traduccion;
                    $traduccion->TTD_Campo_Traduccion = $request->campoDescripcion;
                    $traduccion->TTD_Descripcion_Traduccion = $request->descripcion;
                    $traduccion->save();
                }else{
                    $campoDescripcion->update(['TTD_Descripcion_Traduccion' => $request->descripcion]);
                }

                $nombre = $request->tableName;
                $id = $request->idRegistro;

                $traducciones = Traduccion::where('TTD_Tabla_Traduccion', 'TBL_Tipo_Reserva')
                    ->where('TTD_Id_Traduccion', $id)
                    ->get();

                return $this->vista(Lang::get('messages.TraduccionCreada'), Lang::get('messages.TaxMendez'), Lang::get('messages.NotificationTypeSuccess'), view('administracion.planes.traducciones')->with('nombre', $nombre)->with('id', $id)->with('traducciones', $traducciones)->render());
            }
        }else{
            abort(404);
        }
    }

    private function vista($mensaje=null, $titulo, $tipo, $vista)
    {
        return response()->json(['view'=>$vista, 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }
}
