<?php

namespace App\Forum\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Forum\Domain\Resources\TopicResource;

class StoreTopicResponder extends Responder implements ResponderInterface {
	public function respond() {
		return new TopicResource($this->response->getData());
	}
}
