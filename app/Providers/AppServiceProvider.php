<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        Http::macro('backOffice', function () {
            return Http::withHeaders([
                'Connection' => 'keep-alive'
            ])->baseUrl(config('api.back_office_api_base_url'));
        });
    }
}
