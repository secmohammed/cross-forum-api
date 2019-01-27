<?php

namespace App\Forum\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Forum\Domain\Models\Post;

class PostRepository extends Repository {
    protected $model;
    public function __construct(Post $post) {
        $this->model = $post;
    }
}
