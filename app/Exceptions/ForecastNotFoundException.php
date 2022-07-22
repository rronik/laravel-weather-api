<?php

namespace App\Exceptions;

use App\Infrasctructure\Contracts\Exceptions\ExceptionContract;
use Exception;

class ForecastNotFoundException extends Exception implements ExceptionContract
{
    /**
     * @return static
     */
    public static function make(): static
    {
        return new static('No forecast was found for the given date and city!');
    }
}
