<?php

namespace Tests\Feature\Endpoints\Forum;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Resources\TopicResource;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class TopicTest extends TestCase
{
    /** @test */
    public function it_stores_a_topic()
    {
        $section = factory(Section::class)->create();
        $user = factory(User::class)->create();
        auth()->login($user);
        $this->post('api/topic', [
            'section_id' => $section->id,
            'title' => 'Example',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, atque!'
        ], [
            'Authorization' => 'Bearer '. auth()->getToken() 
        ])->assertStatus(201)->assertJsonStructure(['data' => ['title','body']]);
    }
    /** @test */
    public function it_fetches_topics_for_specific_section()
    {
        $section = factory(Section::class)->create();
        $topics = factory(Topic::class,3)->create([
            'section_id' => $section->id
        ]);
        $resource = TopicResource::collection($topics);
        $this->get('api/topic?section_id='. $section->id)->assertStatus(200)->assertResource($resource);
    }
    /** @test */
    public function it_shows_a_topic()
    {
        $section = factory(Section::class)->create();
        $topic = factory(Topic::class)->create([
            'section_id' => $section->id
        ]);
        $resource = new TopicResource($topic);
        $this->get('/api/topic/' . $topic->id)->assertStatus(200)->assertResource($resource);
    }
    /** @test */
    public function it_updates_a_topic()
    {
        $topic = factory(Topic::class)->create();
        $user = factory(User::class)->create();
        auth()->login($user);
        $this->post('api/topic/' . $topic->id . '/update', [
            'title' => 'Example',
            'section_id' => $topic->section_id,
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, atque!'
        ], [
            'Authorization' => 'Bearer '. auth()->getToken() 
        ])->assertStatus(200)->assertJsonStructure(['data' => ['title','body']]);
    }
    /** @test */
    public function it_deletes_a_topic()
    {
        $topic = factory(Topic::class)->create();
        $user = factory(User::class)->create();
        auth()->login($user);
        $this->delete('api/topic/'. $topic->id, [
            'Authorization' => 'Bearer ' . auth()->getToken()
        ])->assertStatus(200)->assertJsonStructure(['message']);
    }
}
