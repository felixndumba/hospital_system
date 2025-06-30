<?php

namespace App\Providers;

use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class BackendRouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       $this->mapBackendRoutes();
    }
    protected function mapBackendRoutes()
   {
       Route::middleware('api')           // use API middleware group
            ->group(base_path('routes/api.php'));  // load routes from routes/backend.php
   }
}


