<?php

namespace Tests\Unit\Forum\Domain\Requests;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Requests\UpdatePostRequest;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UpdatePostRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rules = (new UpdatePostRequest)->rules();
        $this->validator = $this->app['validator'];
    }
    /** @test */
    public function it_should_have_a_body()
    {
        $this->assertTrue($this->validateField('body', 'hey'));
    }
}
