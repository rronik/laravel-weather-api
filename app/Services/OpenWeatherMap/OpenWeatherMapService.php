<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherMap;

use App\DataObjects\Services\WeatherForecastData;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ForecastNotFoundException;
use App\Factories\Services\WeatherForecastDataFactory;
use App\Infrasctructure\Contracts\Services\ApiServiceContract;
use App\Models\City;
use App\Traits\HasFake;
use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapService implements ApiServiceContract
{
    use HasFake;

    /**
     * @param string $uri
     * @param string $token
     * @param int|null $timeout
     * @param int|null $retryTimes
     * @param int|null $retryAfterMilliseconds
     */
    public function __construct(
        protected string $uri,
        protected string $token,
        public null|int  $timeout = 10,
        public null|int  $retryTimes = null,
        public null|int  $retryAfterMilliseconds = null,
    )
    {
    }

    /**
     * @return PendingRequest
     */
    public function baseRequest(): PendingRequest
    {
        $request = Http::baseUrl(
            url: $this->uri,
        )->withHeaders([
            'Accept' => 'application/json',
        ])->timeout(
            seconds: $this->timeout,
        );

        if (!is_null($this->retryTimes) && !is_null($this->retryAfterMilliseconds)) {
            $request->retry(
                times: $this->retryTimes,
                sleep: $this->retryAfterMilliseconds,
            );
        }

        return $request;
    }

    /**
     * @param int $timeout
     * @return void
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @param int $retryTimes
     * @return void
     */
    public function setRetryTimes(int $retryTimes)
    {
        $this->retryTimes = $retryTimes;
    }

    /**
     * @param int $retryAfterMilliseconds
     * @return void
     */
    public function setRetryAfterMilliseconds(int $retryAfterMilliseconds)
    {
        $this->retryAfterMilliseconds = $retryAfterMilliseconds;
    }

    /**
     * @param City $city
     * @param Carbon $date
     * @return WeatherForecastData
     * @throws ApiResponseException
     * @throws ForecastNotFoundException
     */
    public function dailyForecastByCityAndDate(City $city, Carbon $date): WeatherForecastData
    {
        $request = $this->baseRequest();

        $response = $request->get(
            url: "/data/2.5/onecall",
            query: [
                'appid' => $this->token,
                'units' => 'metric',
                'exclude' => 'current,minutely,hourly,alerts',
                'lat' => $city->lat,
                'lon' => $city->lon,
            ]
        );

        if ($response->failed()) {
            throw ApiResponseException::make();
        }

        $forecast = $response->collect('daily')->whereBetween('dt', [$date->startOfDay()->timestamp, $date->endOfDay()->timestamp])->first();

        if (!$forecast) {
            throw ForecastNotFoundException::make();
        }

        $forecast['city'] = $city->toArray();

        return WeatherForecastDataFactory::make(attributes: $forecast);

    }
}
