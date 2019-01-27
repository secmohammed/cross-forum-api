<?php

namespace Tests\Unit\Users\Domain\Requests;

use App\Users\Domain\Models\User;
use App\Users\Domain\Requests\LoginRequest;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rules = (new LoginRequest)->rules();
        $this->validator = $this->app['validator'];
    }
    /** @test */
    public function email_cant_be_empty()
    {
        $this->assertFalse($this->validateField('email',null));
    }
    /** @test */
    public function email_should_be_required()
    {
        $this->assertTrue($this->validateField('email','email'));
    }

}
