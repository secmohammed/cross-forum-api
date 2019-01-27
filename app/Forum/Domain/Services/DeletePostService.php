<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
class DeletePostService extends Service {
    public function handle($topic = null, $post = null) {
        $post->delete();
        $topic->load('posts');
        return new GenericPayload($topic);
    }
}
