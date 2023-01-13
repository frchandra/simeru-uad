<?php

namespace App\Providers;

use App\Http\Repository\LecturerRepository;
use App\Http\Repository\SubClassRepository;
use App\Http\Services\LecturerServices;
use Illuminate\Support\ServiceProvider;

class LecturerServiceProvider extends ServiceProvider{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(LecturerRepository::class, function (){
            return new LecturerRepository();
        });

        $this->app->singleton(LecturerServices::class, function($app){
            return new LecturerServices($app->make(LecturerRepository::class));
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
