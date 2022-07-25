<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WeatherForecast;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeatherForecastResource;
use App\Models\WeatherForecast;

class DeleteWeatherForecastController extends Controller
{
    /**
     * @param WeatherForecast $weatherForecast
     * @return WeatherForecastResource
     */
    public function __invoke(WeatherForecast $weatherForecast): WeatherForecastResource
    {
        $weatherForecast->delete();

        return WeatherForecastResource::make($weatherForecast);
    }
}
