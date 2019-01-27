<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Requests\StoreTopicRequest;
use App\Forum\Domain\Services\StoreTopicService;
use App\Forum\Responders\StoreTopicResponder;

class StoreTopicAction {
	public function __construct(StoreTopicResponder $responder, StoreTopicService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(StoreTopicRequest $request) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated())
		)->respond();
	}
}