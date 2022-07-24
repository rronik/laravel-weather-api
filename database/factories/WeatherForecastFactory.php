<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherForecastFactory extends Factory
{
    /**
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id' => City::factory(),
            'date' => $this->faker->date(),
            'day_temp' => $this->faker->randomFloat(4, 2, 30),
            'min_temp' => $this->faker->randomFloat(4, 2, 30),
            'max_temp' => $this->faker->randomFloat(4, 2, 30),
            'feels_like' => $this->faker->randomFloat(4, 2, 30),
            'pressure' => $this->faker->randomFloat(4, 500, 1100),
            'humidity' => $this->faker->randomFloat(4, 0, 100),
            'wind_speed' => $this->faker->randomFloat(4, 0, 50),
        ];
    }

}
