<?php

use PHPUnit\Framework\TestCase;
use Shisa\Exceptions\ServerError;


class ServerErrorTest extends TestCase
{
    public function testGetSeverityReturnsDefaultSeverity()
    {
        $error = new ServerError();
        $this->assertEquals(400, $error->getSeverity());
    }

    public function testSetSeverityUpdatesSeverity()
    {
        $error = new ServerError();
        $error->setSeverity(500);
        $this->assertEquals(500, $error->getSeverity());
    }

    public function testGetContextReturnsSeverityInContext()
    {
        $error = new ServerError();
        $error->setSeverity(500);
        $context = $error->getContext();
        $this->assertArrayHasKey('severity', $context);
        $this->assertEquals(500, $context['severity']);
    }
}
