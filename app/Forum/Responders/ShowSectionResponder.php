<?php

namespace App\Forum\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Forum\Domain\Resources\SectionResource;

class ShowSectionResponder extends Responder implements ResponderInterface {
    public function respond() {
        return new SectionResource($this->response->getData());
    }
}
