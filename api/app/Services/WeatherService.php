<?php

namespace App\Services;

use App\DTOs\WeatherDataTransferObject;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openweathermap.key');
    }

    public function getWeatherByCoords($lat, $lon)
    {
        $response = Http::get("http://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$this->apiKey}");

        if ($response->failed()) {
            Log::error('Response to openweathermap API failed.', ['lat' => $lat, 'lon' => $lon]);

            throw new Exception('Response to openweathermap API failed.');
        }

        return new WeatherDataTransferObject($response->json());
    }
}
