<?php

namespace Tests\Feature\Endpoints\Forum;
use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Resources\SectionResource;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class SectionTest extends TestCase
{
    /** @test */
    public function it_fetches_all_sections()
    {
        $sections = factory(Section::class,3)->create();
        $resource = SectionResource::collection($sections);
        $this->get('api/section')->assertStatus(200)->assertResource($resource);
    }
    /** @test */
    public function it_shows_a_section()
    {
        $section = factory(Section::class)->create();
        $resource = new SectionResource($section);
        $this->get('api/section/' . $section->id)->assertStatus(200)->assertResource($resource);
    }
    /** @test */
    public function it_shows_an_error_message_for_showing_invalid_section()
    {
        $this->get('api/section/1')->assertStatus(404);
    }
    /** @test */
    public function it_stores_a_section()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $this->post('api/section',[
            'title' => 'example',
            'description' => 'donqwodnwqd'
        ],[
            'Authorization' => 'Bearer '. auth()->getToken()
        ])->assertStatus(201)->assertJsonStructure(['data' => ['title','description','slug']]);
    }
    /** @test */
    public function it_updates_a_section()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $section = factory(Section::class)->create();
        $this->post('api/section/' . $section->id . '/update',[
            'title' => 'example',
            'description' => 'donqwodnwqd'
        ],[
            'Authorization' => 'Bearer '. auth()->getToken()
        ])->assertStatus(200)->assertJsonStructure(['data' => ['title','description','slug']]);
                
    }
    /** @test */
    public function it_deletes_a_section()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $section = factory(Section::class)->create();
        $this->delete('api/section/' . $section->id,[
            'Authorization' => 'Bearer '. auth()->getToken()
        ])->assertStatus(200)->assertJsonStructure(['message']);
        
    }
    /** @test */
    public function it_requires_authorization_to_store_a_section()
    {
        $this->post('api/section',[
            'title' => 'example',
            'description' => 'donqwodnwqd'
        ])->assertStatus(401);
        
    }
    /** @test */
    public function it_requires_authorization_to_update_a_section()
    {
        $section = factory(Section::class)->create();
        $this->post('api/section/' . $section->id . '/update',[
            'title' => 'example',
            'description' => 'donqwodnwqd'
        ])->assertStatus(401);
        
    }
    /** @test */
    public function it_requires_authorization_to_delete_a_section()
    {
        $section = factory(Section::class)->create();
        $this->delete('api/section/' . $section->id)->assertStatus(401);
        
    }
}
