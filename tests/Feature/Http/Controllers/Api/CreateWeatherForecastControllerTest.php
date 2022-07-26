<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\City;
use Tests\TestCase;
use function route;

class CreateWeatherForecastControllerTest extends TestCase
{

    /**
     * @return void
     */
    public function test_it_can_create_a_forecast(): void
    {
        $city = City::first();

        $this->assertDatabaseCount(table: 'weather_forecasts', count: 0);

        $this->postJson(
            uri: route(
                name: 'weather.forecast.create'
            ),
            data: $this->weatherDataForRequest($city)
        );

        $this->assertDatabaseCount(table: 'weather_forecasts', count: 1);
        $this->assertDatabaseHas(table: 'weather_forecasts', data: $this->weatherDataForRequest($city));
    }

}
