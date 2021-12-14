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

    public function tipo_reserva()
    {
        return $this->belongsTo(TipoReserva::class, 'TRE_Tipo_Reserva_Id');
    }

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'TRE_Cliente_Id');
    }

    public function titular()
    {
        return $this->belongsTo(Usuario::class, 'TRE_Titular_Id');
    }

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

        return $reserva->orderBy('created_at', 'desc')->first();
    }

    public static function obtener($id = null){
        if($id){
            return Reserva::find($id);
        }else{
            return Reserva::all();
        }
    }
}
