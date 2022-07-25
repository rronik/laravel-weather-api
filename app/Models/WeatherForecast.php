<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherForecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'date',
        'day_temp',
        'min_temp',
        'max_temp',
        'feels_like',
        'pressure',
        'humidity',
        'wind_speed',
    ];

    protected $casts = ['date' => 'date'];

    protected $appends = ['city'];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(related: City::class);
    }
}
