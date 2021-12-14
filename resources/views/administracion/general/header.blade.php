<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ft-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">         
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flag-icon flag-icon-{{(session()->get('locale') == 'en') ? 'us' : 'es'}}"></i>
                            <span class="selected-language"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <div class="arrow_box">
                                @if (config('locale.status') && count(config('locale.languages')) > 1)
									@foreach (config('locale.languages') as $idioma)
                                        <a class="dropdown-item" href="{{route('cambiar_idioma', $idioma[0])}}">
                                            <i class="flag-icon flag-icon-{{($idioma[0] == 'en') ? 'us' : 'es'}}"></i> {{Lang::get('messages.'.$idioma[1])}}
                                        </a>
									@endforeach
								@endif
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="{{asset('assets/dashboard/theme-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <span class="avatar avatar-online">
                                        <img src="{{asset('assets/dashboard/theme-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar">
                                        <span class="user-name text-bold-700 ml-1">
                                            {{$usuario->TUS_Nombre_Completo_Usuario}}
                                        </span>
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>
                                {{--  <a class="dropdown-item" href="javascript:void(0);">
                                    <i class="ft-user"></i> {{Lang::get('messages.editarPerfil')}}
                                </a>
                                <div class="dropdown-divider"></div>  --}}
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ft-power"></i> {{Lang::get('messages.cerrarSesion')}}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>