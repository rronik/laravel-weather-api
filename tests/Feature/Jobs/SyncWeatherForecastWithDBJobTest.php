<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Jobs;

use App\Factories\Services\WeatherForecastDataFactory;
use App\Jobs\SyncWeatherForecastWithDBJob;
use Tests\TestCase;

class SyncWeatherForecastWithDBJobTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_sync_weather_forecast_with_DB()
    {
        $weatherForecast = WeatherForecastDataFactory::make(
            [
                "dt" => 1659078000,
                "temp" => [
                    "day" => 13.12,
                    "min" => 2.03,
                    "max" => 13.68
                ],
                "feels_like" => [
                    "day" => 11.27,
                ],
                "pressure" => 1009,
                "humidity" => 30,
                "wind_speed" => 5.05,

                "city" => [
                    "id" => 1,
                    "name" => "New York",
                    "lat" => 40.7128,
                    "lon" => 74.006,
                ]
            ]
        );

        $this->assertDatabaseMissing(table: 'weather_forecasts', data: ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date]);

        (new SyncWeatherForecastWithDBJob($weatherForecast))->handle();

        $this->assertDatabaseHas(table: 'weather_forecasts', data: ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date]);

    }
}
