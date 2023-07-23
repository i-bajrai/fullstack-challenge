<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class UserWeatherController extends Controller
{
    public function index()
    {

        $data = Cache::get('usersWithWeather', []);

        return response()->json([
            'message' => $data ? 'Success.' : 'Run <b>php artisan update:user-weather</b> command to fetch the data.',
            'users' => $data,
        ]);
    }
}
