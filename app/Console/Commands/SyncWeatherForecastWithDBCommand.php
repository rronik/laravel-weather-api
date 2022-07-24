<?php

namespace App\Console\Commands;

use App\Actions\FetchWeatherForecastFromAPIForDateAndCityAction;
use App\Actions\SyncWeatherForecastWithDBAction;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Jobs\SyncWeatherForecastWithDBJob;
use App\Models\City;
use Illuminate\Console\Command;

class SyncWeatherForecastWithDBCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'open-weather-map:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes data retrieved from the OpenWeatherMap API with local DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        protected SyncWeatherForecastWithDBAction                 $syncWeatherForecastWithDBAction,
        protected FetchWeatherForecastFromAPIForDateAndCityAction $fetchWeatherForecastFromAPIForDateAndCityAction
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws ApiResponseException
     * @throws ForecastNotFoundException
     */
    public function handle()
    {
        $cities = City::all();

        $today = today();

        foreach ($cities as $city) {
            $apiForecast = $this->fetchWeatherForecastFromAPIForDateAndCityAction->execute($city, $today);
            SyncWeatherForecastWithDBJob::dispatch($apiForecast);
        }

        return 0;
    }
}
