<?php

namespace App\Providers;

use App\Http\Repository\RoomTimeRepository;
use App\Http\Services\RoomTimeServices;
use Illuminate\Support\ServiceProvider;

class RoomTimeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(RoomTimeRepository::class, function (){
            return new RoomTimeRepository();
        });

        $this->app->singleton(RoomTimeServices::class, function($app){
            return new RoomTimeServices($app->make(RoomTimeRepository::class));
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
