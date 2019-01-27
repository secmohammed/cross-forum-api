<?php

namespace App\App\Domain\Payloads;

class UnauthorizedPayload extends Payload {
	protected $status = 401;
}