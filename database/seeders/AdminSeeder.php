<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use App\Models\Usuario;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #Agregar Rol Administrador
        $rol = Rol::where('TRO_Nombre_Rol', 'Administradorr')->first();
        if(!$rol){
            $rol = new Rol();
            $rol->TRO_Nombre_Rol = 'Administradorr';
            $rol->save();
        }

        $usuario = Usuario::where('TUS_Nombre_Completo_Usuario', 'Administrador')
            ->where('TUS_Correo_Electronico_Usuario', 'infoskiesplanet@gmail.com')
            ->first();
        
        if(!$usuario){
            $usuario = new Usuario();
            $usuario->TUS_Nombre_Completo_Usuario = 'Admin Skies Planett';
            $usuario->TUS_Correo_Electronico_Usuario = 'infoskiesplanett@gmail.com';
            $usuario->TUS_Rol_Id = $rol->id;
            $usuario->password = bcrypt('Ski3sPl@n3t*');
            $usuario->save();
        }
    }
}
