<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserEndpointFunctionsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    
    public function test_code_for_random_email()
    {
        $milliseconds = floor(microtime(true) * 1000);
        // concat time to always make email unique
        $email1 = $milliseconds."test@email.com";
        $milliseconds = floor(microtime(true) * 1000);
        $email2 = $milliseconds."test@email.com";
        $this->assertTrue($email1!=$email2);
    }
}
