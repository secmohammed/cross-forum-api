<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Contracts\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;

class AuthorizedUserService implements ServiceInterface {
	public function handle($data = []) {
		return new GenericPayload(auth()->user());
	}
}
