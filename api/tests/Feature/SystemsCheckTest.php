<?php

namespace Tests\Feature;

use Tests\TestCase;

class SystemsCheckTest extends TestCase
{
    public function test_systems_check_endpoint_with_no_data()
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Run <b>php artisan update:user-weather</b> command to fetch the data.',
            ])
            ->assertJsonStructure([
                'users' => [
                    '*' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                ],
            ]);
    }
}
