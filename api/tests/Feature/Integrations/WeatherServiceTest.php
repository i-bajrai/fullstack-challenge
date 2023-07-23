<?php

namespace Tests\Feature\Integration;

use App\DTOs\WeatherDataTransferObject;
use App\Services\WeatherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetWeatherByCoords()
    {
        $service = app(WeatherService::class);
        $weather = $service->getWeatherByCoords(51.51, -0.13);

        $this->assertInstanceOf(WeatherDataTransferObject::class, $weather);
    }
}
