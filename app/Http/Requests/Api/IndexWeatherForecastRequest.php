<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Rules\NoLongerThanSevenDays;
use Illuminate\Foundation\Http\FormRequest;

class IndexWeatherForecastRequest extends FormRequest
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
            'date' => ['required', 'date', new NoLongerThanSevenDays]
        ];
    }
}
