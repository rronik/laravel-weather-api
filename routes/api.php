<?php

use App\Http\Controllers\Api\WeatherForecast\CreateWeatherForecastController;
use App\Http\Controllers\Api\WeatherForecast\DeleteWeatherForecastController;
use App\Http\Controllers\Api\WeatherForecast\IndexWeatherForecastController;
use App\Http\Controllers\Api\WeatherForecast\UpdateWeatherForecastController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get(uri: '/weather-forecast', action: IndexWeatherForecastController::class)->name('weather.forecast.index');
Route::post(uri: '/weather-forecast', action: CreateWeatherForecastController::class)->name('weather.forecast.create');
Route::delete(uri: '/weather-forecast/{weatherForecast}', action: DeleteWeatherForecastController::class)->name('weather.forecast.delete');
Route::put(uri: '/weather-forecast/{weatherForecast}', action: UpdateWeatherForecastController::class)->name('weather.forecast.update');
