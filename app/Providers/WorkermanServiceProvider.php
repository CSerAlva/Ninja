<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WorkermanServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('workerman', function ($app) {
            return new \Workerman\Worker();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Alex
//        if (config('app.debug')) {
//            DB::listen(function ($query) {
//                \Log::info($query->sql, $query->bindings, $query->time);
//            });
//        }
    }
}
