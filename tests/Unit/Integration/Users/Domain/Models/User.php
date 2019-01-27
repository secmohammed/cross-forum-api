<?php

namespace Tests\Unit\Models\Integration\Users\Domain\Models;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Topic;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_has_many_topics()
    {
        $user = factory(User::class)->create();
        $user->topics()->saveMany(
            factory(\App\Forum\Domain\Models\Topic::class,3)->create(['user_id' => $user->id])
        );
        $this->assertCount(3, $user->fresh()->topics);
    }
    /** @test */
    public function it_has_many_posts()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create(['user_id' => $user->id]);

        $user->posts()->saveMany(
            factory(\App\Forum\Domain\Models\Post::class,3)->create(['user_id' => $user->id, 'topic_id' => $topic->id])
        );
        $this->assertCount(3, $user->fresh()->posts);
        
    }
    /** @test */
    public function it_has_many_nested_posts_with_one_parent()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create(['user_id' => $user->id]);
        $post = factory(Post::class)->create(['user_id' => $user->id, 'topic_id' => $topic->id]);
        $user->posts()->saveMany(
            factory(\App\Forum\Domain\Models\Post::class,3)->create(['user_id' => $user->id, 'topic_id' => $topic->id, 'parent_id' => $post->id])
        );
        $this->assertCount(4, $user->fresh()->posts);
        $this->assertEquals(1, $user->fresh()->posts()->parents()->count());
    }
}
