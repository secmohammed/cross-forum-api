<?php

namespace Tests\Unit\Forum\Domain\Requests;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Requests\UpdateTopicRequest;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UpdateTopicRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rules = (new UpdateTopicRequest)->rules();
        $this->validator = $this->app['validator'];

    }
    /** @test */
    public function it_should_have_a_body()
    {
        $this->assertTrue($this->validateField('body', 'hey'));
    }
    /** @test */
    public function it_should_have_a_title()
    {
        $this->assertTrue($this->validateField('title','Hello'));
    }
    /** @test */
    public function it_should_have_a_section_id()
    {
        $this->assertFalse($this->validateField('section_id', null));
    }
    /** @test */
    public function it_should_have_an_existent_section_id()
    {
        $topic = factory(Topic::class)->create();
        $this->assertTrue($this->validateField('section_id', $topic->section_id));
    }
}
