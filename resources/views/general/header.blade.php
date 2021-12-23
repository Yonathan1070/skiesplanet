<!-- header -->
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<a class="navbar-brand logo" href="https://www.skiesplanet.com">
			{{Lang::get('messages.appName')}}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-toggle" aria-controls="navbarNavAltMarkup"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse navbar-toggle idioma" id="navbarNavAltMarkup">
			<div class="top-info text-lg-right text-center mt-lg-0 mt-3">
				<ul class="list-unstyled">
					@if (Request::route()->methods[0] != 'POST')
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle request text-uppercase font-weight-bold text-white" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								{{Lang::get('messages.idioma')}}
							</a>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								@if (config('locale.status') && count(config('locale.languages')) > 1)
									@foreach (config('locale.languages') as $idioma)
										<a class="dropdown-item" href="{{route('cambiar_idioma', $idioma[0])}}"><i class="flag-icon flag-icon-{{$idioma[3]}}"></i> {{Lang::get('messages.'.$idioma[1])}}</a>
									@endforeach
								@endif
							</div>
						</li>
					@endif
					<li>
						<a class="nav-link dropdown-toggle request text-uppercase font-weight-bold text-white" href="{{route('login')}}" id="navbarDropdown" role="button">
							{{Lang::get('messages.entrar')}}
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<!-- //header -->