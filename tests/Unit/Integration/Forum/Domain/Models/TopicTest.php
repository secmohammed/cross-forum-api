<?php

namespace Tests\Unit\Models\Integration\Forum\Domain\Models;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Models\Topic;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class TopicTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $topic = factory(Topic::class)->make();
        $topic->user()->associate(
            factory(User::class)->create()
        )->save();
        $this->assertInstanceOf(User::class, $topic->user);
    }
    /** @test */
    public function it_belongs_to_a_section()
    {
        $topic = factory(Topic::class)->make();
        $topic->section()->associate(
            factory(Section::class)->create()
        )->save();
        $this->assertInstanceOf(Section::class, $topic->section);
    }
    /** @test */
    public function it_has_many_posts()
    {
        $topic = factory(Topic::class)->create();
        $topic->posts()->saveMany(
            factory(Post::class,3)->create(['topic_id' => $topic->id])
        );
        $this->assertCount(3, $topic->fresh()->posts);
    }

}
