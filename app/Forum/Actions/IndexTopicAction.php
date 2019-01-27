<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Requests\IndexTopicRequest;
use App\Forum\Domain\Services\IndexTopicService;
use App\Forum\Responders\IndexTopicResponder;

class IndexTopicAction {
	public function __construct(IndexTopicResponder $responder, IndexTopicService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(IndexTopicRequest $request) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated())
		)->respond();
	}
}