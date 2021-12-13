@extends('layout')

@section('title')
    {{Lang::get('messages.inicio')}}
@endsection
@section('styles')
    
@endsection
@section('contenido')
	<!-- banner slider-->
	<div class="banner-silder">
		<div id="JiSlider" class="jislider">
			<div class="w3layouts-banner-top">
				<div class="bs-slider-overlay">
					<div class="container">
						<!-- Slide Text Layer -->
						<div class="w3l-slide-text">
							<h1 data-animation="animated zoomInRight">{{Lang::get('messages.inicioTituloSec1')}}</h1>
							<h4 class="aos-init aos-animate" data-aos="fade-down">
								{{Lang::get('messages.inicioDescripcionSec1')}}
							</h4>
							<a href="#services" class="button-style-blue scroll" data-animation="animated fadeInDown" data-aos="fade-down">
								{{Lang::get('messages.inicioBotonSec1')}}
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //banner slider -->

	<!-- feedback -->
	<div class="news py-5" id="services">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center text-uppercase text-brand font-weight-bold mb-sm-5 mb-4">
				{{Lang::get('messages.inicioTituloSec2')}}
			</h3>
			<div class="owl-carousel owl-theme">
				@foreach ($tipoReservas as $tipoReserva)
					<div class="item">
						<div class="feedback-info bg-white py-5 px-4">
							<h4 class="mb-2">
								<?php $campoNombre = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $tipoReserva->id, session()->get('locale'), 'TTR_Nombre_Tipo_Reserva'); ?>
								{{(!$campoNombre) ? $tipoReserva->TTR_Nombre_Tipo_Reserva : $campoNombre->TTD_Descripcion_Traduccion}}
							</h4>
							<p>
								<?php $campoDescripcion = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $tipoReserva->id, session()->get('locale'), 'TTR_Descripcion_Tipo_Reserva'); ?>
                				{{(!$campoDescripcion) ? $tipoReserva->TTR_Descripcion_Tipo_Reserva : $campoDescripcion->TTD_Descripcion_Traduccion}}&nbsp;
							</p>
							<div class="feedback-grids mt-4">
								<div class="feedback-img-info-blue">
									<h5>
										${{$tipoReserva->TTR_Costo_Tipo_Reserva}}US
									</h5>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<a href="#booking" class="button-style-blue-center scroll" data-animation="animated fadeInDown" data-aos="fade-down">
				{{Lang::get('messages.inicioBotonSec2')}}
			</a>
		</div>
	</div>
	<!-- //feedback -->

	<!-- //contact info -->
	<div class="container-fluid" id="booking"><br/><br/><br/>
		<h3 class="tittle text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
			{{Lang::get('messages.inicioTituloSec3')}}
		</h3>
		<div class="row">
			<div class="col-md-6 main_grid_contact">
				<div class="form">
					<h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
						{{Lang::get('messages.inicioTituloCard1Sec3')}}
					</h4>
					<p>
						{{Lang::get('messages.inicioDescripcionCard1Sec3')}}
					</p>
					<br/>
					<div class="feedback-grids">
						<img src="{{asset('assets/images/certificado.jpg')}}" class="img-fluid"alt="">
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<div class="col-md-6 main_grid_contact bg-light">
				<div class="form">
					<h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
						{{Lang::get('messages.inicioTituloCard2Sec3')}}
					</h4>
					<form action="{{route('seleccionar_reserva')}}" method="post">
						@csrf
						<div class="form-group">
							<label class="mb-2">{{Lang::get('messages.tipoReserva')}}</label>
							<select class="form-control" id="tipoId" name="tipoId" required>
								<option data-url="{{route('get_paises')}}" value="" selected>{{Lang::get('messages.seleccioneOpcion')}}</option>
								@foreach ($tipoReservas as $tipo)
									<?php $campoNombre = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $tipo->id, session()->get('locale'), 'TTR_Nombre_Tipo_Reserva'); ?>
									<option value="{{$tipo->id}}" data-selectpais="{{$tipo->TTR_Select_Pais_Tipo_Reserva}}" data-selectciudad="{{$tipo->TTR_Select_Ciudad_Tipo_Reserva}}" data-url="{{route('get_paises')}}">{{(!$campoNombre) ? $tipo->TTR_Nombre_Tipo_Reserva : $campoNombre->TTD_Descripcion_Traduccion}}</option>
								@endforeach
							</select>
						</div>
						<div id="paises"></div>
						<div class="form-group">
							<label class="mb-2">{{Lang::get('messages.fecha')}}</label>
							<input class="form-control" type="date" id="fecha" name="fecha" required>
						</div>
						<div class="input-group1">
							<input class="form-control" type="submit" value="{{Lang::get('messages.reservar')}}">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //contact -->

	<!-- middle section -->
	<div class="middle-w3l text-center py-5">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center text-uppercase text-blue font-weight-bold mb-sm-4 mb-3 mt-4">
				{{Lang::get('messages.inicioTituloSec4')}}
			</h3>
			<div class="w3l-slide-text" style="padding-top: 1em;">
				<h3>
					<p class="aos-init aos-animate" data-aos="fade-down">
						{{Lang::get('messages.inicioCard1Sec4')}}
					</p>
				</h3>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					{{Lang::get('messages.inicioCard2Sec4')}}
				</p>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					{{Lang::get('messages.inicioCard3Sec4')}}
				</p>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					{{Lang::get('messages.inicioCard4Sec4')}}
				</p>
			</div>
		</div>
	</div>
	<!-- //middle section -->
@endsection