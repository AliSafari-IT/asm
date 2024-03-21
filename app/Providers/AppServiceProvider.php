<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Define Component Alias (If Not Already Done): This step is necessary if you're using a custom tag like <generalinfoMain> instead of the standard <x-component-name> syntax. 
        Blade::component('general_info.mainbody', 'generalinfoMain');
    }
}
