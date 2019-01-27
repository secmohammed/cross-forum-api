<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Forum\Domain\Repositories\ForumRepository;
class ShowSectionService extends Service {
    public function handle($section = null) {
        $section->load('topics');
        return new GenericPayload($section);
    }
}
