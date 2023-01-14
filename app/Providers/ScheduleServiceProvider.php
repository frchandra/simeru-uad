<?php

namespace App\Providers;

use App\Http\Repository\LecturerPlotRepository;
use App\Http\Repository\RoomTimeRepository;
use App\Http\Repository\ScheduleRepository;
use App\Http\Services\ScheduleServices;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(ScheduleRepository::class, function (){
            return new ScheduleRepository();
        });

        $this->app->singleton(ScheduleServices::class, function($app){
            return new ScheduleServices($app->make(ScheduleRepository::class),$app->make(RoomTimeRepository::class), $app->make(LecturerPlotRepository::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        //
    }
}
