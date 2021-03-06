<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = "TBL_Ciudad";
    protected $fillable = [
        'TCI_Nombre_Ciudad',
        'TCI_Pais_Id'
    ];
    protected $guarded = ['id'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'TCI_Pais_Id');
    }

    public static function obtener($id = null)
    {
        if ($id == null) {
            return Ciudad::orderBy('TCI_Nombre_Ciudad', 'asc')->get();
        } else {
            return Ciudad::find($id);
        }
    }

    public static function getPorPais($id = null)
    {
        return Ciudad::where('TCI_Pais_Id', $id)->orderBy('TCI_Nombre_Ciudad', 'asc')->get();
    }
}
