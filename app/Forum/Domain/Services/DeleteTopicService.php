<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
class DeleteTopicService extends Service {
    public function handle($topic = null) {
        $topic->delete();
        return new GenericPayload(['message' => 'Topic has been deleted successfully']);
    }
}
