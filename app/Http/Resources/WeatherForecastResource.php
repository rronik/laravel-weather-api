<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class WeatherForecastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'city' => CityResource::make($this->city),
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
