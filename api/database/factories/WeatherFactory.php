<?php

namespace Database\Factories;

use App\Models\Weather;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeatherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Weather::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ext_id' => $this->faker->unique()->randomNumber(),
            'weather_main' => $this->faker->word,
            'weather_description' => $this->faker->sentence,
            'weather_icon' => $this->faker->word,
            'base' => $this->faker->word,
            'main_temp' => $this->faker->randomFloat(2, 0, 100),
            'main_feels_like' => $this->faker->randomFloat(2, 0, 100),
            'main_temp_min' => $this->faker->randomFloat(2, 0, 100),
            'main_temp_max' => $this->faker->randomFloat(2, 0, 100),
            'main_pressure' => $this->faker->randomNumber(),
            'main_humidity' => $this->faker->randomNumber(),
            'visibility' => $this->faker->randomNumber(),
            'wind_speed' => $this->faker->randomFloat(2, 0, 100),
            'wind_deg' => $this->faker->randomNumber(),
            'wind_gust' => $this->faker->randomFloat(2, 0, 100),
            'clouds_all' => $this->faker->randomNumber(),
            'sys_country' => $this->faker->countryCode,
            'sys_sunrise' => $this->faker->unixTime,
            'sys_sunset' => $this->faker->unixTime,
            'timezone' => 0,
            'name' => $this->faker->city,
        ];
    }
}
