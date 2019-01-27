<?php

namespace Tests\Unit\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_has_users_table()
    {
        $user = new User;
        $this->assertEquals('users', $user->getTable());
    }
    /** @test */
    public function it_has_fillable()
    {
        $user = new User;
        $this->assertEquals([
        'username', 'email', 'password',
        ], $user->getFillable());
    }
    /** @test */
    public function it_has_password_and_remember_token_hidden()
    {
        $user = new User;
        $this->assertCount(2, $user->getHidden());
    }
    /** @test */
    public function it_has_many_topics_relation()
    {
        $user = new User;
        $this->assertInstanceOf(HasMany::class, $user->topics());
    }
    /** @test */
    public function it_has_topics_relation_and_user_id_is_foreign_key()
    {
        $user = new User;
        $this->assertEquals('user_id', $user->topics()->getForeignKeyName());
    }
    /** @test */
    public function it_has_topics_relation_and_id_is_local_key()
    {
        $user = new User;
        $this->assertEquals('id',$user->topics()->getLocalKeyName());
    }
    /** @test */
    public function it_has_many_posts_relation()
    {
        $user = new User;
        $this->assertInstanceOf(HasMany::class, $user->posts());
    }
        /** @test */
    public function it_has_posts_relation_and_user_id_is_foreign_key()
    {
        $user = new User;
        $this->assertEquals('user_id', $user->posts()->getForeignKeyName());
    }
    /** @test */
    public function it_has_posts_relation_and_id_is_local_key()
    {
        $user = new User;
        $this->assertEquals('id',$user->posts()->getLocalKeyName());
    }
    /** @test */
    public function it_has_avatar()
    {
        $user = new User(['email' => 'mohammedosama@ieee.org']);
        $this->assertEquals('http://www.gravatar.com/avatar/' . md5('mohammedosama@ieee.org') . '?s=45&d=mm', $user->avatar());
    }
}
