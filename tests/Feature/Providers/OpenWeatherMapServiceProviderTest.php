<?php

declare(strict_types=1);

namespace Tests\Feature\Providers;

use App\Services\OpenWeatherMap\OpenWeatherMapService;
use Tests\TestCase;

class OpenWeatherMapServiceProviderTest extends TestCase
{

    /**
     * @return void
     */
    public function test_it_will_register_open_weather_map_service()
    {
        $this->assertInstanceOf(
            expected: OpenWeatherMapService::class,
            actual: app(abstract: OpenWeatherMapService::class));
    }

    /**
     * @return void
     */
    public function test_it_will_register_open_weather_map_service_based_on_config()
    {
        $this->assertSame(expected: config(key: 'services.open-weather-map.uri'), actual: app(abstract: OpenWeatherMapService::class)->uri);
        $this->assertSame(expected: config(key: 'services.open-weather-map.token'), actual: app(abstract: OpenWeatherMapService::class)->token);
        $this->assertSame(expected: intval(config(key: 'services.open-weather-map.timeout')), actual: app(abstract: OpenWeatherMapService::class)->timeout);
        $this->assertSame(expected: intval(config(key: 'services.open-weather-map.retry_times')), actual: app(abstract: OpenWeatherMapService::class)->retryTimes);
        $this->assertSame(expected: intval(config(key: 'services.open-weather-map.retry_milliseconds')), actual: app(abstract: OpenWeatherMapService::class)->retryAfterMilliseconds);
    }


}
