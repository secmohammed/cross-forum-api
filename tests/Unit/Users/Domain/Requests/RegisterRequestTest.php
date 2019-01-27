<?php

namespace Tests\Unit\Users\Domain\Requests;

use App\Users\Domain\Models\User;
use App\Users\Domain\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class RegisterRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rules =  (new RegisterRequest)->rules();
        $this->validator = $this->app['validator'];
    }
    /** @test */
    public function password_cant_be_empty()
    {
        $this->assertFalse($this->validateField('password',null));
    }
    /** @test */
    public function password_should_be_confirmed()
    {
        $this->assertFalse($this->validateField('password', 1234));
    }
    /** @test */
    public function email_should_be_required()
    {
        $this->assertTrue($this->validateField('email', 'mohammed@example.com'));
    }
    /** @test */
    public function username_should_be_required()
    {
        $this->assertTrue($this->validateField('username', 'mohammed'));
    }
}
