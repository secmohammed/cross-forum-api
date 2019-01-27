<?php

namespace App\Forum\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Forum\Domain\Resources\TopicResource;

class IndexTopicResponder extends Responder implements ResponderInterface {
	public function respond() {
		return TopicResource::collection($this->response->getData());
	}
}
