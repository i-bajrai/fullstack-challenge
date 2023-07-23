<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected const DEFAULT_MAX_LIMIT = 20;

    public function all(): Collection
    {
        return User::all();
    }

    public function allWithWeather(): Collection
    {
        return User::with('weather')->limit(static::DEFAULT_MAX_LIMIT)->get();
    }
}
