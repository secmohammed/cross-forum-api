<?php

namespace Tests\Unit\Forum\Domain\Requests;

use App\Forum\Domain\Requests\IndexTopicRequest;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class IndexTopicRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rules = (new IndexTopicRequest)->rules();
        $this->validator = $this->app['validator'];
    }
    /** @test */
    public function it_validates_against_section_id()
    {
        $this->assertFalse($this->validateField('section_id', 1));
    }
}
