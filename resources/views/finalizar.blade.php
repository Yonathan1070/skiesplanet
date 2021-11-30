@extends('layout')

@section('title')
    {{Lang::get('messages.finalizar')}}
@endsection
@section('styles')
    
@endsection
@section('contenido')
	<!-- //contact info -->
	<div class="container-fluid" id="booking"><br/><br/><br/><br/><br/>
		<h3 class="tittle text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
			{{Lang::get('messages.finalizarTitulo')}}
		</h3>
		<div class="col-md-12 main_grid_contact">
            <form action="{{route('finalizar')}}" method="post" id="form-general">
                <div class="row">
                    <div class="col-md-8" id="horas_lista">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form" id="accion-reservar">
                                    @csrf
                                    <h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
                                        {{Lang::get('messages.finalizarTituloCard1')}}
                                    </h4>
                                    <p>
                                        {{Lang::get('messages.finalizarDescripcionCard1')}}
                                    </p>
                                    <div class="feedback-grids">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{Lang::get('messages.nombre')}}</label>
                                                    <input class="form-control" type="text" id="nombreCliente" name="nombreCliente" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{Lang::get('messages.apellido')}}</label>
                                                    <input class="form-control" type="text" id="apellidoCliente" name="apellidoCliente" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{Lang::get('messages.correo')}}</label>
                                                    <input class="form-control" type="email" id="correoCliente" name="correoCliente" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{Lang::get('messages.telefono')}}</label>
                                                    <input class="form-control" type="text" id="telefonoCliente" name="telefonoCliente" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form" id="accion-reservar">
                                    @csrf
                                    <h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
                                        {{Lang::get('messages.finalizarTituloCard2')}}
                                    </h4>
                                    <p>
                                        {{Lang::get('messages.finalizarDescripcionCard2')}}
                                    </p>
                                    <div class="feedback-grids">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{Lang::get('messages.nombreTitular')}}</label>
                                                    <input class="form-control" type="text" id="nombreTitular" name="nombreTitular" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">{{Lang::get('messages.correoTitular')}}</label>
                                                    <input class="form-control" type="email" id="correoTitular" name="correoTitular" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" id="horas_lista">
                        <div class="row">
                            <div class="col-md-12 bg-light main_grid_contact">
                                <div class="form">
                                    <div class="feedback-grids">
                                        <ul class="w-hours list-unstyled">
                                            <li class="d-flex justify-content-between">
                                                <input type="hidden" name="tipo-reserva" id="tipo-reserva" value="{{$tipoReserva->id}}">
                                                <input type="hidden" id="nombre-tipo-reserva" value="{{$tipoReserva->TTR_Nombre_Tipo_Reserva}}">
                                                <b>{{Lang::get('messages.tipoReserva')}}:</b>
                                                <span>
                                                    {{Lang::get('messages.'.$tipoReserva->TTR_Nombre_Tipo_Reserva)}}
                                                </span>
                                            </li>
                                            @if ($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais)
                                                <li class="d-flex justify-content-between">
                                                    <input type="hidden" name="paisId" id="paisId" value="{{$pais->id}}">
                                                    <input type="hidden" id="nombrePais" value="{{$pais->TPA_Nombre_Pais_Espanol}}">
                                                    <b>{{Lang::get('messages.pais')}}:</b>
                                                    <span>{{$pais->TPA_Nombre_Pais_Espanol}}</span>
                                                </li>
                                            @endif
                                            @if ($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $ciudad)
                                                <li class="d-flex justify-content-between">
                                                    <input type="hidden" name="ciudadId" id="ciudadId" value="{{$ciudad->id}}">
                                                    <input type="hidden" id="nombreCiudad" value="{{$ciudad->TCI_Nombre_Ciudad}}">
                                                    <b>{{Lang::get('messages.ciudad')}}:</b>
                                                    <span>{{$ciudad->TCI_Nombre_Ciudad}}</span>
                                                </li>
                                            @endif
                                            <li class="d-flex justify-content-between">
                                                <input type="hidden" name="fecha" id="fecha" value="{{Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('m-d')}}">
                                                <b>{{Lang::get('messages.fecha')}}:</b>
                                                <span>
                                                    {{Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('d').' - '.Lang::get('messages.'.Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('F'))}}
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <input type="hidden" name="horas-array" id="horas-array" value="{{$horas}}">
                                                <b>{{Lang::get('messages.hora')}}:</b>
                                                <ul class="w-hours list-unstyled">
                                                    @foreach ($horas_array as $horas_seleccionadas)
                                                        @if ($horas_seleccionadas != "")
                                                            <li class="d-flex justify-content-between">
                                                                <?php $horas_2 = explode("-", $horas_seleccionadas) ?>
                                                                {{$horas_2[0].":00 - ".$horas_2[1].":00"}}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <input type="hidden" name="total" id="total" value="{{$total}}">
                                                <b>{{Lang::get('messages.total')}}:</b>
                                                <span>
                                                    {{$total." US"}}
                                                </span>
                                            </li>
                                        </ul>
                                        <div class="input-group1">
                                            <input type="hidden" id="url-confirmacion" value="{{route('confirmacion')}}">
                                            <input type="hidden" id="url-respuesta" value="{{route('respuesta')}}">
                                            <input class="form-control" type="button" onclick="epayco();" value="{{Lang::get('messages.finalizarTitulo')}}">
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			    </div>
            </form>
		</div>
	</div>
	<!-- //contact -->
    <input type="hidden" id="locale" value="{{Session::get('locale')}}">
@endsection
@section('scripts')
    <script type="text/javascript" src="https://checkout.epayco.co/checkout.js"></script>
    <script src="{{asset('assets/scripts/epayco.js')}}"></script>
    <script>
        $(document).ready(function(){
            hora_0_12();
            hora_12_24();
        });
    </script>
@endsection