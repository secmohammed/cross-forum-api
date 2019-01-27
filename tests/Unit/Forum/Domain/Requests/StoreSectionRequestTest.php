<?php

namespace Tests\Unit\Forum\Domain\Requests;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Requests\StoreSectionRequest;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class StoreSectionRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rules = (new StoreSectionRequest)->rules();
        $this->validator = $this->app['validator'];
    }
    /** @test */
    public function it_should_have_a_description()
    {
        $this->assertTrue($this->validateField('description', 'hey'));
    }
    /** @test */
    public function it_should_have_a_unique_title()
    {
        $this->assertTrue($this->validateField('title','Hello'));
    }
    /** @test */
    public function it_shouldnt_pass_if_passed_title_isnt_unique()
    {
        $section = factory(Section::class)->create(['title' => 'Hello']);
        $this->assertFalse($this->validateField('title','Hello'));
    }
}
