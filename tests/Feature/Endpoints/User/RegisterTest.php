<?php

namespace Tests\Feature\Endpoints\User;

use App\Users\Domain\Collection\UserResource;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function it_tries_to_register_with_empty_data()
    {
        $this->post('api/auth/register')->assertSessionHasErrors(['username','email','password']);
    }
    /** @test */
    public function it_tries_to_register_with_non_unique_email()
    {
        $user = factory(User::class)->create();
        $data = array_merge(
            factory(User::class)->make(['email' => $user->email])->toArray(),
            [
                'password' => 123456,
                'password_confirmation' => 123456
            ]
        );
        $this->post('api/auth/register', $data)->assertSessionHasErrors(['email']);
    }
    /** @test */
    public function it_tries_to_register_with_non_confirmed_password()
    {
        $data = array_merge(
            factory(User::class)->make()->toArray(),
            [
                'password' => 123456,
            ]
        );
        $this->post('api/auth/register', $data)->assertSessionHasErrors(['password']);
    }
    /** @test */
    public function it_tries_to_register_with_valid_data()
    {
        $data = array_merge(
            factory(User::class)->make()->toArray(),
            [
                'password' => 123456,
                'password_confirmation' => 123456
            ]
        );
        $this->post('api/auth/register',$data)->assertStatus(201)->assertJsonStructure(['data' => ['username','email','avatar']]);
    }

}
