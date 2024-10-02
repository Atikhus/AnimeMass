<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    //aqui vamos a registrar los persimos para el admin
    public function boot(): void
    {
        //admin mode
        Gate::define('see-reports',function(User $user){
            return $user->role ==User::ROLE_ADMINISTRATOR;
        });

        //mangaka mode
        Gate::define('post-content',function(User  $user){
            return $user->role ==User::ROLE_MANGAKA;
        });
        
        //reader mode
        Gate::define('read-content',function(User  $user){
            return $user->role ==User::ROLE_READER;
        });
    }
}
