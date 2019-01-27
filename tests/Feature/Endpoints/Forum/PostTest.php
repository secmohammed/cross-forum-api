<?php

namespace Tests\Feature\Endpoints\Forum;
use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Resources\TopicResource;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_stores_a_post()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();
        auth()->login($user);
        $this->post('api/topic/' . $topic->id . '/post', [
            'body' => 'Hello There'
        ])->assertStatus(200);
    }
    /** @test */
    public function it_stores_a_nested_post()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();
        auth()->login($user);
        $post = factory(Post::class)->create();
        $resource = new TopicResource($topic);
        $this->post('api/topic/' . $topic->id . '/post', [
            'body' =>'Hello',
            'post_id' => $post->id
        ])->assertStatus(200)->assertResource($resource);
    }
    /** @test */
    public function it_updates_a_post()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();
        $post = factory(Post::class)->create([
            'topic_id' => $topic->id
        ]);
        auth()->login($user);
        $resource = new TopicResource($topic);
        $this->post('api/topic/' . $topic->id . '/post/' . $post->id . '/update', [
            'body' => 'Hello There'
        ])->assertResource($resource)->assertStatus(200);
    }
    /** @test */
    public function it_deletes_a_post()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();
        $post = factory(Post::class)->create([
            'topic_id' => $topic->id
        ]);
        auth()->login($user);
        $resource = new TopicResource($topic);
        $this->delete('api/topic/' . $topic->id . '/post/' . $post->id)->assertResource($resource)->assertStatus(200);
        
    }
}
