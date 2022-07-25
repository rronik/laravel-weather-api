<?php

declare(strict_types=1);

namespace App\Actions;

use App\Collections\WeatherForecastCollection;
use App\Events\WeatherForecastFetchedFromApiEvent;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class WeatherForecastForDateAction
{

    /**
     * @param FetchWeatherForecastFromDBForDateAndCityAction $fetchWeatherForecastFromDBForDateAndCityAction
     * @param FetchWeatherForecastFromAPIForDateAndCityAction $fetchWeatherForecastFromAPIForDateAndCityAction
     */
    public function __construct(
        protected FetchWeatherForecastFromDBForDateAndCityAction  $fetchWeatherForecastFromDBForDateAndCityAction,
        protected FetchWeatherForecastFromAPIForDateAndCityAction $fetchWeatherForecastFromAPIForDateAndCityAction,
    )
    {
    }

    /**
     * @param Carbon $date
     * @return WeatherForecastCollection|null
     * @throws ForecastNotFoundException|ApiResponseException
     */
    public
    function execute(Carbon $date): ?WeatherForecastCollection
    {
        $cities = Cache::rememberForever('cities', function () {
            return City::all();
        });

        $forecastCollection = new WeatherForecastCollection();

        foreach ($cities as $city) {
            $dbForecast = $this->fetchWeatherForecastFromDBForDateAndCityAction->execute($city, $date);

            if ($dbForecast) {
                $forecastCollection->add($dbForecast);
                continue;
            }

            $apiForecast = $this->fetchWeatherForecastFromAPIForDateAndCityAction->execute($city, $date);

            WeatherForecastFetchedFromApiEvent::dispatch($apiForecast);

            $forecastCollection->add($apiForecast);
        }

        return $forecastCollection;
    }
}
