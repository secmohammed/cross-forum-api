<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Forum\Domain\Repositories\TopicRepository;

class StoreTopicService extends Service {
	protected $topics;
	public function __construct(TopicRepository $topics) {
		$this->topics = $topics;
	}
	public function handle($data = []) {
		$data['user_id'] = auth()->id();
		$data['slug'] = str_slug($data['title']);
		return new GenericPayload(
			$this->topics->create($data)
		);
	}
}