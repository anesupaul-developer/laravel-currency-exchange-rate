<?php

namespace App\Providers;

use App\CurrencyConverterInterface;
use App\Services\FreeCurrencyApi;
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
        $this->app->bind(CurrencyConverterInterface::class, FreeCurrencyApi::class);
    }
}
