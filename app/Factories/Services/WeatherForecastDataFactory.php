<?php

declare(strict_types=1);

namespace App\Factories\Services;

use App\DataObjects\Services\WeatherForecastData;
use App\Infrasctructure\Contracts\Factories\FactoryContract;
use Carbon\Carbon;

class WeatherForecastDataFactory implements FactoryContract
{
    /**
     * @param array $attributes
     * @return WeatherForecastData
     */
    public static function make(array $attributes): WeatherForecastData
    {
        return new WeatherForecastData(
            city: CityDataFactory::make($attributes['city']),
            city_id: $attributes['city']['id'],
            date: Carbon::parse($attributes['dt']),
            day_temp: $attributes['temp']['day'],
            min_temp: $attributes['temp']['min'],
            max_temp: $attributes['temp']['max'],
            feels_like: $attributes['feels_like']['day'],
            pressure: $attributes['pressure'],
            humidity: $attributes['humidity'],
            wind_speed: $attributes['wind_speed'],
        );
    }
}
