<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Requests\StorePostRequest;
use App\Forum\Domain\Services\StorePostService;
use App\Forum\Responders\StorePostResponder;

class StorePostAction {
	public function __construct(StorePostResponder $responder, StorePostService $services) {
		$this->responder = $responder;
		$this->services = $services;
	}
	public function __invoke(StorePostRequest $request, Topic $topic) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated(), $topic)
		)->respond();
	}
}