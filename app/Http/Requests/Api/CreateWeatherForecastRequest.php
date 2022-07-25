<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateWeatherForecastRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'city_id' => ['sometimes', 'required', 'exists:cities,id'],
            'date' => ['required', 'date', 'unique:weather_forecasts,date'],
            'day_temp' => ['required', 'numeric'],
            'min_temp' => ['required', 'numeric'],
            'max_temp' => ['required', 'numeric'],
            'feels_like' => ['required', 'numeric'],
            'pressure' => ['required', 'numeric'],
            'humidity' => ['required', 'numeric'],
            'wind_speed' => ['required', 'numeric'],
        ];
    }
}
