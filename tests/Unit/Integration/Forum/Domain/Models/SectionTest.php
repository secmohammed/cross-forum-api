<?php

namespace Tests\Unit\Models\Integration\Forum\Domain\Models;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Topic;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class SectionTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_user()
    {
        $post = factory(Post::class)->make();
        $post->user()->associate(
            factory(User::class)->create()
        )->save();
        $this->assertInstanceOf(User::class, $post->user);
    }
    /** @test */
    public function it_has_many_topics()
    {
        $user = factory(User::class)->create();
        $user->topics()->saveMany(
            factory(Topic::class,3)->create(['user_id' => $user->id])
        );
        $this->assertCount(3, $user->fresh()->topics);
    }

}
