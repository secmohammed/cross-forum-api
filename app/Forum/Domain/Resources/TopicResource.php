<?php

namespace App\Forum\Domain\Resources;

use App\Forum\Domain\Resources\SectionResource;
use App\Users\Domain\Collection\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'title' => $this->title,
			'slug' => $this->slug,
			'body' => $this->body,
			'diffForHumans' => $this->created_at->diffForHumans(),
			'user' => new UserResource($this->user),
			'section' => new SectionResource($this->whenLoaded('section')),
			'posts' => PostResource::collection($this->whenLoaded('posts')),
		];
	}
}
