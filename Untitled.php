<?php

use App\Models\City;
use App\Models\WeatherForecast;
use App\Services\OpenWeatherMap\OpenWeatherMapService;


// Cache::get('cities');
// 
// City::create(['name' => 'Prishtina', 'lat' => 100, 'lon' => 50]);

//  Cache::forget('cities');

//         Cache::rememberForever('cities', function () {
//             return City::all();
//         });

// Cache::get('cities');

// $weatherForecast = app(OpenWeatherMapService::class)->dailyForecastByCityAndDate(City::find(1), now()->addDays(7));
  

  // WeatherForecast::updateOrCreate(
  //           ['city_id' => $weatherForecast->city_id, 'date' => $weatherForecast->date->format('Y-m-d')],
  //           $weatherForecast->toArray()
  //       );

// app(OpenWeatherMapService::class)->retryTimes(11);
// app(OpenWeatherMapService::class)->retryTimes;

WeatherForecast::all();
// City::find(1)->weatherForecasts