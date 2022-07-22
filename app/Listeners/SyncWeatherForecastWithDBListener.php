<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\WeatherForecastFetchedFromApiEvent;
use App\Jobs\SyncWeatherForecastWithDBJob;

class SyncWeatherForecastWithDBListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param WeatherForecastFetchedFromApiEvent $event
     * @return void
     */
    public function handle(WeatherForecastFetchedFromApiEvent $event)
    {
        SyncWeatherForecastWithDBJob::dispatch($event->weatherForecastData);
    }
}
