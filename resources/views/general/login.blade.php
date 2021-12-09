@extends('layout')

@section('title')
    Iniciar Sesión
@endsection
@section('styles')
    
@endsection
@section('contenido')

	<!-- //contact info -->
	<div class="container-fluid" id="booking"><br/><br/><br/>
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
						Iniciar Sesión
					</h4>
					<form action="{{route('login')}}" method="post">
						@csrf
						<div class="form-group was-validated">
							<label class="mb-2">Nombre de Usuario</label>
							<input class="form-control" type="email" id="TUS_Correo_Electronico_Usuario" name="TUS_Correo_Electronico_Usuario" required>
						</div>
						<div id="paises"></div>
						<div class="form-group was-validated">
							<label class="mb-2">Contraseña</label>
							<input class="form-control" type="password" id="password" name="password" required>
						</div>
						<div class="input-group1">
							<input class="form-control" type="submit" value="Entrar">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //contact -->
@endsection