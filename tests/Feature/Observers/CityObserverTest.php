<?php

declare(strict_types=1);

namespace Tests\Feature\Observers;

use App\Jobs\CacheCityDataJob;
use App\Models\City;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;


class CityObserverTest extends TestCase
{
    public function test_it_will_update_cache_when_a_city_is_created(): void
    {
        Bus::fake();

        City::factory()->create();

        Bus::assertDispatched(command: CacheCityDataJob::class, callback: 1);
    }

    public function test_it_will_update_cache_when_a_city_is_updated(): void
    {
        $city = City::factory()->create();

        Bus::fake();

        $city->refresh()->update(['name', 'Prishtina']);

        Bus::assertDispatched(command: CacheCityDataJob::class, callback: 1);
    }

    public function test_it_will_update_cache_when_a_city_is_deleted(): void
    {
        $city = City::factory()->create();

        Bus::fake();

        $city->delete();

        Bus::assertDispatched(command: CacheCityDataJob::class, callback: 1);
    }
}
