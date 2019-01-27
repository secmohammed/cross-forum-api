<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Services\DeletePostService;
use App\Forum\Responders\DeletePostResponder;

class DeletePostAction {
    public function __construct(DeletePostResponder $responder, DeletePostService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Topic $topic, Post $post) {
        return $this->responder->withResponse(
            $this->services->handle($topic, $post)
        )->respond();
    }
}
