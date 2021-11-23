@extends('layout')

@section('title')
    Inicio
@endsection
@section('styles')
    
@endsection
@section('contenido')
	<!-- banner slider-->
	<div class="banner-silder">
		<div id="JiSlider" class="jislider">
			<div class="w3layouts-banner-top w3layouts-banner-top">
				<div class="bs-slider-overlay">
					<div class="container">
						<!-- Slide Text Layer -->
						<div class="w3l-slide-text">
							<h1 data-animation="animated zoomInRight">Elige Tu Cielo</h1>
							<h4 class="aos-init aos-animate" data-aos="fade-down">
								Selecciona la ubicación y la fecha de tu cielo y comprueba su disponibilidad.
							</h4>
							<a href="#services" class="button-style-blue" data-animation="animated fadeInDown" data-aos="fade-down">
								BUSCA TU CIELO
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //banner slider -->

	<!-- feedback -->
	<section class="news py-5" id="services">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="tittle text-center text-uppercase text-brand font-weight-bold mb-sm-5 mb-4">
				Tenemos tres opciones de cielos para ti
			</h3>
			<div class="owl-carousel owl-theme">
				<div class="item">
					<div class="feedback-info bg-white py-5 px-4">
						<h4 class="mb-2">
							LOCAL
						</h4>
						<p>
							Certificado de titularidad del cielo, de una ciudad y a una hora y día específico.&nbsp;
						</p>
						<div class="feedback-grids mt-4">
							<div class="feedback-img-info-blue">
								<h5>
									$10US
								</h5>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="feedback-info bg-white py-5 px-4">
						<h4 class="mb-2">
							NACIONAL
						</h4>
						<p>
							Certificado de titularidad del cielo de un país completo a una hora y día específico.
						</p>
						<div class="feedback-grids mt-4">
							<div class="feedback-img-info-blue">
								<h5>
									$50US
								</h5>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="feedback-info bg-white py-5 px-4">
						<h4 class="mb-2">
							GLOBAL
						</h4>
						<p>
							Certificado de titularidad del cielo del mundo entero, a una hora y día específico.
						</p>
						<div class="feedback-grids mt-4">
							<div class="feedback-img-info-blue">
								<h5>
									$500US
								</h5>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
			<a href="#booking" class="button-style-blue-center" data-animation="animated fadeInDown" data-aos="fade-down">
				BUSCA TU CIELO
			</a>
		</div>
	</section>
	<!-- //feedback -->

	<!-- //contact info -->
	<div class="container-fluid" id="booking"><br/><br/><br/>
		<h3 class="tittle text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
			Reserva Ahora!
		</h3>
		<div class="row">
			<div class="col-md-6 main_grid_contact">
				<div class="form">
					<h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
						Certificado Digital de Titularidad del Cielo
					</h4>
					<p>
						Este certicado es un ejemplo, el certificado es diseñado por un artista digital y es único, ya que tu mismo cielo nadie más lo podrá tener
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
						Reserva de Reserva
					</h4>
					<form action="{{route('seleccionar_reserva')}}" method="post">
						@csrf
						<div class="form-group">
							<label class="mb-2">Tipo de reserva</label>
							<select class="form-control" id="tipoId" name="tipoId" required>
								<option data-url="{{route('get_paises')}}" value="" selected>Seleccione una opción</option>
								@foreach ($tipoReservas as $tipo)
									<option value="{{$tipo->id}}" data-selectpais="{{$tipo->TTR_Select_Pais_Tipo_Reserva}}" data-selectciudad="{{$tipo->TTR_Select_Ciudad_Tipo_Reserva}}" data-url="{{route('get_paises')}}">{{$tipo->TTR_Nombre_Tipo_Reserva}}</option>
								@endforeach
							</select>
						</div>
						<div id="paises"></div>
						<div class="form-group">
							<label class="mb-2">Fecha</label>
							<input class="form-control" type="date" id="fecha" name="fecha" required>
						</div>
						<div class="input-group1">
							<input class="form-control" type="submit" value="Submit">
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
				Importante
			</h3>
			<div class="w3l-slide-text" style="padding-top: 1em;">
				<h3>
					<p class="aos-init aos-animate" data-aos="fade-down">
						El precio es por una (1) hora específica. Ejemplo: De las 3 a las 4 pm.
					</p>
				</h3>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					Por supuesto que puedes comprar más de una hora, solo debes tener en cuenta que su precio incrementara de acuerdo al valor de cada hora escogida (ciudad, país o Mundo)
				</p>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					El cielo que compraste te pertenece de manera VITALICIA, es decir que cada año podrás ver, disfrutar y fotografiar tu propio cielo.
				</p>
				<br/>
				<p class="aos-init aos-animate" data-aos="fade-down">
					El certificado es diseñado por un artista digital y es único, ya que tu mismo cielo nadie más lo podrá tener
				</p>
			</div>
		</div>
	</div>
	<!-- //middle section -->
@endsection