<?php

namespace App\Users\Actions;

use App\Users\Domain\Requests\LoginRequest;
use App\Users\Domain\Services\LoginUserService;
use App\Users\Responders\LoginUserResponder;

class LoginUserAction {
	public function __construct(LoginUserService $services, LoginUserResponder $responder) {
		$this->services = $services;
		$this->responder = $responder;
	}
	public function __invoke(LoginRequest $request) {
		return $this->responder->withResponse(
			$this->services->handle($request->validated())
		)->respond();
	}
}
