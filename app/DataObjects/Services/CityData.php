<?php

declare(strict_types=1);

namespace App\DataObjects\Services;

use App\Infrasctructure\Contracts\DataObjects\DataObjectContract;

class CityData implements DataObjectContract
{
    public function __construct(
        public string $name,
        public float  $lat,
        public float  $lon,
    )
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
