<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\CacheCityDataJob;

class CityObserver
{
    /**
     *
     * @return void
     */
    public function saved(): void
    {
        CacheCityDataJob::dispatch();
    }

    /**
     *
     * @return void
     */
    public function deleted(): void
    {
        CacheCityDataJob::dispatch();
    }

}
