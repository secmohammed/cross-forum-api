<?php

namespace Tests\Feature\Endpoints\User;

use App\Users\Domain\Collection\UserResource;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizedUserTest extends TestCase
{
    /** @test */
    public function it_tries_to_get_authorized_user_without_having_a_token()
    {
        $this->get('api/user')->assertStatus(401);
    }
    /** @test */
    public function it_tries_to_get_authorized_user_using_invalid_token()
    {
        $user = factory(User::class)->create([
            'email' => 'mohammedosama@ieee.org',
            'password' => bcrypt(123456789),
        ]);
        $token = auth()->attempt(['email' => $user->email, 'password' => 123456789]);
        auth()->logout();
        $this->get('/api/user', ['Authorization' => "Bearer $token"])->assertStatus(200)->assertJsonFragment(["The token has been blacklisted"]);    
    }
    /** @test */
    public function it_tries_to_get_authorized_user_using_a_valid_token()
    {
        $user = factory(User::class)->create([
            'email' => 'mohammedosama@ieee.org',
            'password' => bcrypt(123456789),
        ]);
        $resource = new UserResource($user);
        $token = auth()->attempt(['email' => $user->email, 'password' => 123456789]);
        $this->get('/api/user', ['Authorization' => "Bearer $token"])->assertStatus(200)->assertResource($resource);    
    }
}
