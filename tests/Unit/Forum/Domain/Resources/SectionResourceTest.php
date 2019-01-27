<?php

namespace Tests\Unit\Forum\Domain\Resources;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Resources\SectionResource;
use Tests\TestCase;

class SectionResourceTest extends TestCase 
{
    /** @test */
    public function it_returns_title_slug_and_description()
    {
        $section = factory(Section::class)->make();
        $resource = (new SectionResource($section))->toArray(request());
        $this->assertEquals(['title','slug','description'], array_keys($resource));
    }
}
