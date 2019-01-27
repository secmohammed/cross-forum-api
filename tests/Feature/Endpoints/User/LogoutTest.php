<?php

namespace Tests\Feature\Endpoints\User;

use App\App\Domain\Notifications\ResetPassword;
use App\Users\Domain\Collection\UserResource;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /** @test */
    public function it_tries_to_logout_without_being_authenticated()
    {
        $this->post('/api/auth/logout')->assertStatus(401);
    }
    /** @test */
    public function it_tries_to_logout_using_invalid_token()
    {
        $user = factory(User::class)->create();
        $token = auth()->attempt(['email' => $user->email, 'password' => 'secret']);
        auth()->logout();
        $res = $this->post('/api/auth/logout',[], [
            'Authorization' => "Bearer {$token}"
        ])->assertStatus(200)->assertJsonFragment(["The token has been blacklisted"]);
    }
    /** @test */
    public function it_tries_to_logout_using_valid_token()
    {
        $user = factory(User::class)->create();
        $token = auth()->attempt(['email' => $user->email, 'password' => 'secret']);
        $res = $this->post('/api/auth/logout',[], [
            'Authorization' => "Bearer {$token}"
        ])->assertStatus(200)->assertJsonFragment(["Catch you soon."]);
        
    }

}
