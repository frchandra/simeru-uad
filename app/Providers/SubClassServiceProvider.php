<?php

namespace App\Providers;

use App\Http\Repository\SubClassRepository;
use App\Http\Services\SubClassServices;
use Illuminate\Support\ServiceProvider;

class SubClassServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(SubClassRepository::class, function (){
            return new SubClassRepository();
        });

        $this->app->singleton(SubClassServices::class, function($app){
            return new SubClassServices($app->make(SubClassRepository::class));
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
