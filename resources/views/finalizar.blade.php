@extends('layout')

@section('title')
    Finalizar Compra
@endsection
@section('styles')
    
@endsection
@section('contenido')
	<!-- //contact info -->
	<div class="container-fluid" id="booking"><br/><br/><br/><br/><br/>
		<h3 class="tittle text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
			Finalizar Compra
		</h3>
		<div class="col-md-12 main_grid_contact">
            <form action="{{route('reservar')}}" method="post" id="form-general">
                <div class="row">
                    <div class="col-md-8" id="horas_lista">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form" id="accion-reservar">
                                    @csrf
                                    <h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
                                        Información de facturación
                                    </h4>
                                    <p>
                                        Ingresa tu información de facturación para poder realizar tu reserva.
                                    </p>
                                    <div class="feedback-grids">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">Nombre</label>
                                                    <input class="form-control" type="text" id="nombreCliente" name="nombreCliente" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">Apellido</label>
                                                    <input class="form-control" type="text" id="apellidoCliente" name="apellidoCliente" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">Correo</label>
                                                    <input class="form-control" type="email" id="correoCliente" name="correoCliente" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">Telefono</label>
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
                                        Información de facturación
                                    </h4>
                                    <p>
                                        Ingresa los datos del titular del certificado, lo recibirá en su correo una vez se confirme el pago.
                                    </p>
                                    <div class="feedback-grids">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">Nombre completo del titular</label>
                                                    <input class="form-control" type="text" id="nombreTitular" name="nombreTitular" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">Correo del titular</label>
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
                                                <b>Tipo:</b>
                                                <span>
                                                    {{$tipoReserva->TTR_Nombre_Tipo_Reserva}}
                                                </span>
                                            </li>
                                            @if ($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais)
                                                <li class="d-flex justify-content-between">
                                                    <input type="hidden" name="paisId" id="paisId" value="{{$pais->id}}">
                                                    <b>Pais:</b>
                                                    <span>{{$pais->TPA_Nombre_Pais_Espanol}}</span>
                                                </li>
                                            @endif
                                            @if ($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $ciudad)
                                                <li class="d-flex justify-content-between">
                                                    <input type="hidden" name="ciudadId" id="ciudadId" value="{{$ciudad->id}}">
                                                    <b>Ciudad:</b>
                                                    <span>{{$ciudad->TCI_Nombre_Ciudad}}</span>
                                                </li>
                                            @endif
                                            <li class="d-flex justify-content-between">
                                                <input type="hidden" name="fecha" id="fecha" value="{{$fecha}}">
                                                <b>Fecha:</b>
                                                <span>
                                                    {{Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('d/M/Y')}}
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <b>Hora:</b>
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
                                                <b>Total:</b>
                                                <span>
                                                    {{$total." US"}}
                                                </span>
                                            </li>
                                        </ul>
                                        <div class="input-group1">
                                            <input class="form-control" type="submit" value="FINALIZAR COMPRA">
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
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            hora_0_12();
            hora_12_24();
        });
    </script>
@endsection