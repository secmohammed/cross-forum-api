<?php

namespace Tests\Unit\Forum\Domain\Resources;
use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Resources\SectionResource;
use App\Forum\Domain\Resources\TopicResource;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class TopicResourceTest extends TestCase 
{
    /** @test */
    public function it_retrieves_basic_topic()
    {
        $topic = factory(Topic::class)->make();
        $topic->setRelation('user',$topic->user);
        $resource = (new TopicResource($topic))->toArray(request());
        $this->assertTrue(array_has($resource,['title','slug','body','diffForHumans','user']));
    }
    /** @test */
    public function it_retrieves_topic_associated_with_section()
    {
        $topic = factory(Topic::class)->make();
        $topic->setRelation('section',$topic->section);
        $resource = (new TopicResource($topic))->toArray(request());
        $this->assertTrue(array_has($resource,['title','slug','body','diffForHumans','user','section']));
        $this->assertEquals(['title','slug','description'], array_keys($resource['section']->toArray(request())));
    }
    /** @test */
    public function it_retrieves_topic_associated_with_posts()
    {
        $topic = factory(Topic::class)->make();
        $posts = factory(Post::class,3)->make();
        $topic->setRelation('posts',$posts);
        $resource = (new TopicResource($topic))->toArray(request());
        $this->assertTrue(array_has($resource,['title','slug','body','diffForHumans','user','posts']));
        $resource['posts']->map(function($post) {
            $this->assertTrue(array_has($post->toArray(request()), ['id','body','user','diffForHumans']));
        });
    }
}
