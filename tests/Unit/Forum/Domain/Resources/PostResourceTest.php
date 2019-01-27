<?php

namespace Tests\Unit\Forum\Domain\Resources;
use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Resources\PostResource;
use App\Users\Domain\Models\User;
use Illuminate\Http\Resources\MissingValue;
use Tests\TestCase;

class PostResourceTest extends TestCase 
{
    /** @test */
    public function it_returns_post_associated_with_the_user()
    {
        $user = factory(User::class)->make();
        $post = factory(Post::class)->make();
        $post->setRelation('user', $user);
        $resource = (new PostResource($post))->toArray(request());
        $this->assertTrue(array_has($resource,['user','body','id','diffForHumans']));
        $this->assertInstanceOf(MissingValue::class, $resource['post_id']);
        $this->assertInstanceOf(MissingValue::class, $resource[0]);
    }
    /** @test */
    public function it_returns_post_associated_with_children()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $children = factory(Post::class,5)->create();
        $post->children()->saveMany($children);
        $resource = (new PostResource($post))->toArray(request());
        $this->assertTrue(array_has($resource,['user','body','id','diffForHumans']));
        $this->assertCount(5, $resource[0]->data['children']);
        $resource[0]->data['children']->map(function($child){
            $this->assertTrue(array_has($child->toArray(request()), ['id','body','user','diffForHumans']));
        });
    }
}
