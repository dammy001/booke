<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\User;

class UserApiTest extends TestCase
{
    use ApiTestTrait, RefreshDatabase, WithFaker;

    public function testUserCanRegister()
    {
        $res = $this->postJson('api/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'damilare',
        ]);

        $res->dump()->assertSuccessful()->assertJsonStructure([
            'data' => [
                'user' => [
                    'name', 'email'
                ],
                'token'
            ]
        ]);
    }

}
