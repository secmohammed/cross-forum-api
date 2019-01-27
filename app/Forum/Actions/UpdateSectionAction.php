<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Requests\UpdateSectionRequest;
use App\Forum\Domain\Services\UpdateSectionService;
use App\Forum\Responders\UpdateSectionResponder;

class UpdateSectionAction {
    public function __construct(UpdateSectionResponder $responder, UpdateSectionService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(UpdateSectionRequest $request, Section $section) {
        return $this->responder->withResponse(
            $this->services->handle($request->validated(), $section)
        )->respond();
    }
}
