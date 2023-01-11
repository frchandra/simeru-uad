<?php

namespace App\Providers;

use App\Http\Repository\RoomRepository;
use App\Http\Services\RoomServices;
use Illuminate\Support\ServiceProvider;

class RoomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(RoomRepository::class, function (){
            return new RoomRepository();
        });

        $this->app->singleton(RoomServices::class, function($app){
            return new RoomServices($app->make(RoomRepository::class));
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
