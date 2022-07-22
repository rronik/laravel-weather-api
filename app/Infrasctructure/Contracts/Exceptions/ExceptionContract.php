<?php

declare(strict_types=1);

namespace App\Infrasctructure\Contracts\Exceptions;

use Exception;

interface ExceptionContract
{

    /**
     * @return Exception
     */
    public static function make(): Exception;
}
