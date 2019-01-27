<?php

namespace App\Forum\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Forum\Domain\Models\Topic;

class TopicRepository extends Repository {
    protected $model;
    public function __construct(Topic $topic) {
        $this->model = $topic;
    }
}
