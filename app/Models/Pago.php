<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = "TBL_Pago";

    protected $fillable = [
        'TPG_Reserva_Id',
        'TPG_Total_Pago',
        'TPG_Cupon_Descuento_Pago',
        'TPG_Total_Descuento_Pago',
        'TPG_Fecha_Pago',
        'TPG_Estado_Pago',
        'TPG_Idioma_Pago',
        'TPG_Referencia_Pago'
    ];

    protected $guarded = ['id'];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'TPG_Reserva_Id');
    }

    public static function guardar(Pago $pago){
        $pago->save();

        return $pago;
    }

    public static function obtener($id = null){
        if($id == null){
            return Pago::all();
        }else{
            return Pago::find($id);
        }
    }
}
