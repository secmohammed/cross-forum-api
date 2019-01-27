<?php

namespace App\Forum\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Forum\Domain\Resources\TopicResource;

class StorePostResponder extends Responder implements ResponderInterface {
	public function respond() {
        if ($this->response->getStatus() != 200) {
            return response()->json($this->response->getData(), $this->response->getStatus());
        }
		return new TopicResource($this->response->getData());
	}
}
