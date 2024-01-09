<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('layouts.admin', );
        Config::set('services.google.client_id', SiteSetting::where('name', 'google_client_id')->first()->value);
        Config::set('services.google.client_secret', SiteSetting::where('name', 'google_client_secret')->first()->value);
        /*config([
            'global' => SiteSetting::all([
            'name','value'
        ])
            ->keyBy('name')
            ->transform(function ($setting) {
                return $setting->value;
            })
            ->toArray()
        ]);*/
    }
}
