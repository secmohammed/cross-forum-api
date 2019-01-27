<?php

namespace Tests\Unit\Forum\Domain\Models;

use App\Forum\Domain\Models\Section;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class SectionTest extends TestCase
{
    /** @test */
    public function it_has_users_table()
    {
        $section = new Section;
        $this->assertEquals('sections', $section->getTable());
    }
    /** @test */
    public function it_has_all_fillabled_except_for_id()
    {
        $section = new Section;
        $this->assertEquals(['title','description','slug'], $section->getFillable());
    }
    /** @test */
    public function it_has_many_topics_relation()
    {
        $section = new Section;
        $this->assertInstanceOf(HasMany::class, $section->topics());
    }
    /** @test */
    public function it_has_section_id_as_a_foreign_key_for_topics_relation()
    {
        $section = new Section;
        $this->assertEquals('section_id', $section->topics()->getForeignKeyName());
        
    }
    /** @test */
    public function it_has_id_as_a_local_key_for_topics_relation()
    {
        $section = new Section;
        $this->assertEquals('id', $section->topics()->getLocalKeyName());
        
    }
    /** @test */
    public function it_has_user_relationship()
    {
        $section = new Section;
        $this->assertInstanceOf(BelongsTo::class, $section->user());
    }
    /** @test */
    public function it_has_a_user_relation_with_user_id_foreign_key()
    {
        $section = new Section;
        $this->assertEquals('user_id', $section->user()->getForeignKey());
    }
    /** @test */
    public function it_has_a_user_relationship_with_id_local_key()
    {
        $section = new Section;
        $this->assertEquals('id', $section->user()->getOwnerKey());
    }
}
