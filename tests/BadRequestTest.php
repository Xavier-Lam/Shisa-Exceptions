<?php

use PHPUnit\Framework\TestCase;
use Shisa\Exceptions\BadRequest;
use Shisa\Exceptions\SecurityBadRequest;

class BadRequestTest extends TestCase
{
    public function testGetStatusCodeReturnsDefaultStatusCode()
    {
        $error = new BadRequest();
        $this->assertEquals(400, $error->getStatusCode());
        $error = new SecurityBadRequest();
        $this->assertEquals(200, $error->getStatusCode());
    }
}
