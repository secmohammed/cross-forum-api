<?php

namespace Tests\Feature\Endpoints\User;

use App\App\Domain\Notifications\ResetPassword;
use App\Users\Domain\Collection\UserResource;
use App\Users\Domain\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    /** @test */
    public function it_tries_to_forgot_password_with_empty_email()
    {
        $this->post('api/auth/forgot-password')->assertStatus(422)->assertJsonValidationErrors('email');
    }
    /** @test */
    public function it_tries_to_forgot_password_with_non_existent_email()
    {
        $this->post('api/auth/forgot-password',[
            'email' => 'odnowndwq'
        ])->assertStatus(422)->assertJsonValidationErrors('email');
    }
    /** @test */
    public function it_tries_to_forgot_password_with_valid_email()
    {
        $user = factory(User::class)->create();
        \Notification::fake();
        $this->post('api/auth/forgot-password',[
            'email' => $user->email
        ])->assertStatus(200);
        $this->assertDatabaseHas('password_resets',[
            'email' => $user->email
        ]);
        \Notification::assertSentTo($user, ResetPassword::class, function ($notification) use($user) {
            $token = \DB::table('password_resets')->where('email', $user->email)->first()->token;
            $this->assertEquals('http://localhost/api/auth/reset-password?token=' . $token, 
                $notification->toMail($user)->actionUrl
            );
            return $notification->token == $token;
        });
    }
}
