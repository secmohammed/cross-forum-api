<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Services\DeleteSectionService;
use App\Forum\Responders\DeleteSectionResponder;

class DeleteSectionAction {
    public function __construct(DeleteSectionResponder $responder, DeleteSectionService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Section $section) {
        return $this->responder->withResponse(
            $this->services->handle($section
            )
        )->respond();
    }
}
