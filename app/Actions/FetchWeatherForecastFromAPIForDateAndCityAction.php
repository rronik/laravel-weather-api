<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataObjects\Services\WeatherForecastData;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Models\City;
use App\Services\OpenWeatherMap\OpenWeatherMapService;
use Carbon\Carbon;

class FetchWeatherForecastFromAPIForDateAndCityAction
{

    /**
     * @param OpenWeatherMapService $openWeatherMapService
     */
    public function __construct(protected OpenWeatherMapService $openWeatherMapService)
    {
    }

    /**
     * @param City $city
     * @param Carbon $date
     * @return WeatherForecastData
     * @throws ApiResponseException
     * @throws ForecastNotFoundException
     */
    public function execute(City $city, Carbon $date): WeatherForecastData
    {
        return $this->openWeatherMapService->dailyForecastByCityAndDate($city, $date);
    }
}
