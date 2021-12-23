<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class IdiomaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /*
         * If esta a true el valor de la variable status que tenemos en locale.php
         */
        if (config('locale.status')) {
            $clienteIp = str_replace(".", "", request()->getClientIp());
            if(!Cache::has('selectIdioma'.$clienteIp)) {
                Cache::put('selectIdioma'.$clienteIp, 0, Carbon::now()->addHours(5));
            }

            if(!session()->has('locale')){
                Session::put(['locale' => 'es']);
            }
            
            if (session()->has('locale') &&
                in_array(session()->get('locale'), array_keys(config('locale.languages')))) {

                /*
                 * Establece el locale de Laravel
                 */
                app()->setLocale(session()->get('locale'));

                setlocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);

                Carbon::setLocale(config('locale.languages')[session()->get('locale')][0]);


                if (config('locale.languages')[session()->get('locale')][2]) {
                    session(['lang-rtl' => true]);
                } else {
                    session()->forget('lang-rtl');
                }
            }
        }
        return $next($request);
    }
}
