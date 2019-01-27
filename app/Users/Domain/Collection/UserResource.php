<?php

namespace App\Users\Domain\Collection;

use App\Forum\Domain\Resources\TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'username' => $this->username,
			'email' => $this->email,
			'avatar' => $this->avatar(),
			'topics' => TopicResource::collection($this->whenLoaded('topics'))
		];
	}
}
