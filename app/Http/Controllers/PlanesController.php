<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoReserva;
use Illuminate\Support\Facades\Lang;

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

    public function guardar(Request $request)
    {
        if($request->ajax()){
            $plan = TipoReserva::obtenerPorNombre($request->TTR_Nombre_Tipo_Reserva);

            if(!$plan){
                $plan = new TipoReserva();
                $plan->TTR_Nombre_Tipo_Reserva = $request->TTR_Nombre_Tipo_Reserva;
                $plan->TTR_Descripcion_Tipo_Reserva = $request->TTR_Descripcion_Tipo_Reserva;
                $plan->TTR_Costo_Tipo_Reserva = $request->TTR_Costo_Tipo_Reserva;
                $plan->save();

                $planes = TipoReserva::obtener();

                return $this->vista(Lang::get('messages.planCreado'), Lang::get('messages.appName'), Lang::get('messages.NotificationTypeSuccess'), view('administracion.planes.table-data')->with('planes', $planes)->render());
            }
        }
        abort(404);
    }

    public function editar(Request $request, $id)
    {
        if($request->ajax()){
            $tipoReserva = TipoReserva::obtener($id);
            if($tipoReserva){
                return view('administracion.planes.editar', compact('tipoReserva'));
            }
            return response()->json(['mensaje'=>Lang::get('messages.planNoExiste'), 'titulo'=>Lang::get('messages.appName'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function actualizar(Request $request, $id)
    {
        if($request->ajax()){
            if(!TipoReserva::where('id', '<>', $id)->where('TTR_Nombre_Tipo_Reserva', $request->TTR_Nombre_Tipo_Reserva)->first()){
                $tipoReserva = TipoReserva::obtener($id);
                if($tipoReserva){
                    $tipoReserva->TTR_Nombre_Tipo_Reserva = $request->TTR_Nombre_Tipo_Reserva;
                    $tipoReserva->TTR_Descripcion_Tipo_Reserva = $request->TTR_Descripcion_Tipo_Reserva;
                    $tipoReserva->TTR_Costo_Tipo_Reserva = $request->TTR_Costo_Tipo_Reserva;
                    $tipoReserva->save();
                    
                    $planes = TipoReserva::obtener();

                return $this->vista(Lang::get('messages.planEditado'), Lang::get('messages.appName'), Lang::get('messages.NotificationTypeSuccess'), view('administracion.planes.table-data')->with('planes', $planes)->render());
                }
                return response()->json(['mensaje'=>Lang::get('messages.planNoExiste'), 'titulo'=>Lang::get('messages.appName'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.planExiste'), 'titulo'=>Lang::get('messages.appName'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    public function eliminar(Request $request, $id)
    {
        if($request->ajax()){
            $tipoReserva = TipoReserva::obtener($id);
            if($tipoReserva){
                $tipoReserva->delete();
                return response()->json(['mensaje'=>Lang::get('messages.planEliminado'), 'titulo'=>Lang::get('messages.appName'), 'tipo'=>Lang::get('messages.NotificationTypeSuccess'), 'row' => $id]);
            }
            return response()->json(['mensaje'=>Lang::get('messages.planNoExiste'), 'titulo'=>Lang::get('messages.appName'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    private function vista($mensaje=null, $titulo, $tipo, $vista)
    {
        return response()->json(['view'=>$vista, 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }
}
