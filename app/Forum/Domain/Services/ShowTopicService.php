<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Forum\Domain\Repositories\TopicRepository;

class ShowTopicService extends Service {
	protected $topics;
	public function __construct(TopicRepository $topics) {
		$this->topics = $topics;
	}
	public function handle($data = []) {
		return new GenericPayload($data);
	}
}