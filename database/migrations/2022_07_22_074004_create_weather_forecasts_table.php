<?php

declare(strict_types=1);

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(model: City::class);
            $table->date(column: 'date');
            $table->float(column: 'day_temp');
            $table->float(column: 'min_temp');
            $table->float(column: 'max_temp');
            $table->float(column: 'feels_like');
            $table->float(column: 'pressure');
            $table->float(column: 'humidity');
            $table->float(column: 'wind_speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_forecasts');
    }
}
