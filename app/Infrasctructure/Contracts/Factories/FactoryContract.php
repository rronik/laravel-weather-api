<?php

declare(strict_types=1);

namespace App\Infrasctructure\Contracts\Factories;

use App\Infrasctructure\Contracts\DataObjects\DataObjectContract;

interface FactoryContract
{

    /**
     * @param array $attributes
     * @return DataObjectContract
     */
    public static function make(array $attributes): DataObjectContract;
}
