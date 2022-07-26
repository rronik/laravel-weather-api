<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\DataObjects\Services\WeatherForecastData;
use App\Models\City;
use App\Services\OpenWeatherMap\OpenWeatherMapService;
use Carbon\Carbon;
use Tests\TestCase;

class OpenWeatherMapServiceTest extends TestCase
{

    /**
     * @return void
     */
    public function test_it_can_set_the_timeout()
    {
        $this->assertSame(expected: intval(config(key: 'services.open-weather-map.timeout')), actual: app(abstract: OpenWeatherMapService::class)->timeout);

        app(abstract: OpenWeatherMapService::class)->setTimeout(20);

        $this->assertSame(expected: 20, actual: app(abstract: OpenWeatherMapService::class)->timeout);
    }

    /**
     * @return void
     */
    public function test_it_can_set_the_retry_times()
    {
        $this->assertSame(expected: intval(config(key: 'services.open-weather-map.retry_times')), actual: app(abstract: OpenWeatherMapService::class)->retryTimes);

        app(abstract: OpenWeatherMapService::class)->setRetryTimes(4);

        $this->assertSame(expected: 4, actual: app(abstract: OpenWeatherMapService::class)->retryTimes);
    }

    /**
     * @return void
     */
    public function test_it_can_set_the_milliseconds_between_retries()
    {
        $this->assertSame(expected: intval(config(key: 'services.open-weather-map.retry_milliseconds')), actual: app(abstract: OpenWeatherMapService::class)->retryAfterMilliseconds);

        app(abstract: OpenWeatherMapService::class)->setRetryAfterMilliseconds(1500);

        $this->assertSame(expected: 1500, actual: app(abstract: OpenWeatherMapService::class)->retryAfterMilliseconds);

    }

    /**
     * @return void
     */
    public function test_it_can_return_the_forecast_for_a_specified_city_and_date()
    {
        $date = Carbon::parse('2022-07-26')->subHour();

        $this->fakeApiCall();

        $this->assertInstanceOf(
            expected: WeatherForecastData::class,
            actual: app(abstract: OpenWeatherMapService::class)->dailyForecastByCityAndDate(city: City::where('name', 'Paris')->first(), date: $date));

    }

}
