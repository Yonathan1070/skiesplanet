<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "TBL_Usuario";
    protected $fillable = [
        'TUS_Nombre_Completo_Usuario',
        'TUS_Correo_Electronico_Usuario',
        'TUS_Telefono_Usuario',
        'TUS_Rol_Id'
    ];
    protected $guarded = ['id'];

    public static function obtener($rolId, $correo = null){
        if($correo != null){
            return Usuario::where('TUS_Rol_Id', $rolId)
                ->where('TUS_Correo_Electronico_Usuario', $correo)
                ->first();
        }
        return Usuario::where('TUS_Rol_Id', $rolId)->get();
    }

    public static function guardar($nombreCompletoUsuario, $correoElectronicoUsuario, $telefonoUsuario = null, $rolId){
        $usuario = new Usuario();
        $usuario->TUS_Nombre_Completo_Usuario = $nombreCompletoUsuario;
        $usuario->TUS_Correo_Electronico_Usuario = $correoElectronicoUsuario;
        $usuario->TUS_Telefono_Usuario = $telefonoUsuario;
        $usuario->TUS_Rol_Id = $rolId;

        $usuario->save();

        return $usuario;
    }

    public function setSession($rol)
    {
        Session::put([
            'Usuario_Id' => $this->id,
            'rol' => $rol
        ]);
    }
}
