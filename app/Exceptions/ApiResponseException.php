<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Infrasctructure\Contracts\Exceptions\ExceptionContract;
use Exception;

class ApiResponseException extends Exception implements ExceptionContract
{
    /**
     * @return static
     */
    public static function make(): static
    {
        return new static('There was a problem getting the response!');
    }
}
