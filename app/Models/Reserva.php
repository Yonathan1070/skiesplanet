<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = "TBL_Reserva";
    protected $fillable = [
        'TRE_Tipo_Reserva_Id',
        'TRE_Pais_Id',
        'TRE_Ciudad_Id',
        'TRE_Fecha_Reserva',
        'TRE_Hora_Reserva',
        'TRE_Cliente_Id',
        'TRE_Titular_Id'
    ];
    protected $guarded = ['id'];

    public static function guardar(Reserva $reserva){
        $reserva->save();

        return $reserva;
    }

    public static function obtenerReserva($tipo, $fecha, $horas, $clienteId, $titularId, $pais = null, $ciudad = null){
        $reserva = Reserva::where('TRE_Tipo_Reserva_Id', $tipo)
            ->where('TRE_Fecha_Reserva', $fecha)
            ->where('TRE_Hora_Reserva', $horas)
            ->where('TRE_Cliente_Id', $clienteId)
            ->where('TRE_Titular_Id', $titularId);
        
        if($pais){
            $reserva->where('TRE_Pais_Id', $pais);

            if($ciudad){
                $reserva->where('TRE_Ciudad_Id', $ciudad);
            }
        }

        return $reserva->first();
    }
}
