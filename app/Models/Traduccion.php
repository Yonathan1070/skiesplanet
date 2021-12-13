<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traduccion extends Model
{
    use HasFactory;

    protected $table = "TBL_Traduccion";
    protected $fillable = [
        'TTD_Tabla_Traduccion',
        'TTD_Campo_Traduccion',
        'TTD_Id_Traduccion',
        'TTD_Idioma_Traduccion',
        'TTD_Descripcion_Traduccion'
    ];
    protected $guarded = ['id'];

    public static function obtenerCampo($tabla, $registro, $idioma, $campo){
        return Traduccion::where('TTD_Tabla_Traduccion', $tabla)
            ->where('TTD_Id_Traduccion', $registro)
            ->where('TTD_Idioma_Traduccion', $idioma)
            ->where('TTD_Campo_Traduccion', $campo)
            ->first();
    }
}
