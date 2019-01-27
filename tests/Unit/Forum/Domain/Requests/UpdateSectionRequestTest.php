<?php

namespace Tests\Unit\Forum\Domain\Requests;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Requests\UpdateSectionRequest;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Tests\TestCase;
class UpdateSectionRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $section = factory(Section::class)->create();
        $requestMock = $this->mock(Request::class)
            ->makePartial()
            ->shouldReceive('route')
            ->once()
            ->andReturn($section);

        app()->instance('request', $requestMock->getMock());

        $request = request();

        $request->setRouteResolver(function () use ($request) {
            return (new Route('POST', 'api/section/{section}/update', []))->bind($request);
        });
        $this->rules = (new UpdateSectionRequest)->rules();
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
