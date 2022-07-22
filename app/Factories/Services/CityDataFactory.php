<?php

declare(strict_types=1);

namespace App\Factories\Services;

use App\DataObjects\Services\CityData;
use App\Infrasctructure\Contracts\Factories\FactoryContract;

class CityDataFactory implements FactoryContract
{
    /**
     * @param array $attributes
     * @return CityData
     */
    public static function make(array $attributes): CityData
    {
        return new CityData(
            name: $attributes['name'],
            lat: $attributes['lat'],
            lon: $attributes['lon'],
        );
    }
}
