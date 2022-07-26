<?php

declare(strict_types=1);

namespace Tests;

use App\Models\City;
use App\Services\OpenWeatherMap\OpenWeatherMapService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->clearCache();
        $this->artisan(command: 'db:seed');
    }

    /**
     * Clears Laravel Cache.
     * @return void
     */
    protected function clearCache(): void
    {
        $commands = ['clear-compiled', 'cache:clear', 'view:clear', 'config:clear', 'route:clear'];
        foreach ($commands as $command) {
            Artisan::call($command);
        }
    }


    /**
     * @param City|null $city
     * @param Carbon|null $date
     * @return array
     */
    public function weatherDataForFactory(?City $city = null, ?Carbon $date = null): array
    {
        return [
            "dt" => $date ?? 1659078000,
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
                "id" => $city ? $city->id : 1,
                "name" => $city->name ?? "New York",
                "lat" => $city->lat ?? 40.7128,
                "lon" => $city->lon ?? 74.006,
            ]
        ];
    }

    /**
     * @param City|null $city
     * @return array
     */
    public function weatherDataForRequest(?City $city = null): array
    {
        return [
            'city_id' => $city ? $city->id : 1,
            'date' => Carbon::now()->format(format: 'Y-m-d'),
            'day_temp' => 30,
            'min_temp' => 20,
            'max_temp' => 33,
            'feels_like' => 29,
            'pressure' => 1000,
            'humidity' => 30,
            'wind_speed' => 48,
        ];
    }

    /**
     * @return void
     */
    public function fakeApiCall(): void
    {
        $response = json_decode(
            json: file_get_contents(
                filename: base_path("tests/Response/response.json"),
            ),
            associative: true,
        );


        OpenWeatherMapService::fake([
            '*' => Http::response(body: $response, status: 200)
        ]);

    }
}
