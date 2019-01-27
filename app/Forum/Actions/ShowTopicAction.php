<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Services\ShowTopicService;
use App\Forum\Responders\ShowTopicResponder;

class ShowTopicAction {
	public function __construct(ShowTopicResponder $responder, ShowTopicService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(Topic $topic) {
		return $this->responder->withResponse(
			$this->services->handle($topic)
		)->respond();
	}
}