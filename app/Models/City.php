<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lat',
        'lon'
    ];

    /**
     * @return HasMany
     */
    public function weatherForecasts(): HasMany
    {
        return $this->hasMany(WeatherForecast::class);
    }
}
