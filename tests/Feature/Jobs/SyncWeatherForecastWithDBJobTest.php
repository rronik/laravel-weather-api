<?php

declare(strict_types=1);

namespace Tests\Feature\Jobs;

use App\Factories\Services\WeatherForecastDataFactory;
use App\Jobs\SyncWeatherForecastWithDBJob;
use App\Models\City;
use Tests\TestCase;

class SyncWeatherForecastWithDBJobTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_sync_weather_forecast_with_db(): void
    {
        $city = City::first();

        $weatherForecast = WeatherForecastDataFactory::make(
            $this->weatherDataForFactory(city: $city)
        );

        $this->assertDatabaseMissing(table: 'weather_forecasts', data: ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date->format(format: 'Y-m-d')]);

        (new SyncWeatherForecastWithDBJob(weatherForecastData: $weatherForecast))->handle();

        $this->assertDatabaseHas(table: 'weather_forecasts', data: ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date->format(format: 'Y-m-d')]);

    }
}
