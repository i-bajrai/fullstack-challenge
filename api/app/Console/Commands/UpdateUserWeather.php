<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\WeatherService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UpdateUserWeather extends Command
{
    protected $signature = 'update:user-weather';

    protected $description = 'Update weather data for all users';

    private $weatherService;

    private $userRepository;

    public function __construct(WeatherService $weatherService, UserRepository $userRepository)
    {
        parent::__construct();
        $this->weatherService = $weatherService;
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        $users = $this->userRepository->all();

        if (! $users->count()) {
            return $this->error('You have not seeded the database, run `php artisan db:seed`.');
        }

        $users->each(function (User $user) {
            try {
                $this->attemptWeatherInformationUpdate($user);
            } catch (Exception $e) {
                $message = $e->getMessage();
                Log::error('Failed to update user weather information.', [
                    'user' => $user->toArray(),
                    'message' => $message,
                ]);

                $this->info("Weather data update failed for user {$user->name}. {$message}.");
            }
        });

        $oneHour = 60 * 60;
        Cache::put('usersWithWeather', $this->userRepository->allWithWeather(), $oneHour);

        $this->info('Weather data updated for all users.');
    }

    protected function attemptWeatherInformationUpdate(User $user)
    {
        $weatherData = $this->weatherService->getWeatherByCoords($user->latitude, $user->longitude);

        $weather = $user->weather()->updateOrCreate([], (array) $weatherData);
        $weather->touch();

        $this->info("Weather data update for user {$user->name}.");
    }
}
