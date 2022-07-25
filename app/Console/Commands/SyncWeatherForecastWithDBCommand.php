<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\FetchWeatherForecastFromAPIForDateAndCityAction;
use App\Actions\SyncWeatherForecastWithDBAction;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Jobs\SyncWeatherForecastWithDBJob;
use App\Models\City;
use Carbon\Carbon;
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
     * @param SyncWeatherForecastWithDBAction $syncWeatherForecastWithDBAction
     * @param FetchWeatherForecastFromAPIForDateAndCityAction $fetchWeatherForecastFromAPIForDateAndCityAction
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
    public function handle(): int
    {
        $cities = City::all();

        $today = Carbon::today();

        foreach ($cities as $city) {
            $apiForecast = $this->fetchWeatherForecastFromAPIForDateAndCityAction->execute($city, $today);
            SyncWeatherForecastWithDBJob::dispatch($apiForecast);
        }

        return 0;
    }
}
