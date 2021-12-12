<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = "TBL_Pais";
    protected $fillable = [
        'TPA_Nombre_Pais_Espanol',
        'TPA_Nombre_Pais_Ingles',
        'TPA_ISO_3',
        'TPA_ISO_2'
    ];
    protected $guarded = ['id'];

    public static function obtener($id = null)
    {
        if ($id == null) {
            return Pais::orderBy('TPA_Nombre_Pais_Espanol', 'asc')->get();
        } else {
            return Pais::find($id);
        }
    }
}
