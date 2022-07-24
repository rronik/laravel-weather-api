<?php

namespace App\Providers;

use App\Events\WeatherForecastFetchedFromApiEvent;
use App\Listeners\SyncWeatherForecastWithDBListener;
use App\Models\City;
use App\Observers\CityObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        WeatherForecastFetchedFromApiEvent::class => [
            SyncWeatherForecastWithDBListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        City::observe(CityObserver::class);
    }
}
