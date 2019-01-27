<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Requests\UpdateTopicRequest;
use App\Forum\Domain\Services\UpdateTopicService;
use App\Forum\Responders\UpdateTopicResponder;

class UpdateTopicAction {
    public function __construct(UpdateTopicResponder $responder, UpdateTopicService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(UpdateTopicRequest $request, Topic $topic) {
        return $this->responder->withResponse(
            $this->services->handle($request->validated(), $topic)
        )->respond();
    }
}
