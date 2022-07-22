<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\City;
use App\Models\WeatherForecast;
use Carbon\Carbon;

class FetchWeatherForecastFromDBForDateAndCityAction
{
    /**
     * @param City $city
     * @param Carbon $date
     * @return WeatherForecast|null
     */
    public function execute(City $city, Carbon $date): ?WeatherForecast
    {
        return WeatherForecast::where('city_id', $city->id)->where('date', $date)->first();
    }
}
