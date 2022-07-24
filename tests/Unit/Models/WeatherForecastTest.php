<?php

namespace Tests\Unit\Models;

use App\Models\City;
use App\Models\WeatherForecast;
use Tests\TestCase;

class WeatherForecastTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_belongs_to_a_city()
    {
        $city = City::factory()->create();
        $weatherForecast = WeatherForecast::factory()->for($city)->create();

        $this->assertTrue(condition: $weatherForecast->city instanceof City);
        $this->assertTrue(condition: $weatherForecast->city->id == $city->id);
    }
}
