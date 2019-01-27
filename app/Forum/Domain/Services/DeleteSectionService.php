<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Forum\Domain\Repositories\ForumRepository;
class DeleteSectionService extends Service {
    public function handle($section = null) {
        $section->delete();
        return new GenericPayload(['message' => 'section has been deleted.']);
    }
}
