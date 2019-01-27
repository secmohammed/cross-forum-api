<?php

namespace App\Forum\Actions;

use App\Forum\Domain\Models\Post;
use App\Forum\Domain\Models\Topic;
use App\Forum\Domain\Requests\UpdatePostRequest;
use App\Forum\Domain\Services\UpdatePostService;
use App\Forum\Responders\UpdatePostResponder;

class UpdatePostAction {
    public function __construct(UpdatePostResponder $responder, UpdatePostService $services) {
        $this->responder = $responder;
        $this->services = $services;
    }
    public function __invoke(Topic $topic, Post $post, UpdatePostRequest $request) {
        return $this->responder->withResponse(
            $this->services->handle($topic, $post, $request->validated())
        )->respond();
    }
}
