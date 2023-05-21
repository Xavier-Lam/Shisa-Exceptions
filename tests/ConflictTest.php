<?php

use PHPUnit\Framework\TestCase;
use Shisa\Exceptions\Conflict;

class ConflictTest extends TestCase
{
    public function testGetStatusCodeReturnsDefaultStatusCode()
    {
        $error = new Conflict();
        $this->assertEquals(409, $error->getStatusCode());
    }
}
