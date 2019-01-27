<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
class UpdateTopicService extends Service {
    public function handle($data = [], $topic = null) {
        $topic->update($data);
        return new GenericPayload($topic->fresh());
    }
}
