<?php

namespace App\Providers;

use App\Http\Repository\OfferedSubClassRepository;
use App\Http\Services\OfferedSubClassService;
use Illuminate\Support\ServiceProvider;

class OfferedSubClassServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(OfferedSubClassRepository::class, function (){
            return new OfferedSubClassRepository();
        });

        $this->app->singleton(OfferedSubClassService::class, function($app){
            return new OfferedSubClassService($app->make(OfferedSubClassRepository::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
