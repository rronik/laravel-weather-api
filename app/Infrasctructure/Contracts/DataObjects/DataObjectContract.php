<?php

declare(strict_types=1);

namespace App\Infrasctructure\Contracts\DataObjects;

interface DataObjectContract
{

    /**
     * @return array
     */
    public function toArray(): array;
}
