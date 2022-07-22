<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\WeatherForecastForDateAction;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Http\Requests\WeatherForecastRequest;
use App\Http\Resources\WeatherForecastResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WeatherForecastController extends Controller
{
    /**
     * @param WeatherForecastRequest $request
     * @param WeatherForecastForDateAction $weatherForecastForDateAction
     * @return AnonymousResourceCollection
     * @throws ForecastNotFoundException|ApiResponseException
     */
    public function __invoke(WeatherForecastRequest $request, WeatherForecastForDateAction $weatherForecastForDateAction)
    {
        $date = Carbon::parse($request->validated()['date']);

        $forecast = $weatherForecastForDateAction->execute($date);

        return WeatherForecastResource::collection($forecast);
    }
}
