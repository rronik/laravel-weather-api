<?php

namespace App\Actions;

use App\Collections\WeatherForecastCollection;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Models\City;
use Carbon\Carbon;

class WeatherForecastForDateAction
{

    /**
     * @param FetchWeatherForecastFromDBForDateAndCityAction $fetchWeatherForecastFromDBForDateAndCityAction
     * @param FetchWeatherForecastFromAPIForDateAndCityAction $fetchWeatherForecastFromAPIForDateAndCityAction
     * @param SyncWeatherForecastWithDBAction $syncWeatherForecastWithDBAction
     */
    public function __construct(
        protected FetchWeatherForecastFromDBForDateAndCityAction  $fetchWeatherForecastFromDBForDateAndCityAction,
        protected FetchWeatherForecastFromAPIForDateAndCityAction $fetchWeatherForecastFromAPIForDateAndCityAction,
        protected SyncWeatherForecastWithDBAction                 $syncWeatherForecastWithDBAction
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
        $cities = City::all();

        $forecastCollection = new WeatherForecastCollection();

        foreach ($cities as $city) {
            $dbForecast = $this->fetchWeatherForecastFromDBForDateAndCityAction->execute($city, $date);
            if ($dbForecast) {
                $forecastCollection->add($dbForecast);
                continue;
            }
            $apiForecast = $this->fetchWeatherForecastFromAPIForDateAndCityAction->execute($city, $date);

            $syncedForecast = $this->syncWeatherForecastWithDBAction->execute($apiForecast);

            $forecastCollection->add($syncedForecast);
        }

        if ($forecastCollection->count() === 0) {
            throw ForecastNotFoundException::make();
        }

        return $forecastCollection;
    }
}
