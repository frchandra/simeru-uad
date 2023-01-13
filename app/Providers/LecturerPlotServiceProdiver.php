<?php

namespace App\Providers;

use App\Http\Repository\LecturerPlotRepository;
use App\Http\Repository\SubClassRepository;
use App\Http\Services\LecturerPlotServices;
use Illuminate\Support\ServiceProvider;

class LecturerPlotServiceProdiver extends ServiceProvider{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(LecturerPlotRepository::class, function (){
            return new LecturerPlotRepository();
        });

        $this->app->singleton(LecturerPlotServices::class, function($app){
            return new LecturerPlotServices($app->make(LecturerPlotRepository::class), $app->make(SubClassRepository::class));
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
