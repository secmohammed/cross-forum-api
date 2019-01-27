<?php

namespace App\Forum\Domain\Repositories;

use App\App\Domain\Repositories\Repository;
use App\Forum\Domain\Models\Section;

class SectionRepository extends Repository {
	protected $section;
	public function __construct(Section $section) {
		$this->model = $section;
	}
}
