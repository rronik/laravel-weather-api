<?php

declare(strict_types=1);

namespace App\Infrasctructure\Contracts\Services;

use Illuminate\Http\Client\PendingRequest;

interface ApiServiceContract
{

    /**
     * @return PendingRequest
     */
    public function baseRequest(): PendingRequest;
}
