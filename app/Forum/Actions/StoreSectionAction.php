<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Requests\StoreSectionRequest;
use App\Forum\Domain\Services\StoreSectionService;
use App\Forum\Responders\StoreSectionResponder;

class StoreSectionAction {
    public function __construct(StoreSectionResponder $responder, StoreSectionService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(StoreSectionRequest $request) {
        return $this->responder->withResponse(
            $this->services->handle($request->validated())
        )->respond();
    }
}
