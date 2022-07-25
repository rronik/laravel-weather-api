<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WeatherForecast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateWeatherForecastRequest;
use App\Http\Resources\WeatherForecastResource;
use App\Models\WeatherForecast;

class UpdateWeatherForecastController extends Controller
{
    /**
     * @param WeatherForecast $weatherForecast
     * @param UpdateWeatherForecastRequest $request
     * @return WeatherForecastResource
     */
    public function __invoke(WeatherForecast $weatherForecast, UpdateWeatherForecastRequest $request): WeatherForecastResource
    {
        $weatherForecast->update($request->validated());

        return WeatherForecastResource::make($weatherForecast);
    }
}
