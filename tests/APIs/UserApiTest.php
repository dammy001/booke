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
        $user = factory(User::class)->make();

        $res = $this->postJson('api/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
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

    public function testUserCanLogin()
    {

    }

}
