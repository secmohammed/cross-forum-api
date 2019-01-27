<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Services\DeleteTopicService;
use App\Forum\Responders\DeleteTopicResponder;

class DeleteTopicAction {
    public function __construct(DeleteTopicResponder $responder, DeleteTopicService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Topic $topic) {
        return $this->responder->withResponse(
            $this->services->handle($topic)
        )->respond();
    }
}
