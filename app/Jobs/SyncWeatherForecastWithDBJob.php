<?php

namespace App\Jobs;

use App\DataObjects\Services\WeatherForecastData;
use App\Models\WeatherForecast;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncWeatherForecastWithDBJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public WeatherForecastData $weatherForecastData)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return WeatherForecast::updateOrCreate(
            ['city_id' => $this->weatherForecastData->city_id, 'date' => $this->weatherForecastData->date->format('Y-m-d')],
            $this->weatherForecastData->toArray()
        );
    }
}
