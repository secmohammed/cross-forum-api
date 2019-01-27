<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/*
    1- Test PasswordReset Trait
    2- Test Scopes
    3- Test ParseJWTToken middleware
    4- Test Resources
    5- Register Policies.
*/
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;
    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value], 
            [$field => $this->rules[$field]]
        );
    }
    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }

}
