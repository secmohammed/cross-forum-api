<?php

namespace Tests\Feature\Endpoints\User;

use App\Users\Domain\Collection\UserResource;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    /** @test */
    public function it_tries_to_reset_password_with_empty_token()
    {
        $this->post('api/auth/reset-password',[
            'password' => 123456,
            'password_confirmation' => 123456
        ])->assertStatus(422)->assertJsonValidationErrors('token');
    }
    /** @test */
    public function it_tries_to_reset_password_with_invalid_token()
    {
        $this->post('api/auth/reset-password?token=odnqwodnoqndqw',[
            'password' => 123456,
            'password_confirmation' => 123456
        ])->assertStatus(422)->assertJsonValidationErrors('token');
    }
    /** @test */
    public function it_tries_to_reset_password_with_valid_token()
    {
        $user = factory(User::class)->create();
        $this->post('api/auth/forgot-password', [
            'email' => $user->email
        ]);
        $token = \DB::table('password_resets')->where('email',$user->email)->first()->token;
        $this->post('api/auth/reset-password?token=' . $token, [
            'password' => 12345678,
            'password_confirmation' => 12345678
        ])->assertStatus(200);
    }
}
