<?php

use PHPUnit\Framework\TestCase;
use Shisa\Exceptions\Forbidden;
use Shisa\Exceptions\SecurityForbidden;

class ForbiddenTest extends TestCase
{
    public function testGetStatusCodeReturnsDefaultStatusCode()
    {
        $error = new Forbidden();
        $this->assertEquals(403, $error->getStatusCode());
        $error = new SecurityForbidden();
        $this->assertEquals(200, $error->getStatusCode());
    }
}
