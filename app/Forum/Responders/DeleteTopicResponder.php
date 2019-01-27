<?php

namespace App\Forum\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;

class DeleteTopicResponder extends Responder implements ResponderInterface {
    public function respond() {
        return response()->json($this->response->getData(), $this->response->getStatus());
    }
}
