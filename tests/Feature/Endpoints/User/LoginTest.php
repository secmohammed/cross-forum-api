<?php

namespace Tests\Feature\Endpoints\User;

use App\Users\Domain\Collection\UserResource;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function it_tries_to_login_with_empty_data()
    {
        $this->post('api/auth/login',[
            'email' => null,
            'password' => null
        ])->assertSessionHasErrors(['email','password']);
    }
    /** @test */
    public function it_tries_to_login_with_invalid_credentials()
    {
        $this->post('api/auth/login',[
            'email' => 'invalid',
            'password' => 12341
        ])->assertStatus(401);   
    }
    /** @test */
    public function it_tries_to_login_with_valid_credentials()
    {
        $user = factory(User::class)->create();
        $resource = new UserResource($user);
        $this->post('api/auth/login',[
            'email' => $user->email,
            'password' => 'secret'
        ])->assertStatus(200)->assertResource($resource);
    }
}
