<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoReserva extends Model
{
    use HasFactory;

    protected $table = "TBL_Tipo_Reserva";
    protected $fillable = [
        'TTR_Nombre_Tipo_Reserva',
        'TTR_Costo_Tipo_Reserva',
        'TTR_Select_Pais_Tipo_Reserva',
        'TTR_Select_Ciudad_Tipo_Reserva'
    ];
    protected $guarded = ['id'];

    public static function get($id = null)
    {
        if ($id == null) {
            return TipoReserva::all();
        } else {
            return TipoReserva::find($id);
        }
    }
}
