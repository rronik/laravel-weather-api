<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\City;
use App\Models\WeatherForecast;
use Tests\TestCase;
use function route;

class UpdateWeatherForecastControllerTest extends TestCase
{

    /**
     * @return void
     */
    public function test_it_can_update_a_forecast(): void
    {
        $city = City::first();

        $forecast = WeatherForecast::factory()->create();

        $this->assertDatabaseCount(table: 'weather_forecasts', count: 1);

        $this->putJson(
            uri: route(
                name: 'weather.forecast.update', parameters: ['weatherForecast' => $forecast->id]
            ),
            data: $this->weatherDataForRequest($city)
        );

        $this->assertDatabaseCount(table: 'weather_forecasts', count: 1);
        $this->assertDatabaseHas(table: 'weather_forecasts', data: $this->weatherDataForRequest($city));
    }

}
