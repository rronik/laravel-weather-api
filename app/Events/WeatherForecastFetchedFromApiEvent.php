<?php

declare(strict_types=1);

namespace App\Events;

use App\DataObjects\Services\WeatherForecastData;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WeatherForecastFetchedFromApiEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public WeatherForecastData $weatherForecastData)
    {
    }
}
