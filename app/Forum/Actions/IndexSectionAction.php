<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Services\IndexSectionService;
use App\Forum\Responders\IndexSectionResponder;

/**
 * summary
 */
class IndexSectionAction {
	public function __construct(IndexSectionService $services, IndexSectionResponder $responder) {
		$this->services = $services;
		$this->responder = $responder;
	}
	public function __invoke() {
		return $this->responder->withResponse(
			$this->services->handle()
		)->respond();
	}
}