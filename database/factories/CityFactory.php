<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->city(),
            'lat' => $this->faker->latitude(),
            'lon' => $this->faker->longitude(),
        ];
    }

}
