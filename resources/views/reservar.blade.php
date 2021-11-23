@extends('layout')

@section('title')
    Reservar
@endsection
@section('styles')
    
@endsection
@section('contenido')
	<!-- //contact info -->
	<div class="container-fluid" id="booking"><br/><br/><br/><br/><br/>
		<h3 class="tittle text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
			¡Felicidades!
		</h3>
        <h4 class="tittle text-center text-dark mb-sm-5 mb-4">
            El cielo {{($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $ciudad) ? 'de '.$ciudad->TCI_Nombre_Ciudad.' ('.$pais->TPA_Nombre_Pais_Espanol.')' : (($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 0) ? 'de '.$pais->TPA_Nombre_Pais_Espanol : 'del Mundo')}} puede ser tuyo, acontinuación te presentamos las horas disponibles para el día {{Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('d/M/Y')}}
        </h4>
        <h4 class="tittle text-center text-dark mb-sm-5 mb-4">
            Actualmente hay 24 horas del cielo de este día para ti. <br/>Cada hora u horas de este cielo, son exclusivas para quien las compre.
        </h4>
		<div class="row">
			<div class="col-md-4 main_grid_contact">
				<div class="form" id="accion-reservar">
                    <form action="{{route('reservar')}}" method="post" id="form-general">
                        @csrf
                        <h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
                            Tu selección
                        </h4>
                        <div class="feedback-grids">
                            <ul class="w-hours list-unstyled">
                                <li class="d-flex justify-content-between">
                                    <input type="hidden" name="tipo-reserva" id="tipo-reserva" value="{{$tipoReserva->id}}">
                                    <input type="hidden" name="precio-reserva" id="precio-reserva" value="{{$tipoReserva->TTR_Costo_Tipo_Reserva}}">
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
                                <div id="horas">
                                    <li class="d-flex justify-content-between"><b>Hora:</b>
                                        <ul class="w-hours list-unstyled">
                                            <input type="hidden" name="horas_seleccionadas" id="horas_seleccionadas" value="0">
                                            <span id="spn_error">Seleccione una hora</span>
                                        </ul>
                                    </li>
                                </div>
                            </ul>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="input-group1">
							<input class="form-control" type="submit" value="FINALIZAR COMPRA">
                            <a class="form-control btn" type="button" href="{{route('inicio')}}">CAMBIAR DE CIELO</a>
						</div>
                    </form>
				</div>
			</div>
            <div class="col-md-8" id="horas_lista">
                <div class="row">
                    <div class="col-md-6 bg-light main_grid_contact">
                        <div class="form">
                            <div class="feedback-grids">
                                <div class="list-group" id="hora-0-12">
                                    @foreach ($horas0_12 as $hora)
                                        <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                            data-hora="{{$hora[0]}}" data-selected="{{$hora[1]}}" data-successurl="{{route('actualizar_lista_horas')}}">
                                            <?php $hora_split = explode("-", $hora[0]); ?>
                                            {{$hora_split[0].':00'}} - {{$hora_split[1].':00'}}
                                            <span class="badge {{($hora[1] == 0) ? 'bg-success' : 'bg-danger'}} rounded-pill text-white">{{($hora[1] == 0) ? 'Disponible' : 'Ocupado'}}</span>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 main_grid_contact">
                        <div class="form">
                            <div class="feedback-grids">
                                <div class="list-group" id="hora-12-24">
                                    @foreach ($horas12_24 as $hora)
                                        <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                            data-hora="{{$hora[0]}}" data-selected="{{$hora[1]}}" data-successurl="{{route('actualizar_lista_horas')}}">
                                            <?php $hora_split = explode("-", $hora[0]); ?>
                                            {{$hora_split[0].':00'}} - {{$hora_split[1].':00'}}
                                            <span class="badge {{($hora[1] == 0) ? 'bg-success' : 'bg-danger'}} rounded-pill text-white">{{($hora[1] == 0) ? 'Disponible' : 'Ocupado'}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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