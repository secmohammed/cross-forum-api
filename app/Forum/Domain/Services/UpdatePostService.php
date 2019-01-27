<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
class UpdatePostService extends Service {
    public function handle($topic = null, $post = null, $data = []) {
        $post->update($data);
        $topic->load('posts');
        return new GenericPayload($topic);
    }
}
