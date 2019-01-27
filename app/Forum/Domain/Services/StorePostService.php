<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;

class StorePostService extends Service {
	public function handle($data = [], $topic = []) {
		$topic->posts()->create([
			'user_id' => auth()->id(),
			'body' => $data['body'],
		]);
		$topic->load('posts');
		return new GenericPayload($topic);
	}
}
