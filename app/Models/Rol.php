<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = "TBL_Rol";
    protected $fillable = [
        'TRO_Nombre_Rol'
    ];
    protected $guarded = ['id'];

    public static function guardar($nombreRol){
        $rol = new Rol();
        $rol->TRO_Nombre_Rol = $nombreRol;
        $rol->save();

        return $rol;
    }
}
