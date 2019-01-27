<?php

namespace App\Forum\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Forum\Domain\Resources\SectionResource;

/**
 * summary
 */
class IndexSectionResponder extends Responder implements ResponderInterface {
	public function respond() {
		return SectionResource::collection($this->response->getData());
	}
}