<?php

namespace App\Actions;

use App\DataObjects\Services\WeatherForecastData;
use App\Models\WeatherForecast;

class SyncWeatherForecastWithDBAction
{
    /**
     * @param WeatherForecastData $weatherForecast
     * @return WeatherForecast|null
     */
    public function execute(WeatherForecastData $weatherForecast): ?WeatherForecast
    {
        return WeatherForecast::updateOrCreate(
            ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date->format('Y-m-d')],
            $weatherForecast->toArray()
        );
    }
}
