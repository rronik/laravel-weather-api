# Laravel Weather API

A simple Laravel API that returns the weather forecast for a given date.

## Requirements

- Docker

## Getting started

### Setting up

- Copy ``.env.example`` to ``.env``


- Inside project directory run:

```
  docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php81-composer:latest \
  composer install --ignore-platform-reqs
  ```

```
./vendor/bin/sail up -d
```

```
./vendor/bin/sail artisan key:gen
```

- go to [Open weather map](https://home.openweathermap.org/api_keys), copy generated API key and paste it
  in ``OPEN_WEATHER_MAP_API_TOKEN`` inside ``.env``

```
./vendor/bin/sail artisan migrate:fresh --seed
```

### Running tests

```
./vendor/bin/sail test
```

### Usage

#### Pull weather forecast for specified date

- Request

```
curl --location --request GET 'http://localhost/api/weather-forecast?date=2022-07-30' \
--header 'Accept: application/json'
```

- Response

```
{
    "data": [
        {
            "city": {
                "name": "New York",
                "lat": 40.7128,
                "lon": 74.006
            },
            "date": "2022-07-30T07:00:00.000000Z",
            "day_temp": 6.18,
            "min_temp": 0.18,
            "max_temp": 7.08,
            "feels_like": 3.3,
            "pressure": 1014,
            "humidity": 54,
            "wind_speed": 4.02
        },
        {
            "city": {
                "name": "London",
                "lat": 51.5072,
                "lon": 0.1276
            },
            "date": "2022-07-30T12:00:00.000000Z",
            "day_temp": 23.29,
            "min_temp": 16.55,
            "max_temp": 23.95,
            "feels_like": 22.75,
            "pressure": 1017,
            "humidity": 41,
            "wind_speed": 4.75
        },
        {
            "city": {
                "name": "Paris",
                "lat": 48.8566,
                "lon": 2.3522
            },
            "date": "2022-07-30T11:00:00.000000Z",
            "day_temp": 27.63,
            "min_temp": 18.57,
            "max_temp": 29.57,
            "feels_like": 26.79,
            "pressure": 1017,
            "humidity": 29,
            "wind_speed": 5.56
        },
        {
            "city": {
                "name": "Berlin",
                "lat": 52.52,
                "lon": 13.405
            },
            "date": "2022-07-30T11:00:00.000000Z",
            "day_temp": 17.57,
            "min_temp": 16.47,
            "max_temp": 21.2,
            "feels_like": 17.39,
            "pressure": 1015,
            "humidity": 77,
            "wind_speed": 4.82
        },
        {
            "city": {
                "name": "Tokyo",
                "lat": 35.6762,
                "lon": 139.6503
            },
            "date": "2022-07-30T02:00:00.000000Z",
            "day_temp": 32.32,
            "min_temp": 26.84,
            "max_temp": 32.32,
            "feels_like": 34.23,
            "pressure": 1013,
            "humidity": 47,
            "wind_speed": 8.22
        }
    ]
}
```

#### Add a forecast

- Request

```
curl --location --request POST 'http://localhost/api/weather-forecast' \
--header 'Accept: application/json' \
--form 'city_id="1"' \
--form 'date="2021-07-11"' \
--form 'day_temp="30"' \
--form 'min_temp="20"' \
--form 'max_temp="33"' \
--form 'feels_like="29"' \
--form 'pressure="1000"' \
--form 'humidity="30"' \
--form 'wind_speed="4.8"'
```

- Response

```
{
    "data": {
        "city": {
            "name": "New York",
            "lat": 40.7128,
            "lon": 74.006
        },
        "date": "2021-07-11T00:00:00.000000Z",
        "day_temp": "30",
        "min_temp": "20",
        "max_temp": "33",
        "feels_like": "29",
        "pressure": "1000",
        "humidity": "30",
        "wind_speed": "4.8"
    }
}
```

#### Update a forecast

- Request

```
curl --location --request PUT 'http://localhost/api/weather-forecast/1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'city_id=1' \
--data-urlencode 'date=2021-07-10' \
--data-urlencode 'day_temp=29' \
--data-urlencode 'min_temp=20' \
--data-urlencode 'max_temp=33' \
--data-urlencode 'feels_like=29' \
--data-urlencode 'pressure=1000' \
--data-urlencode 'humidity=30' \
--data-urlencode 'wind_speed=4.8'
```

- Response

```
{
    "data": {
        "city": {
            "name": "New York",
            "lat": 40.7128,
            "lon": 74.006
        },
        "date": "2021-07-10T00:00:00.000000Z",
        "day_temp": "29",
        "min_temp": "20",
        "max_temp": "33",
        "feels_like": "29",
        "pressure": "1000",
        "humidity": "30",
        "wind_speed": "4.8"
    }
}
```

#### Delete a forecast

- Request

```
curl --location --request DELETE 'http://localhost/api/weather-forecast/2' \
--header 'Accept: application/json'
```

- Response

```
{
    "data": {
        "city": {
            "name": "London",
            "lat": 51.5072,
            "lon": 0.1276
        },
        "date": "2022-07-27T00:00:00.000000Z",
        "day_temp": 20.93,
        "min_temp": 15.2,
        "max_temp": 21.27,
        "feels_like": 20.18,
        "pressure": 1020,
        "humidity": 42,
        "wind_speed": 4.07
    }
}
```

## About

The purpose of this project is to showcase my approach of implementing Laravel's *"not so"* out of the box features,
utilizing data from a *3rd party API* as well as implementing principles/approaches such as *Actions*, *Data Objects*
and *Factories*.

### Key concepts

- Traits
- Events
- Listeners
- Jobs
- Contracts
- Observers
- Commands
- Schedulers
- Collections
- Requests
- Validation Rules
- Exceptions
- Providers
- Resources
- Services
- Actions
- Data Object
- Data Factories
- Tests

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
