<?php

namespace App\Forum\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Forum\Domain\Repositories\SectionRepository;
class StoreSectionService extends Service {
    protected $sections;
    public function __construct(SectionRepository $sections) {
        $this->sections = $sections;
    }
    public function handle($data = []) {
        return new GenericPayload($this->sections->create($data));
    }
}
