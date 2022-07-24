<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Exceptions\ForecastNotFoundException;
use App\Models\City;
use Carbon\Carbon;
use Database\Seeders\CitySeeder;
use Tests\TestCase;

class WeatherForecastControllerTest extends TestCase
{

    /**
     * @return void
     */
    public function test_it_requires_a_date_when_a_forecast_is_made(): void
    {
        $response = $this->getJson(uri: route(name: 'weather.forecast'));

        $response->assertJsonValidationErrorFor(key: 'date');
    }


    /**
     * @return void
     */
    public function test_it_accepts_dates_no_more_than_a_week(): void
    {
        $response = $this->getJson(uri: route(name: 'weather.forecast', parameters: ['date' => Carbon::now()->addDays(8)->toString()]));

        $response->assertJsonValidationErrorFor(key: 'date');
    }


    /**
     * @return void
     */
    public function test_it_will_throw_an_exception_if_it_doesnt_find_forecast_in_db_or_api(): void
    {
        $this->seed(CitySeeder::class);

        $response = $this->getJson(uri: route(name: 'weather.forecast', parameters: ['date' => Carbon::yesterday()->toString()]));

        $response->assertStatus(status: 500)
            ->withException(ForecastNotFoundException::make());
    }


    /**
     * @return void
     */
    public function test_it_will_return_a_list_of_forecasts_for_all_the_cities_in_db_for_the_given_date(): void
    {
        $this->seed(CitySeeder::class);

        $response = $this->getJson(uri: route(name: 'weather.forecast', parameters: ['date' => Carbon::tomorrow()->toString()]));

        $response->assertStatus(status: 200)
            ->assertJsonCount(count: City::count(), key: 'data');
    }


}
