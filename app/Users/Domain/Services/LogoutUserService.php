<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use App\Users\Domain\Repositories\UserRepository;
class LogoutUserService extends Service {
    protected $users;
    public function __construct(UserRepository $users) {
        $this->users = $users;
    }
    public function handle($data = []) {
        auth()->logout();
        return new GenericPayload(['message' => 'Catch you soon.']);
    }
}
