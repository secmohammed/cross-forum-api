<?php

namespace Tests\Unit\Models\Integration\Forum\Domain\Models;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Topic;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
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
    public function it_belongs_to_a_topic()
    {
        $post = factory(Post::class)->make();
        $post->topic()->associate(
            factory(Topic::class)->create()
        )->save();
        $this->assertInstanceOf(Topic::class, $post->topic);
    }

    /** @test */
    public function it_has_nested_posts_using_self_referencal_relation()
    {
        $post = factory(Post::class)->create();
        factory(Post::class,3)->create([
            'parent_id' => $post->id
        ]);
        $this->assertCount(3, $post->children);
    }
    /** @test */
    public function it_has_nested_posts_and_one_parent_for_each_post()
    {
        $post = factory(Post::class)->create();
        $posts = factory(Post::class, 3)->create([
            'parent_id' => $post->id
        ]);
        $posts->each(function($post){
            $this->assertEquals(1, $post->parents()->first()->id);
        });
    }
}
