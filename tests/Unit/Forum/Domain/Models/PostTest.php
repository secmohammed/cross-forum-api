<?php

namespace Tests\Unit\Forum\Domain\Models;

use App\Forum\Domain\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_has_users_table()
    {
        $post = new Post;
        $this->assertEquals('posts', $post->getTable());
    }
    /** @test */
    public function it_has_all_fillabled_except_for_id()
    {
        $post = new Post;
        $this->assertEquals(['user_id','topic_id','body'], $post->getFillable());
    }
    /** @test */
    public function it_has_a_user_relationship()
    {
        $post = new Post;
        $this->assertInstanceOf(BelongsTo::class, $post->user());
    }
    /** @test */
    public function it_has_a_user_relation_with_user_id_foreign_key()
    {
        $post = new Post;
        $this->assertEquals('user_id', $post->user()->getForeignKey());
    }
    /** @test */
    public function it_has_a_user_relationship_with_id_local_key()
    {
        $post = new Post;
        $this->assertEquals('id', $post->user()->getOwnerKey());
    }
    /** @test */
    public function it_has_a_topic_relationship()
    {
        $post = new Post;
        $this->assertInstanceOf(BelongsTo::class, $post->topic());
    }
    /** @test */
    public function it_has_a_topic_relation_with_user_id_foreign_key()
    {
        $post = new Post;
        $this->assertEquals('topic_id', $post->topic()->getForeignKey());
    }
    /** @test */
    public function it_has_a_topic_relationship_with_id_local_key()
    {
        $post = new Post;
        $this->assertEquals('id', $post->topic()->getOwnerKey());
    }
    /** @test */
    public function it_has_a_self_referencal_relation_for_nested_posts()
    {
        $post = new Post;
        $this->assertInstanceOf(HasOneOrMany::class, $post->children());
    }
    /** @test */
    public function it_has_a_self_referencal_relation_for_nested_posts_with_parent_id_foreign_key()
    {
        $post = new Post;
        $this->assertEquals('parent_id', $post->children()->getForeignKeyName());
    }
    /** @test */
    public function it_has_a_self_referencal_relation_for_nested_posts_with_id_local_key()
    {
        $post = new Post;
        $this->assertEquals('id', $post->children()->getLocalKeyName());
    }
}
