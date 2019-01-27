<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Contracts\ServiceInterface;
use App\App\Domain\Payloads\GenericPayload;
use App\Users\Domain\Repositories\UserRepository;

class RegisterUserService implements ServiceInterface {
	protected $users;
	public function __construct(UserRepository $users) {
		$this->users = $users;
	}
	public function handle($data = []) {
		$user = $this->users->create(array_merge($data, ['password' => bcrypt($data['password'])]));
		return new GenericPayload($user);
	}
}