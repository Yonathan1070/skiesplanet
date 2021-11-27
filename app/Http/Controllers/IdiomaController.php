<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    public function cambiar($idioma)
    {
        // Almacenar el lenguaje en la session
        session()->put('locale', $idioma);
        return redirect()->back();
    }
}
