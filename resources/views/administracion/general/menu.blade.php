<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="{{asset('assets/dashboard/theme-assets/images/backgrounds/02.jpg')}}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{route('administracion')}}">
                    <img class="brand-logo" alt="Chameleon admin logo" src="{{asset('assets/dashboard/theme-assets/images/logo/favicon.png')}}"/>
                    <h3 class="brand-text">{{Lang::get('messages.appName')}}</h3>
                </a>
            </li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{--  <li class="active">
                <a href="{{route('administracion')}}">
                    <i class="ft-home"></i>
                    <span class="menu-title" data-i18n="">{{Lang::get('messages.inicio')}}</span>
                </a>
            </li>  --}}
            <li class=" nav-item {{  request()->routeIs('titulares') ? 'active' : '' }} {{  request()->routeIs('administracion') ? 'active' : '' }}">
                <a href="{{route('titulares')}}">
                    <i class="ft-credit-card"></i>
                    <span class="menu-title" data-i18n="">{{Lang::get('messages.titulares')}}</span>
                </a>
            </li>
            <li class=" nav-item {{  request()->routeIs('planes') ? 'active' : '' }}">
                <a href="{{route('planes')}}">
                    <i class="ft-layers"></i>
                    <span class="menu-title" data-i18n="">{{Lang::get('messages.planes')}}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="navigation-background"></div>
</div>