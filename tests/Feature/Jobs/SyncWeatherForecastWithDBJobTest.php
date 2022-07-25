<?php

declare(strict_types=1);

namespace Tests\Feature\Jobs;

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
    public function test_it_can_sync_weather_forecast_with_DB(): void
    {
        $weatherForecast = WeatherForecastDataFactory::make(
            $this->weatherDataForFactory()
        );

        $this->assertDatabaseMissing(table: 'weather_forecasts', data: ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date]);

        (new SyncWeatherForecastWithDBJob($weatherForecast))->handle();

        $this->assertDatabaseHas(table: 'weather_forecasts', data: ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date]);

    }
}
