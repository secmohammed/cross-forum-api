<?php

namespace Tests\Unit\Models\Integration\Forum\Domain\Observers;

use App\Forum\Domain\Models\Section;
use Tests\TestCase;

class SectionObserverTest extends TestCase
{
    /** @test */
    public function it_fires_creating_event_while_creating_section()
    {
        \Event::fake();
        $section = factory(Section::class)->create();
        \Event::assertDispatched('eloquent.creating: App\Forum\Domain\Models\Section');
    }
}
