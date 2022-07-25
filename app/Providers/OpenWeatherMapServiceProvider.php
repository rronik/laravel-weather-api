<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\OpenWeatherMap\OpenWeatherMapService;
use Illuminate\Support\ServiceProvider;

class OpenWeatherMapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(OpenWeatherMapService::class, function ($app) {
            return new OpenWeatherMapService(
                uri: config(key: 'services.open-weather-map.uri'),
                token: config(key: 'services.open-weather-map.token'),
                timeout: intval(config(key: 'services.open-weather-map.timeout')),
                retryTimes: intval(config(key: 'services.open-weather-map.retry_times')),
                retryAfterMilliseconds: intval(config(key: 'services.open-weather-map.retry_milliseconds')),
            );
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
