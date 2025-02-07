<?php

namespace App\Providers;

<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Vite;
>>>>>>> 96658b47bb8627f52fbbf805dfd9c6069f9312d0
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
<<<<<<< HEAD
        //
=======
        Vite::prefetch(concurrency: 3);
>>>>>>> 96658b47bb8627f52fbbf805dfd9c6069f9312d0
    }
}
