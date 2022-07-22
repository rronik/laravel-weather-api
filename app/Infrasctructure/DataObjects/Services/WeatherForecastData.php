<?php

declare(strict_types=1);

namespace App\Infrasctructure\DataObjects\Services;

use App\Infrasctructure\Contracts\DataObjects\DataObjectContract;
use Carbon\Carbon;

class WeatherForecastData implements DataObjectContract
{
    public function __construct(
        public int    $city_id,
        public Carbon $date,
        public float  $day_temp,
        public float  $min_temp,
        public float  $max_temp,
        public float  $feels_like,
        public float  $pressure,
        public float  $humidity,
        public float  $wind_speed,
    )
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'city_id' => $this->city_id,
            'date' => $this->date,
            'day_temp' => $this->day_temp,
            'min_temp' => $this->min_temp,
            'max_temp' => $this->max_temp,
            'feels_like' => $this->feels_like,
            'pressure' => $this->pressure,
            'humidity' => $this->humidity,
            'wind_speed' => $this->wind_speed,
        ];
    }
}
