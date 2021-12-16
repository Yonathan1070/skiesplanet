<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Reserva;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\TipoReserva;
use Illuminate\Support\Facades\Lang;
use PDF;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Auth;

class TitularesController extends Controller
{
    public function index()
    {
        $titulares = Pago::where('TPG_Estado_Pago', 'Aprobada')
            ->with('reserva')
            ->with('reserva.titular')
            ->with('reserva.tipo_reserva')
            ->paginate(10);
        
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

    public function actualizar(Request $request, $id)
    {
        if($request->ajax()){
            $pago = Pago::obtener($id);
            if($pago){
                if($pago->reserva->titular->TUS_Nombre_Completo_Usuario != $request->TUS_Nombre_Completo_Usuario && $pago->reserva->titular->TUS_Correo_Electronico_Usuario != $request->TUS_Correo_Electronico_Usuario){
                    $horasSplit = explode(',', $pago->reserva->TRE_Hora_Reserva);
                    $cantidadreserva = 0;
                    foreach ($horasSplit as $split) {
                        if($split != ''){
                            $cantidadreserva++;
                        }
                    }
                    
                    $rolTitular = Rol::where('TRO_Nombre_Rol', 'Titular')->first();
                    $titular = Usuario::where('TUS_Nombre_Completo_Usuario', $request->TUS_Nombre_Completo_Usuario)
                        ->where('TUS_Correo_Electronico_Usuario', $request->TUS_Correo_Electronico_Usuario)
                        ->where('TUS_Rol_Id', $rolTitular->id)
                        ->first();

                    if(!$titular){
                        $titular = new Usuario();
                        $titular->TUS_Nombre_Completo_Usuario = $request->TUS_Nombre_Completo_Usuario;
                        $titular->TUS_Correo_Electronico_Usuario = $request->TUS_Correo_Electronico_Usuario;
                        $titular->TUS_Rol_Id = $rolTitular->id;
                        $titular->save();
                    }

                    if($cantidadreserva > 1){
                        $oldReserva = $pago->reserva;
                        $oldCostoHora = $pago->TPG_Total_Pago/$cantidadreserva;

                        $newReserva = new Reserva();
                        $newReserva->TRE_Tipo_Reserva_Id = $oldReserva->tipo_reserva->id;
                        $newReserva->TRE_Pais_Id = ($oldReserva->pais) ? $oldReserva->pais->id : null;
                        $newReserva->TRE_Ciudad_Id = ($oldReserva->ciudad) ? $oldReserva->ciudad->id : null;
                        $newReserva->TRE_Fecha_Reserva = $oldReserva->TRE_Fecha_Reserva;
                        $newReserva->TRE_Hora_Reserva = $request->hora;
                        $newReserva->TRE_Cliente_Id = $oldReserva->TRE_Cliente_Id;
                        $newReserva->TRE_Titular_Id = $titular->id;
                        $newReserva->save();

                        $newPago = new Pago();
                        $newPago->TPG_Reserva_Id = $newReserva->id;
                        $newPago->TPG_Total_Pago = $oldCostoHora;
                        $newPago->TPG_Fecha_Pago = $pago->TPG_Fecha_Pago;
                        $newPago->TPG_Estado_Pago = $pago->TPG_Estado_Pago;
                        $newPago->TPG_Idioma_Pago = $pago->TPG_Idioma_Pago;
                        $newPago->TPG_Referencia_Pago = $pago->TPG_Referencia_Pago;
                        $newPago->save();

                        $oldReserva->update(['TRE_Hora_Reserva' => str_replace(",".$request->hora, "", $oldReserva->TRE_Hora_Reserva)]);

                        $pago->update(['TPG_Total_Pago' => $oldCostoHora*($cantidadreserva-1)]);
                    }
                }

                $this->enviarMailCertificado(
                    $pago->reserva->titular,
                    $pago->reserva->tipo_reserva,
                    ($pago->reserva->tipo_reserva->TTR_Select_Pais_Tipo_Reserva == 1) ? Pais::obtener($pago->reserva->TRE_Pais_Id) : null,
                    ($pago->reserva->tipo_reserva->TTR_Select_Ciudad_Tipo_Reserva == 1) ? Ciudad::obtener($pago->reserva->TRE_Ciudad_Id) : null,
                    $pago->reserva->TRE_Fecha_Reserva,
                    $request->hora,
                    Lang::get('messages.certificadoTitulo'),
                    Lang::get('messages.certificadoSubtitulo'),
                    Lang::get('messages.certificadoAsunto')
                );
                    
                $titulares = Pago::where('TPG_Estado_Pago', 'Aprobada')
                    ->with('reserva')
                    ->with('reserva.titular')
                    ->with('reserva.tipo_reserva')
                    ->paginate(10);

                return $this->vista(Lang::get('messages.titularCambiado'), Lang::get('messages.appName'), Lang::get('messages.NotificationTypeSuccess'), view('administracion.titulares.table-data')->with('titulares', $titulares)->render());
            }
            return response()->json(['mensaje'=>Lang::get('messages.certificadoNoExiste'), 'titulo'=>Lang::get('messages.appName'), 'tipo'=>Lang::get('messages.NotificationTypeError')]);
        }
        abort(404);
    }

    private function enviarMailCertificado($titular, $tipoReserva, $pais, $ciudad, $fecha, $hora, $titulo, $subTitulo, $asunto)
    {
        try{
            if($hora != ""){
                $pdf = PDF::loadView(
                    'pdf.certificado', [
                        'titular' => $titular,
                        'tipoReserva' => $tipoReserva,
                        'pais' => $pais,
                        'ciudad' => $ciudad,
                        'fecha' => $fecha,
                        'horas' => $hora
                    ]
                )->setPaper([0, 0, 1500,  1060.5]);
            
                $fileName = 'CertificadoTitularidad-'.$titular->TUS_Nombre_Completo_Usuario.'-'.$hora.'-'.(($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $ciudad) ? $ciudad->TCI_Nombre_Ciudad : (($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 0) ? $pais->TPA_Nombre_Pais_Espanol : Lang::get('messages.reservasDescripcion1_3'))).'-'.Carbon::now()->format('Y-m-d').'.pdf';
            }

            Mail::send('correo.titularidad', [
                'titulo' => $titulo,
                'nombreCliente' => $titular->TUS_Nombre_Completo_Usuario,
                'subtitulo' => $subTitulo
            ], function($message) use ($titular, $asunto, $pdf, $fileName) {
                $message->from('admin@skiesplanet.com', 'SKIES PLANET');
                $message->to(
                    $titular->TUS_Correo_Electronico_Usuario, 'SKIES PLANET'
                )->subject($asunto);
                $message->attachData($pdf->output(), $fileName.'.pdf');
            });

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function vista($mensaje=null, $titulo, $tipo, $vista)
    {
        return response()->json(['view'=>$vista, 'mensaje'=>$mensaje, 'titulo'=>$titulo, 'tipo'=>$tipo]);
    }

    function page(Request $request)
    {
        if($request->ajax()){
            $titulares = Pago::where('TPG_Estado_Pago', 'Aprobada')
                ->with('reserva')
                ->with('reserva.titular')
                ->with('reserva.tipo_reserva')
                ->paginate(10);
            
            return view('administracion.titulares.table-data', compact('titulares'))->render();
        }
    }

    public function crear(Request $request)
    {
        if($request->ajax()){
            $tipoReservas = TipoReserva::get();

            return view('administracion.titulares.crear', compact('tipoReservas'));
        }
        abort(404);
    }

    public function disponibles(Request $request)
    {
        $tipoReserva = TipoReserva::obtener($request->tipoReserva);
        $pais = null; $ciudad = null;
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('pais') && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $request->has('ciudad')){
            $pais = Pais::obtener($request->pais);
            $ciudad = Ciudad::obtener($request->ciudad);
        }
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('pais') && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 0){
            $pais = Pais::obtener($request->pais);
        }

        $horas = "0-1,1-2,2-3,3-4,4-5,5-6,6-7,7-8,8-9,9-10,10-11,11-12,12-13,13-14,14-15,15-16,16-17,17-18,18-19,19-20,20-21,21-22,22-23,23-24";
        
        //Verificar disponibilidad de horas
        $fecha = Carbon::createFromFormat('Y-m-d', $request['fecha'])->format('m-d');
        
        $disponibilidad = Reserva::from('TBL_Reserva as r')
            ->join('TBL_Pago as p', 'r.id', 'p.TPG_Reserva_Id')
            ->where('p.TPG_Estado_Pago', 'Aprobada')
            ->where('r.TRE_Fecha_Reserva', $fecha)
            ->where('r.TRE_Tipo_Reserva_Id', $tipoReserva->id);

        if($pais != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Pais_Id', $pais->id);
        }

        if($ciudad != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Ciudad_Id', $ciudad->id);
        }

        $disponibilidad = $disponibilidad->select('r.TRE_Hora_Reserva')
            ->get();
        
        foreach ($disponibilidad as $horaP) {
            $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
            foreach ($horas_array as $horaA) {
                if($horaA != ''){
                    $horas = str_replace(",".$horaA.",", ",", $horas);
                }
            }
        }

        $disponibilidad = Reserva::from('TBL_Reserva as r')
            ->join('TBL_Pago as p', 'r.id', 'p.TPG_Reserva_Id')
            ->where('p.TPG_Estado_Pago', 'Pendiente')
            ->where('r.TRE_Fecha_Reserva', $fecha)
            ->where('r.TRE_Tipo_Reserva_Id', $tipoReserva->id);

        if($pais != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Pais_Id', $pais->id);
        }

        if($ciudad != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Ciudad_Id', $ciudad->id);
        }

        $disponibilidad = $disponibilidad->select('r.TRE_Hora_Reserva')
            ->get();

        foreach ($disponibilidad as $horaP) {
            $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
            foreach ($horas_array as $horaA) {
                if($horaA != ''){
                    $horas = str_replace(",".$horaA.",", ",", $horas);
                }
            }
        }
        
        return view('administracion.titulares.horas_lista', compact('horas'));
    }

    public function guardar(Request $request){
        //Usuario Autenticado
        $usuario = Auth::user();

        //Buscar Rol cliente
        $rolCliente = Rol::where('TRO_Nombre_Rol', 'Cliente')->first();
        //Crear rol de cliente si no existe
        if(!$rolCliente){
            $rolCliente = Rol::guardar('Cliente');
        }
        //Buscar cliente por correo
        $cliente = Usuario::obtener($rolCliente->id, $usuario->TUS_Correo_Electronico_Usuario);
        //Si no existe el cliente lo creamos
        if(!$cliente){
            $cliente = Usuario::guardar($usuario->TUS_Nombre_Completo_Usuario, $usuario->TUS_Correo_Electronico_Usuario, $usuario->TUS_Telefono_Usuario, $rolCliente->id);
        }

        //Buscar Rol titular
        $rolTitular = Rol::where('TRO_Nombre_Rol', 'Titular')->first();
        //Crear rol de titular si no existe
        if(!$rolTitular){
            $rolTitular = Rol::guardar('Titular');
        }
        //Buscar titular por correo
        $titular = Usuario::obtener($rolTitular->id, $request->correoTitular);
        //Si no existe el titular lo creamos
        if(!$titular){
            $titular = Usuario::guardar($request->nombreTitular, $request->correoTitular, null, $rolTitular->id);
        }

        //Crear Reserva y generar certificado
        if ($cliente && $titular) { 
            $idCliente = $cliente->id;
            $idTitular = $titular->id;

            $tipoReserva = TipoReserva::obtener($request->tipoId);
            $pais = null; $ciudad = null;
            if($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('paisId')){
                $pais = Pais::obtener($request->paisId);
                if($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $request->has('ciudadId')){
                    $ciudad = Ciudad::obtener($request->ciudadId);
                }
            }

            $fecha = Carbon::createFromFormat('Y-m-d', $request->fecha)->format('m-d');

            //Obtenemos la reserva
            $reserva = Reserva::obtenerReserva($tipoReserva->id, $fecha, $request->hora, $idCliente, $idTitular, (($pais) ? $pais->id : null), (($ciudad) ? $ciudad->id : null));
            //Si no existe la reserva la creamos
            if(!$reserva){
                $reserva = new Reserva();
                $reserva->TRE_Tipo_Reserva_Id = $tipoReserva->id;
                $reserva->TRE_Pais_Id = (($pais) ? $pais->id : null);
                $reserva->TRE_Ciudad_Id = (($ciudad) ? $ciudad->id : null);
                $reserva->TRE_Fecha_Reserva = $fecha;
                $reserva->TRE_Hora_Reserva = $request->hora;
                $reserva->TRE_Cliente_Id = $idCliente;
                $reserva->TRE_Titular_Id = $idTitular;

                $reserva = Reserva::guardar($reserva);

                //Informacion Cupon
                $cupon = "GIFT".Carbon::now()->format('YmdHis');
                $porcentajeDescuento = 100;

                //Insertar pago
                $pago = new Pago();
                $pago->TPG_Reserva_Id = $reserva->id;
                $pago->TPG_Total_Pago = $tipoReserva->TTR_Costo_Tipo_Reserva - (($tipoReserva->TTR_Costo_Tipo_Reserva*$porcentajeDescuento)/100);
                $pago->TPG_Cupon_Descuento_Pago = $cupon;
                $pago->TPG_Total_Descuento_Pago = (($tipoReserva->TTR_Costo_Tipo_Reserva*$porcentajeDescuento)/100);
                $pago->TPG_Fecha_Pago = Carbon::now()->format('Y-m-d');
                $pago->TPG_Estado_Pago = 'Aprobada';
                $pago->TPG_Idioma_Pago = session()->get('locale');
                $pago->TPG_Referencia_Pago = $reserva->id;

                $pago = Pago::guardar($pago);

                if($pago){
                    $idPago = $pago->id;

                    //Inicio envio correo certificado
                    $this->enviarMailCertificado(
                        $titular,
                        $tipoReserva,
                        $pais,
                        $ciudad,
                        $fecha,
                        $request->hora,
                        Lang::get('messages.certificadoTitulo'),
                        Lang::get('messages.certificadoSubtitulo'),
                        Lang::get('messages.certificadoAsunto')
                    );
                    //Fn envio correo

                    $titulares = Pago::where('TPG_Estado_Pago', 'Aprobada')
                        ->with('reserva')
                        ->with('reserva.titular')
                        ->with('reserva.tipo_reserva')
                        ->paginate(10);
                    
                    return $this->vista(Lang::get('messages.msgRegalo'), Lang::get('messages.appName'), Lang::get('messages.NotificationTypeSuccess'), view('administracion.titulares.table-data')->with('titulares', $titulares)->render());
                }//#end insert
            }
        }
    }
}
