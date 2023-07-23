<?php

namespace App\DTOs;

class WeatherDataTransferObject
{
    public readonly ?string $ext_id;

    public readonly ?string $weather_main;

    public readonly ?string $weather_description;

    public readonly ?string $weather_icon;

    public readonly ?string $base;

    public readonly ?string $main_temp;

    public readonly ?string $main_feels_like;

    public readonly ?string $main_temp_min;

    public readonly ?string $main_temp_max;

    public readonly ?string $main_pressure;

    public readonly ?string $main_humidity;

    public readonly ?string $visibility;

    public readonly ?string $wind_speed;

    public readonly ?string $wind_deg;

    public readonly ?string $wind_gust;

    public readonly ?string $clouds_all;

    public readonly string $sys_country;

    public readonly ?string $sys_sunrise;

    public readonly ?string $sys_sunset;

    public readonly ?string $timezone;

    public readonly ?string $name;

    public function __construct(array $data)
    {
        $this->ext_id = $data['id'];
        $this->weather_main = $data['weather'][0]['main'] ?? null;
        $this->weather_description = $data['weather'][0]['description'] ?? null;
        $this->weather_icon = $data['weather'][0]['icon'] ?? null;
        $this->base = $data['base'] ?? null;
        $this->main_temp = $data['main']['temp'] ?? null;
        $this->main_feels_like = $data['main']['feels_like'] ?? null;
        $this->main_temp_min = $data['main']['temp_min'] ?? null;
        $this->main_temp_max = $data['main']['temp_max'] ?? null;
        $this->main_pressure = $data['main']['pressure'] ?? null;
        $this->main_humidity = $data['main']['humidity'] ?? null;
        $this->visibility = $data['visibility'] ?? null;
        $this->wind_speed = $data['wind']['speed'] ?? null;
        $this->wind_deg = $data['wind']['deg'] ?? null;
        $this->wind_gust = $data['wind']['gust'] ?? null;
        $this->clouds_all = $data['clouds']['all'] ?? null;
        $this->sys_country = $data['sys']['country'] ?? '-';
        $this->sys_sunrise = $data['sys']['sunrise'] ?? null;
        $this->sys_sunset = $data['sys']['sunset'] ?? null;
        $this->timezone = $data['timezone'] ?? null;
        $this->name = $data['name'] ?? null;
    }
}
