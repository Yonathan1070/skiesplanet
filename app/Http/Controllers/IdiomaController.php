<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class IdiomaController extends Controller
{
    public function cambiar($idioma)
    {
        // Almacenar el lenguaje en la session
        session()->put('locale', $idioma);

        $clienteIp = str_replace(".", "", request()->getClientIp());
        if(Cache::has('selectIdioma'.$clienteIp) ) {
            Cache::forget('selectIdioma'.$clienteIp);
        }
        Cache::put('selectIdioma'.$clienteIp, 1, Carbon::now()->addHours(5));
        return redirect()->back();
    }
}
