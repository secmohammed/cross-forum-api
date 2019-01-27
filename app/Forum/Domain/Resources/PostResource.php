<?php

namespace App\Forum\Domain\Resources;

use App\Users\Domain\Collection\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'body' => $this->body,
			'user' => new UserResource($this->user),
			'diffForHumans' => $this->created_at->diffForHumans(),
			'post_id' => $this->when(!!$this->post_id, $this->post_id),
			$this->mergeWhen($this->children->count() && !$this->post_id, [
				'children' => PostResource::collection($this->children()->latestFirst()->get()),
			]),
		];
	}
}
