<?php

namespace Tests\Unit\Users\Domain\Resources;

use App\Forum\Domain\Models\Topic;
use App\Users\Domain\Collection\UserResource;
use App\Users\Domain\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UserResourceTest extends TestCase 
{
    /** @test */
    public function it_returns_basic_user()
    {
        $user = new User([
            'username' => 'Jonh',
            'email' => 'jonh@example.com',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $resource = (new UserResource($user))->toArray(request());
        $this->assertEquals(['username','email','avatar','topics'], array_keys($resource));
        $this->assertNull($resource['topics']->collection);
    }
    /** @test */
    public function it_returns_topics_associated_with_user()
    {
        $user = factory(User::class)->make();
        $topics = factory(Topic::class,3)->make();
        $user->setRelation('topics', $topics);
        $resource = (new UserResource($user))->toArray(request());
        $this->assertEquals(['username','email','avatar','topics'], array_keys($resource));
        $this->assertCount(3, $resource['topics']);
        $resource['topics']->map(function ($topic) {
            $this->assertEquals(['title','slug','body','diffForHumans','user','section','posts'], array_keys($topic->toArray(request())));
        });
    }
}
