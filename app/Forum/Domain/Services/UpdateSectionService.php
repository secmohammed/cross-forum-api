<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
class UpdateSectionService extends Service {
    public function handle($data = [], $section = null) {
        $section->update($data);

        return new GenericPayload($section->fresh());
    }
}
