<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\WeatherForecast;

use App\Actions\WeatherForecastForDateAction;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IndexWeatherForecastRequest;
use App\Http\Resources\WeatherForecastResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexWeatherForecastController extends Controller
{
    /**
     * @param IndexWeatherForecastRequest $request
     * @param WeatherForecastForDateAction $weatherForecastForDateAction
     * @return AnonymousResourceCollection
     * @throws ForecastNotFoundException|ApiResponseException
     */
    public function __invoke(IndexWeatherForecastRequest $request, WeatherForecastForDateAction $weatherForecastForDateAction): AnonymousResourceCollection
    {
        $date = Carbon::parse($request->validated()['date']);

        $forecast = $weatherForecastForDateAction->execute($date);

        return WeatherForecastResource::collection($forecast);
    }
}
