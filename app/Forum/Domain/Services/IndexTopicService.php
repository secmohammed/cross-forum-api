<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Forum\Domain\Repositories\SectionRepository;
use App\Forum\Domain\Repositories\TopicRepository;

class IndexTopicService extends Service {
	protected $topics, $sections;
	public function __construct(TopicRepository $topics, SectionRepository $sections) {
		$this->topics = $topics;
		$this->sections = $sections;
	}
	public function handle($data = []) {
		return new GenericPayload(
			$this->sections->find($data['section_id'])->topics()->latestFirst()->get()
		);
	}
}