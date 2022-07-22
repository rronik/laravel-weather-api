<?php

namespace App\Http\Controllers;

class WeatherForecastController extends Controller
{
    /**
     * @return string
     */
    public function __invoke(): string
    {
        return 'test';
    }
}
