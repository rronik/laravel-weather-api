<?php

declare(strict_types=1);

namespace Tests\Feature\Console\Commands;

use Database\Seeders\CitySeeder;
use Tests\TestCase;

class SyncWeatherForecastWithDBCommandTest extends TestCase
{

    /**
     * @return void
     */
    public function test_it_can_sync_data_from_api_to_db()
    {
        $this->seed(class: CitySeeder::class);

        $this->assertDatabaseCount(table: 'weather_forecasts', count: 0);
        $this->artisan(command: 'open-weather-map:sync');
        $this->assertDatabaseCount(table: 'weather_forecasts', count: 5);
    }


}
