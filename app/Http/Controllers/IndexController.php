<?php

namespace App\Http\Controllers;

use App\Models\TipoReserva;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Usuario;
use App\Models\Reserva;
use App\Models\Rol;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;

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

        // $pdf = PDF::loadView(
        //     'pdf.certificado', [
        //         'titular' => Usuario::first(),
        //         'tipoReserva' => TipoReserva::find(3),
        //         'pais' => Pais::first(),
        //         'ciudad' => Ciudad::first(),
        //         'fecha' => "02-02",
        //         'horas' => "0-1"
        //     ]
        // )->setPaper([0, 0, 1500,  1060.5]);

        // $fileName = 'CertificadoTitularidad-';
        // return $pdf->stream($fileName.'.pdf');

        // $titular = Usuario::find(1);
        // $tipoReserva = TipoReserva::find(1);
        // $pais = Pais::find(1);
        // $ciudad = Ciudad::find(1);
        // $fecha = "02-02";
        // $horas = explode(",", ",0-1,2-3");
        // return view('pdf.certificado', compact('titular', 'tipoReserva', 'pais', 'ciudad', 'fecha', 'horas'));
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
        $tipoReserva = ($request->tipoReserva != null || $request->tipoReserva != 0) ? TipoReserva::obtener($request->tipoReserva) : null;
        $paises = null;
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1) {
            $paises = Pais::obtener();
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
        $pais = Pais::obtener($request->pais);

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
        $tipoReserva = TipoReserva::obtener($request->tipoId);
        $fecha = $request->fecha;

        $horas0_12_old = [['0-1', '0'],['1-2', '0'],['2-3', '0'],['3-4', '0'],['4-5', '0'],['5-6', '0'],['6-7', '0'],['7-8', '0'],['8-9', '0'],['9-10', '0'],['10-11', '0'],['11-12', '0']];
        $horas12_24_old = [['12-13', '0'],['13-14', '0'],['14-15', '0'],['15-16', '0'],['16-17', '0'],['17-18', '0'],['18-19', '0'],['19-20', '0'],['20-21', '0'],['21-22', '0'],['22-23', '0'],['23-24', '0']];
        $horas0_12 = [];
        $horas12_24 = [];
        $cantidadOcupadas = 0;

        $pais = null; $ciudad = null;
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('paisId') && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $request->has('ciudadId')){
            $pais = Pais::obtener($request->paisId);
            $ciudad = Ciudad::obtener($request->ciudadId);
        }
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('paisId') && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 0){
            $pais = Pais::obtener($request->paisId);
        }

        //Verificar disponibilidad de horas
        $disponibilidad = Reserva::from('TBL_Reserva as r')
            ->join('TBL_Pago as p', 'r.id', 'p.TPG_Reserva_Id')
            ->where('p.TPG_Estado_Pago', 'Aprobada')
            ->where('r.TRE_Fecha_Reserva', Carbon::createFromFormat('Y-m-d', $fecha)->format('m-d'))
            ->where('r.TRE_Tipo_Reserva_Id', $tipoReserva->id);

        if($pais != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Pais_Id', $pais->id);
        }

        if($ciudad != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Ciudad_Id', $ciudad->id);
        }

        $disponibilidad = $disponibilidad->select('r.TRE_Hora_Reserva')
            ->get();

        foreach ($horas0_12_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '2';
                    $cantidadOcupadas++;
                }
            }
            array_push($horas0_12, $hora);
        }

        foreach ($horas12_24_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '2';
                    $cantidadOcupadas++;
                }
            }
            array_push($horas12_24, $hora);
        }
        $horas0_12_old = $horas0_12;
        $horas0_12 = [];
        $horas12_24_old = $horas12_24;
        $horas12_24 = [];

        $disponibilidad = Reserva::from('TBL_Reserva as r')
            ->join('TBL_Pago as p', 'r.id', 'p.TPG_Reserva_Id')
            ->where('p.TPG_Estado_Pago', 'Pendiente')
            ->where('r.TRE_Fecha_Reserva', Carbon::createFromFormat('Y-m-d', $fecha)->format('m-d'))
            ->where('r.TRE_Tipo_Reserva_Id', $tipoReserva->id);

        if($pais != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Pais_Id', $pais->id);
        }

        if($ciudad != null){
            $disponibilidad = $disponibilidad->where('r.TRE_Ciudad_Id', $ciudad->id);
        }

        $disponibilidad = $disponibilidad->select('r.TRE_Hora_Reserva')
            ->get();

        foreach ($horas0_12_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '1';
                    $cantidadOcupadas++;
                }
            }
            array_push($horas0_12, $hora);
        }

        foreach ($horas12_24_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '1';
                    $cantidadOcupadas++;
                }
            }
            array_push($horas12_24, $hora);
        }

        if($request->has('paisId')){
            $pais = Pais::obtener($request->paisId);
        }
        if($request->has('ciudadId')){
            $ciudad = Ciudad::obtener($request->ciudadId);
        }
        return view('reservar', compact('tipoReserva', 'fecha', 'pais', 'ciudad', 'horas0_12', 'horas12_24', 'cantidadOcupadas'));
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
        $tipoReserva = TipoReserva::obtener($request->tipoReserva);

        $horas0_12_old = [['0-1', '0'],['1-2', '0'],['2-3', '0'],['3-4', '0'],['4-5', '0'],['5-6', '0'],['6-7', '0'],['7-8', '0'],['8-9', '0'],['9-10', '0'],['10-11', '0'],['11-12', '0']];
        $horas12_24_old = [['12-13', '0'],['13-14', '0'],['14-15', '0'],['15-16', '0'],['16-17', '0'],['17-18', '0'],['18-19', '0'],['19-20', '0'],['20-21', '0'],['21-22', '0'],['22-23', '0'],['23-24', '0']];
        $horas0_12 = [];
        $horas12_24 = [];
        $horas0_12_new = [];
        $horas12_24_new = [];

        $pais = null; $ciudad = null;
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('paisId') && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $request->has('ciudadId')){
            $pais = Pais::obtener($request->paisId);
            $ciudad = Ciudad::obtener($request->ciudadId);
        }
        if($tipoReserva && $tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('paisId') && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 0){
            $pais = Pais::obtener($request->paisId);
        }
        
        //Verificar disponibilidad de horas
        $fecha = $request['fecha'];
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

        foreach ($horas0_12_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '2';
                }
            }
            array_push($horas0_12, $hora);
        }

        foreach ($horas12_24_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '2';
                }
            }
            array_push($horas12_24, $hora);
        }
        $horas0_12_old = $horas0_12;
        $horas0_12 = [];
        $horas12_24_old = $horas12_24;
        $horas12_24 = [];

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

        foreach ($horas0_12_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '1';
                }
            }
            array_push($horas0_12, $hora);
        }

        foreach ($horas12_24_old as $hora) {
            foreach ($disponibilidad as $horaP) {
                $horas_array = explode(",",$horaP->TRE_Hora_Reserva);
                if(in_array($hora[0], $horas_array)){
                    $hora[1] = '1';
                }
            }
            array_push($horas12_24, $hora);
        }

        $horas_array = explode(",",$request->horas_array);
        foreach ($horas0_12 as $hora) {
            if(in_array($hora[0], $horas_array)){
                $hora[1] = '4';
            }

            array_push($horas0_12_new, $hora);
        }
        $horas0_12 = $horas0_12_new;

        foreach ($horas12_24 as $hora) {
            if(in_array($hora[0], $horas_array)){
                $hora[1] = '4';
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
        $tipoReserva = TipoReserva::obtener($request['tipo-reserva']);
        $pais = null;
        if($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $request->has('paisId')){
            $pais = Pais::obtener($request->paisId);
        }

        $ciudad = null;
        if($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $request->has('ciudadId')){
            $ciudad = Ciudad::obtener($request->ciudadId);
        }

        $fecha = Carbon::createFromFormat('m-d', $request->fecha)->format('Y-m-d');
        $horas_array = explode(',', $request['horas-array']);
        $horas = $request['horas-array'];
        $total = $request['cantidad-horas'] * $tipoReserva->TTR_Costo_Tipo_Reserva;
        
        return view('finalizar', compact('tipoReserva', 'pais', 'ciudad', 'fecha', 'horas_array', 'horas' , 'total'));
    }

    public function finalizar(Request $request)
    {
        $rolCliente = Rol::where('TRO_Nombre_Rol', 'Cliente')->first();
        if($rolCliente == null){
            $rolCliente = Rol::guardar('Cliente');
        }

        $rolTitular = Rol::where('TRO_Nombre_Rol', 'Titular')->first();
        if($rolTitular == null){
            $rolTitular = Rol::guardar('Titular');
        }

        $cliente = Usuario::obtener($rolCliente->id, $request->correoCliente);
        if($cliente == null){
            $cliente = Usuario::guardar($request->nombreCliente.' '.$request->apellidoCliente, $request->correoCliente, $request->telefonoCliente, $rolCliente->id);
        }

        $titular = Usuario::obtener($rolTitular->id, $request->correoTitular);
        if($titular == null){
            $titular = Usuario::guardar($request->nombreTitular, $request->correoTitular, null, $rolTitular->id);
        }

        $reserva = new Reserva();
        $reserva->TRE_Tipo_Reserva_Id = $request['tipo-reserva'];
        $reserva->TRE_Pais_Id = $request['paisId'];
        $reserva->TRE_Ciudad_Id = $request['ciudadId'];
        $reserva->TRE_Fecha_Reserva = $request['fecha'];
        $reserva->TRE_Hora_Reserva = $request['horas-array'];
        $reserva->TRE_Cliente_Id = $cliente->id;
        $reserva->TRE_Titular_Id = $titular->id;

        $reserva = Reserva::guardar($reserva);

        return redirect()->route('inicio');
    }

    public function confirmacion(Request $request)
    {
        /*En esta página se reciben las variables enviadas desde ePayco hacia el servidor.
        Antes de realizar cualquier movimiento en base de datos se deben comprobar algunos valores
        Es muy importante comprobar la firma enviada desde ePayco
        Ingresar  el valor de p_cust_id_cliente lo encuentras en la configuración de tu cuenta ePayco
        Ingresar  el valor de p_key lo encuentras en la configuración de tu cuenta ePayco
        */

        $p_cust_id_cliente = '562742';
        $p_key             = '6f8b192fd60db2ad10d5603046504e2df28371aa';

        $x_ref_payco      = $request['x_ref_payco'];
        $x_transaction_id = $request['x_transaction_id'];
        $x_amount         = $request['x_amount'];
        $x_currency_code  = $request['x_currency_code'];
        $x_signature      = $request['x_signature'];


        $signature = hash('sha256', $p_cust_id_cliente . '^' . $p_key . '^' . $x_ref_payco . '^' . $x_transaction_id . '^' . $x_amount . '^' . $x_currency_code);

        $x_response     = $request['x_response'];
        $x_motivo       = $request['x_response_reason_text'];
        $x_id_invoice   = $request['x_id_invoice'];
        $x_autorizacion = $request['x_approval_code'];
        $x_description  = $request['x_description'];
        $x_transaction_date = $request['x_transaction_date'];
        //Datos del pedido
        if(
            !$request->has('x_extra1') ||
            !$request->has('x_extra2') ||
            !$request->has('x_extra3') ||
            !$request->has('x_extra4') ||
            !$request->has('x_extra5') ||
            !$request->has('x_extra6') ||
            !$request->has('x_extra7') ||
            !$request->has('x_extra8') ||
            !$request->has('x_extra9') ||
            !$request->has('x_extra10') ||
            !$request->has('x_extra11') ||
            !$request->has('x_extra12') ||
            !$request->has('x_extra13') ||
            !$request->has('x_extra14')
        ){
            return response()->json(['error' => 'Información incompleta', 'code' => '400']);
        }
            
        $x_extra1       = $request['x_extra1']; //tipo
        $x_extra2       = $request['x_extra2']; //fecha
        $x_extra3       = $request['x_extra3']; //horas
        $x_extra4       = $request['x_extra4']; //nombre cliente
        $x_extra5       = $request['x_extra5']; //apellido cliente
        $x_extra6       = $request['x_extra6']; //email cliente
        $x_extra7       = $request['x_extra7']; //telefono cliente
        $x_extra8       = $request['x_extra8']; //nombre titular
        $x_extra9       = $request['x_extra9']; //email titular
        $x_extra10      = $request['x_extra10']; //pais
        $x_extra11      = $request['x_extra11']; //ciudad
        $x_extra12      = $request['x_extra12']; //idioma
        $x_extra13      = $request['x_extra13']; //nombre pais
        $x_extra14      = $request['x_extra14']; //nombre ciudad
        $fecha          = date("Y-m-d");

        //Validamos la firma
        if ($x_signature == $signature) {
            /*Si la firma esta bien podemos verificar los estado de la transacción*/
            $x_cod_response = $request['x_cod_response'];

            //Buscar Rol cliente
            $rolCliente = Rol::where('TRO_Nombre_Rol', 'Cliente')->first();
            //Crear rol de cliente si no existe
            if(!$rolCliente){
                $rolCliente = Rol::guardar('Cliente');
            }
            //Buscar cliente por correo
            $cliente = Usuario::obtener($rolCliente->id, $x_extra6);
            //Si no existe el cliente lo creamos
            if(!$cliente){
                $cliente = Usuario::guardar($x_extra4.' '.$x_extra5, $x_extra6, $x_extra7, $rolCliente->id);
            }

            //Buscar Rol titular
            $rolTitular = Rol::where('TRO_Nombre_Rol', 'Titular')->first();
            //Crear rol de titular si no existe
            if(!$rolTitular){
                $rolTitular = Rol::guardar('Titular');
            }
            //Buscar titular por correo
            $titular = Usuario::obtener($rolTitular->id, $x_extra9);
            //Si no existe el titular lo creamos
            if(!$titular){
                $titular = Usuario::guardar($x_extra8, $x_extra9, null, $rolTitular->id);
            }

            switch ((int) $x_cod_response) {
                case 1:
                    # code transacción aceptada
                    if ($cliente && $titular) { 
                        $idCliente = $cliente->id;
                        $idTitular = $titular->id;

                        $tipoReserva = TipoReserva::obtener($x_extra1);
                        $pais = null;
                        $ciudad = null;
                        if($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1){
                            $pais = Pais::obtener($x_extra10);
                            if($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1){
                                $ciudad = Ciudad::obtener($x_extra11);
                            }
                        }

                        //Obtenemos la reserva
                        $reserva = Reserva::obtenerReserva($tipoReserva->id, $x_extra2, $x_extra3, $idCliente, $idTitular, (($pais) ? $pais->id : null), (($ciudad) ? $ciudad->id : null));
                        //Si no existe la reserva la creamos
                        if(!$reserva){
                            $reserva = new Reserva();
                            $reserva->TRE_Tipo_Reserva_Id = $tipoReserva->id;
                            $reserva->TRE_Pais_Id = (($pais) ? $pais->id : null);
                            $reserva->TRE_Ciudad_Id = (($ciudad) ? $ciudad->id : null);
                            $reserva->TRE_Fecha_Reserva = $x_extra2;
                            $reserva->TRE_Hora_Reserva = $x_extra3;
                            $reserva->TRE_Cliente_Id = $idCliente;
                            $reserva->TRE_Titular_Id = $idTitular;

                            $reserva = Reserva::guardar($reserva);
                        }

                        $pago = new Pago();
                        $pago->TPG_Reserva_Id = $reserva->id;
                        $pago->TPG_Total_Pago = $x_amount;
                        $pago->TPG_Fecha_Pago = Carbon::now()->format('Y-m-d');
                        $pago->TPG_Estado_Pago = 'Aprobada';
                        $pago->TPG_Idioma_Pago = $x_extra12;
                        $pago->TPG_Referencia_Pago = $x_id_invoice;

                        $pago = Pago::guardar($pago);

                        if($pago){
                            $idPago = $pago->id;

                            //Inicio envio correo pago
                            $this->enviarMailPago(
                                $tipoReserva,
                                $pais,
                                $ciudad,
                                $cliente,
                                $titular,
                                $x_extra2,
                                $x_extra3,
                                $x_amount,
                                Lang::get('messages.confirmacionTitulo'),
                                Lang::get('messages.confirmacionSubtitulo').$pago->id,
                                Lang::get('messages.confirmacionDescripcion'),
                                Lang::get('messages.transaccionAprobada'),
                                Lang::get('messages.confirmacionTitulo2'),
                            );
                            //Fn envio correo

                            //Inicio envio correo certificado
                            $this->enviarMailCertificado(
                                $titular,
                                $tipoReserva,
                                $pais,
                                $ciudad,
                                $x_extra2,
                                $x_extra3,
                                Lang::get('messages.certificadoTitulo'),
                                Lang::get('messages.certificadoSubtitulo'),
                                Lang::get('messages.certificadoAsunto')
                            );
                            //Fn envio correo
                        }//#end insert
                    }//#end
                    break;

                case 2:
                    # code transacción rechazada
                    if ($cliente && $titular) { 
                        $idCliente = $cliente->id;
                        $idTitular = $titular->id;

                        $tipoReserva = TipoReserva::obtener($x_extra1);
                        $pais = null;
                        $ciudad = null;
                        if($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1){
                            $pais = Pais::obtener($x_extra10);
                            if($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1){
                                $ciudad = Ciudad::obtener($x_extra11);
                            }
                        }

                        //Obtenemos la reserva
                        $reserva = Reserva::obtenerReserva($tipoReserva->id, $x_extra2, $x_extra3, $idCliente, $idTitular, (($pais) ? $pais->id : null), (($ciudad) ? $ciudad->id : null));
                        //Si no existe la reserva la creamos
                        if(!$reserva){
                            $reserva = new Reserva();
                            $reserva->TRE_Tipo_Reserva_Id = $tipoReserva->id;
                            $reserva->TRE_Pais_Id = (($pais) ? $pais->id : null);
                            $reserva->TRE_Ciudad_Id = (($ciudad) ? $ciudad->id : null);
                            $reserva->TRE_Fecha_Reserva = $x_extra2;
                            $reserva->TRE_Hora_Reserva = $x_extra3;
                            $reserva->TRE_Cliente_Id = $idCliente;
                            $reserva->TRE_Titular_Id = $idTitular;

                            $reserva = Reserva::guardar($reserva);
                        }

                        $pago = new Pago();
                        $pago->TPG_Reserva_Id = $reserva->id;
                        $pago->TPG_Total_Pago = $x_amount;
                        $pago->TPG_Fecha_Pago = Carbon::now()->format('Y-m-d');
                        $pago->TPG_Estado_Pago = 'Rechazada';
                        $pago->TPG_Idioma_Pago = $x_extra12;
                        $pago->TPG_Referencia_Pago = $x_id_invoice;

                        $pago = Pago::guardar($pago);

                        if($pago){
                            $idPago = $pago->id;

                            //Inicio envio correo
                            $this->enviarMailPago(
                                $tipoReserva,
                                $pais,
                                $ciudad,
                                $cliente,
                                $titular,
                                $x_extra2,
                                $x_extra3,
                                $x_amount,
                                Lang::get('messages.rechazadoTitulo'),
                                Lang::get('messages.rechazadoSubtitulo').$pago->id,
                                Lang::get('messages.confirmacionDescripcion'),
                                Lang::get('messages.transaccionRechazada'),
                            );
                            //Fn envio correo
                        }
                    }
                    //echo 'transacción rechazada';
                    break;

                case 3:
                    # code transacción pendiente
                    if ($cliente && $titular) { 
                        $idCliente = $cliente->id;
                        $idTitular = $titular->id;

                        $tipoReserva = TipoReserva::obtener($x_extra1);
                        $pais = null;
                        $ciudad = null;
                        if($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1){
                            $pais = Pais::obtener($x_extra10);
                            if($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1){
                                $ciudad = Ciudad::obtener($x_extra11);
                            }
                        }

                        //Obtenemos la reserva
                        $reserva = Reserva::obtenerReserva($tipoReserva->id, $x_extra2, $x_extra3, $idCliente, $idTitular, (($pais) ? $pais->id : null), (($ciudad) ? $ciudad->id : null));
                        //Si no existe la reserva la creamos
                        if(!$reserva){
                            $reserva = new Reserva();
                            $reserva->TRE_Tipo_Reserva_Id = $tipoReserva->id;
                            $reserva->TRE_Pais_Id = (($pais) ? $pais->id : null);
                            $reserva->TRE_Ciudad_Id = (($ciudad) ? $ciudad->id : null);
                            $reserva->TRE_Fecha_Reserva = $x_extra2;
                            $reserva->TRE_Hora_Reserva = $x_extra3;
                            $reserva->TRE_Cliente_Id = $idCliente;
                            $reserva->TRE_Titular_Id = $idTitular;

                            $reserva = Reserva::guardar($reserva);
                        }

                        $pago = new Pago();
                        $pago->TPG_Reserva_Id = $reserva->id;
                        $pago->TPG_Total_Pago = $x_amount;
                        $pago->TPG_Fecha_Pago = Carbon::now()->format('Y-m-d');
                        $pago->TPG_Estado_Pago = 'Pendiente';
                        $pago->TPG_Idioma_Pago = $x_extra12;
                        $pago->TPG_Referencia_Pago = $x_id_invoice;

                        $pago = Pago::guardar($pago);

                        if($pago){
                            $idPago = $pago->id;

                            //Inicio envio correo
                            $this->enviarMailPago(
                                $tipoReserva,
                                $pais,
                                $ciudad,
                                $cliente,
                                $titular,
                                $x_extra2,
                                $x_extra3,
                                $x_amount,
                                Lang::get('messages.confirmacionTitulo'),
                                Lang::get('messages.pendienteSubtitulo').$pago->id.Lang::get('messages.pendienteSubtitulo2'),
                                Lang::get('messages.confirmacionDescripcion'),
                                Lang::get('messages.transaccionPendiente')
                            );
                            //Fn envio correo
                        }
                    }
                    //echo 'transacción pendiente';
                    break;

                case 4:
                    # code transacción fallida
                    //echo 'transacción fallida';
                    break;
            }

        } else {
            die('Firma no valida');
        }
    }
    
    public function respuesta()
    {
        return view('respuesta');
    }

    private function enviarMailPago($tipoReserva, $pais, $ciudad, $cliente, $titular, $x_extra2, $x_extra3, $x_amount, $titulo, $subTitulo, $tituloContenido, $asunto, $tituloContenido2 = null)
    {
        try{
            Mail::send('correo.confirmacion', [
                'titulo' => $titulo,
                'nombreCliente' => $cliente->TUS_Nombre_Completo_Usuario,
                'subtitulo' => $subTitulo,
                'tituloContenido' => $tituloContenido,
                'cliente' => $cliente,
                'articulo' => 'Cielo',
                'tipo' => $tipoReserva,
                'pais' => $pais,
                'ciudad' => $ciudad,
                'fecha' => $x_extra2,
                'horas' => $x_extra3,
                'total' => $x_amount,
                'tituloContenido2' => $tituloContenido2,
                'titular' => $titular,
                'descripcion' => Lang::get('messages.confirmacionDescripcion'),
            ], function($message) use ($cliente, $asunto) {
                $message->from('admin@skiesplanet.com', 'SKIES PLANET');
                $message->to(
                    $cliente->TUS_Correo_Electronico_Usuario, 'SKIES PLANET'
                )->subject($asunto);
            });

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function enviarMailCertificado($titular, $tipoReserva, $pais, $ciudad, $x_extra2, $x_extra3, $titulo, $subTitulo, $asunto)
    {
        try{
            $horasSplit = explode(",", $x_extra3);
            $pdfs = [];
            foreach ($horasSplit as $hora) {
                if($hora != ""){
                    $pdf = PDF::loadView(
                        'pdf.certificado', [
                            'titular' => $titular,
                            'tipoReserva' => $tipoReserva,
                            'pais' => $pais,
                            'ciudad' => $ciudad,
                            'fecha' => $x_extra2,
                            'horas' => $hora
                        ]
                    )->setPaper([0, 0, 1500,  1060.5]);
            
                    $fileName = 'CertificadoTitularidad-'.$titular->TUS_Nombre_Completo_Usuario.'-'.$hora.'-'.(($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $ciudad) ? $ciudad->TCI_Nombre_Ciudad : (($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 0) ? $pais->TPA_Nombre_Pais_Espanol : Lang::get('messages.reservasDescripcion1_3'))).'-'.Carbon::now()->format('Y-m-d').'.pdf';

                    array_push($pdfs, [$pdf, $fileName]);
                }
            }

            Mail::send('correo.titularidad', [
                'titulo' => $titulo,
                'nombreCliente' => $titular->TUS_Nombre_Completo_Usuario,
                'subtitulo' => $subTitulo
            ], function($message) use ($titular, $asunto, $pdfs) {
                $message->from('admin@skiesplanet.com', 'SKIES PLANET');
                $message->to(
                    $titular->TUS_Correo_Electronico_Usuario, 'SKIES PLANET'
                )->subject($asunto);
                foreach ($pdfs as $pdf) {
                    $message->attachData($pdf[0]->output(), $pdf[1].'.pdf');
                }
            });

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
