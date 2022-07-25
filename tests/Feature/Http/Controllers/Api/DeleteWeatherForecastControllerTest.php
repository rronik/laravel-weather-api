<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\WeatherForecast;
use Tests\TestCase;
use function route;

class DeleteWeatherForecastControllerTest extends TestCase
{

    /**
     * @return void
     */
    public function test_it_can_delete_a_forecast(): void
    {
        $forecast = WeatherForecast::factory()->create();

        $this->assertDatabaseCount(table: 'weather_forecasts', count: 1);

        $this->deleteJson(uri: route(name: 'weather.forecast.delete', parameters: ['weatherForecast' => $forecast->id]));

        $this->assertDatabaseCount(table: 'weather_forecasts', count: 0);
    }

}
