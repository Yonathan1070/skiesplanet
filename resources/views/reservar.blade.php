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
            El cielo del mundo puede ser tuyo, acontinuación te presentamos las horas disponibles para el día {{Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('d/M/Y')}}
        </h4>
        <h4 class="tittle text-center text-dark mb-sm-5 mb-4">
            Actualmente hay 24 horas del cielo de este día para ti. <br/>Cada hora u horas de este cielo, son exclusivas para quien las compre.
        </h4>
		<div class="row">
			<div class="col-md-4 main_grid_contact">
				<div class="form">
                    <form action="{{route('seleccionar_reserva')}}" method="post">
                        @csrf
                        <h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
                            Tu selección
                        </h4>
                        <div class="feedback-grids">
                            <ul class="w-hours list-unstyled">
                                <li class="d-flex justify-content-between">
                                    <b>Tipo:</b>
                                    <span>
                                        {{$tipoReserva->TTR_Nombre_Tipo_Reserva}}
                                    </span>
                                </li>
                                @if ($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais)
                                    <li class="d-flex justify-content-between"><b>Pais:</b> <span>{{$pais->TPA_Nombre_Pais_Espanol}}</span></li>
                                @endif
                                @if ($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $ciudad)
                                    <li class="d-flex justify-content-between"><b>Ciudad:</b> <span>{{$ciudad->TCI_Nombre_Ciudad}}</span></li>
                                @endif
                                <li class="d-flex justify-content-between">
                                    <b>Fecha:</b>
                                    <span>
                                        {{Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->format('d/M/Y')}}
                                    </span>
                                </li>
                                <div id="horas">

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
            <div class="col-md-4 main_grid_contact bg-light">
				<div class="form">
					<div class="feedback-grids">
						<div class="list-group" id="hora-0-12">
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="0-1">
                                0:00 - 1:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                            data-hora="1-2">
                                1:00 - 2:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="2-3">
                                2:00 - 3:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                            data-hora="3-4">
                                3:00 - 4:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="4-5">
                                4:00 - 5:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="5-6">
                                5:00 - 6:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="6-7">
                                6:00 - 7:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="7-8">
                                7:00 - 8:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="8-9">
                                8:00 - 9:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="9-10">
                                9:00 - 10:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="10-11">
                                10:00 - 11:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="11-12">
                                11:00 - 12:00  
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                        </div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<div class="col-md-4 main_grid_contact">
				<div class="form">
                    <div class="feedback-grids">
                        <div class="list-group" id="hora-12-24">
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="12-13">
                                12:00 - 13:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="13-14">
                                13:00 - 14:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="14-15">
                                14:00 - 15:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="15-16">
                                15:00 - 16:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="16-17">
                                16:00 - 17:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="17-18">
                                17:00 - 18:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="18-19">
                                18:00 - 19:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="19-20">
                                19:00 - 20:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="20-21">
                                20:00 - 21:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="21-22">
                                21:00 - 22:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="22-23">
                                22:00 - 23:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                            <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                                data-hora="23-24">
                                23:00 - 24:00
                                <span class="badge bg-success rounded-pill text-white">Disponible</span>
                            </a>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- //contact -->
@endsection