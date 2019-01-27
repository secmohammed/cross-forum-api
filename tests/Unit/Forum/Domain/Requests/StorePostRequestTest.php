<?php

namespace Tests\Unit\Forum\Domain\Requests;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Requests\StorePostRequest;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class StorePostRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->rules = (new StorePostRequest)->rules();
        $this->validator = $this->app['validator'];
    }
    /** @test */
    public function it_should_have_a_body()
    {
        $this->assertTrue($this->validateField('body', 'hey'));
    }
    /** @test */
    public function it_can_pass_without_having_post_id()
    {
        $this->assertTrue($this->validateField('post_id',null));
        
    }
    /** @test */
    public function it_should_pass_if_the_passed_post_id_exists_in_database()
    {
        $post = factory(Post::class)->create();
        $this->assertTrue($this->validateField('post_id', $post->id));
    }
}
