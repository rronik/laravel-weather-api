<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WeatherForecast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateWeatherForecastRequest;
use App\Http\Resources\WeatherForecastResource;
use App\Models\WeatherForecast;

class CreateWeatherForecastController extends Controller
{
    /**
     * @param CreateWeatherForecastRequest $request
     * @return WeatherForecastResource
     */
    public function __invoke(CreateWeatherForecastRequest $request): WeatherForecastResource
    {
        $weatherForecast = WeatherForecast::create($request->validated());

        return WeatherForecastResource::make($weatherForecast);
    }
}
