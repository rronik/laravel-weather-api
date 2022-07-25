<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\City;
use App\Models\WeatherForecast;
use Tests\TestCase;


class CityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_has_weather_forecasts(): void
    {
        $city = City::factory()->create();
        WeatherForecast::factory()->for($city)->create();

        $this->assertTrue(condition: $city->weatherForecasts->first() instanceof WeatherForecast);
    }
}
