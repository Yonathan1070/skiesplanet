<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::loginView( fn () => view('general.login'));
        
        Fortify::authenticateUsing(function (Request $request) {
            $user = Usuario::from('TBL_Usuario as u')
                //->join('TBL_Rol_Usuario as ru', 'ru.USR_RL_Usuario_Id', 'u.id')
                ->where('u.TUS_Correo_Electronico_Usuario', $request->TUS_Correo_Electronico_Usuario)
                ->select('u.*')
                ->first();
                
            if ($user && Hash::check($request->password, $user->password)) {
                //if($user->USR_RL_Estado){
                    //$roles = Usuarios::find($user->id)->roles()->get();
                    //if($roles->isNotEmpty()){
                        $user->setSession($user->TUS_Rol_Id);
                        return $user;
                    //}
                //}
                return false;
            }
            return false;
        });
    }
}
