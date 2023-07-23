<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Weather;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new UserRepository();
    }

    public function testAll()
    {
        User::factory()->count(5)->create();

        $users = $this->userRepository->all();

        $this->assertCount(5, $users);
    }

    public function testAllWithWeather()
    {
        $user = User::factory()->create();
        Weather::factory()->create(['user_id' => $user->id]);

        $usersWithWeather = $this->userRepository->allWithWeather();

        $this->assertCount(1, $usersWithWeather);
        $this->assertEquals($user->id, $usersWithWeather->first()->id);
        $this->assertNotNull($usersWithWeather->first()->weather);
    }
}
