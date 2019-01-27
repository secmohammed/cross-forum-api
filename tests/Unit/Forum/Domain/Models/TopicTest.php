<?php

namespace Tests\Unit\Forum\Domain\Models;

use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Models\Topic;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Tests\TestCase;

class TopicTest extends TestCase
{
    /** @test */
    public function it_has_users_table()
    {
        $topic = new Topic;
        $this->assertEquals('topics', $topic->getTable());
    }
    /** @test */
    public function it_has_all_fillabled_except_for_id()
    {
        $topic = new Topic;
        $this->assertEquals(['title', 'slug', 'body', 'section_id', 'user_id'], $topic->getFillable());
    }
    /** @test */
    public function it_has_user_relationship()
    {
        $topic = new Topic;
        $this->assertInstanceOf(BelongsTo::class, $topic->user());
    }
    /** @test */
    public function it_has_a_user_relation_with_user_id_foreign_key()
    {
        $topic = new Topic;
        $this->assertEquals('user_id', $topic->user()->getForeignKey());
    }
    /** @test */
    public function it_has_a_user_relationship_with_id_local_key()
    {
        $topic = new Topic;
        $this->assertEquals('id', $topic->user()->getOwnerKey());
    }
    /** @test */
    public function it_has_section_relationship()
    {
        $section = new Section;
        $this->assertInstanceOf(BelongsTo::class, $section->user());
    }
    /** @test */
    public function it_has_a_section_relation_with_user_id_foreign_key()
    {
        $section = new Section;
        $this->assertEquals('user_id', $section->user()->getForeignKey());
    }
    /** @test */
    public function it_has_a_section_relationship_with_id_local_key()
    {
        $section = new Section;
        $this->assertEquals('id', $section->user()->getOwnerKey());
    }
      /** @test */
    public function it_has_many_posts_relation()
    {
        $topic = new Topic;
        $this->assertInstanceOf(HasMany::class, $topic->posts());
    }
    /** @test */
    public function it_has_posts_relation_and_topic_id_is_foreign_key()
    {
        $topic = new Topic;
        $this->assertEquals('topic_id', $topic->posts()->getForeignKeyName());
    }
    /** @test */
    public function it_has_posts_relation_and_id_is_local_key()
    {
        $topic = new Topic;
        $this->assertEquals('id',$topic->posts()->getLocalKeyName());
    }
}
