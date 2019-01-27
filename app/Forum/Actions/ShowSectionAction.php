<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Section;
use App\Forum\Domain\Services\ShowSectionService;
use App\Forum\Responders\ShowSectionResponder;

class ShowSectionAction {
    public function __construct(ShowSectionResponder $responder, ShowSectionService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Section $section) {
        return $this->responder->withResponse(
            $this->services->handle($section)
        )->respond();
    }
}
