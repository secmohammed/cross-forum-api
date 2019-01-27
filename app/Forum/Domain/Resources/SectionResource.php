<?php

namespace App\Forum\Domain\Resources;

use App\Forum\Domain\Resources\TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource {
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
			'description' => $this->description,
			'topics' => TopicResource::collection($this->whenLoaded('topics'))
		];
	}
}
