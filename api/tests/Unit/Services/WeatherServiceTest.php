<?php

namespace Tests\Unit\Services;

use App\DTOs\WeatherDataTransferObject;
use App\Services\WeatherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetWeatherByCoords()
    {
        $response = [
            'id' => 'test',
            'coord' => [
                'lon' => -0.13,
                'lat' => 51.51,
            ],
            'weather' => [
                [
                    'id' => 300,
                    'main' => 'Drizzle',
                    'description' => 'light intensity drizzle',
                    'icon' => '09d',
                ],
            ],
        ];

        Http::fake([
            'api.openweathermap.org/*' => Http::response($response, 200),
        ]);

        $service = app(WeatherService::class);
        $weather = $service->getWeatherByCoords(51.51, -0.13);

        $this->assertEquals((array) new WeatherDataTransferObject($response), (array) $weather);
    }
}
