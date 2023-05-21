<?php

use PHPUnit\Framework\TestCase;
use Shisa\Exceptions\ClientError;

class ClientErrorTest extends TestCase
{
    /**
     * Test that the default possibility score is 100.
     */
    public function testDefaultPossibilityScore()
    {
        $exception = ClientError::create();
        $this->assertEquals(100, $exception->getPossibility());
    }

    /**
     * Test setting and getting the possibility score.
     */
    public function testSetAndGetPossibility()
    {
        $exception = ClientError::create();
        $possibility = 50;
        $chain = $exception->setPossibility($possibility);
        $this->assertSame($exception, $chain);
        $this->assertEquals($possibility, $exception->getPossibility());
    }

    /**
     * Test setting and getting the malicious flag.
     */
    public function testSetAndIsMalicious()
    {
        $exception = ClientError::create();
        $this->assertFalse($exception->isMalicious());

        $exception->setMalice(true);
        $this->assertTrue($exception->isMalicious());
    }

    /**
     * Test getContext method returns correct context.
     */
    public function testGetContext()
    {
        $exception = ClientError::create();
        $exception->setMalice(true);
        $exception->setPossibility(50);

        $context = $exception->getContext();

        $this->assertArrayHasKey('isMalicious', $context);
        $this->assertEquals(true, $context['isMalicious']);

        $this->assertArrayHasKey('possibility', $context);
        $this->assertEquals(50, $context['possibility']);

        $exception->setContext([
            'isMalicious' => null,
            'possibility' => null,
        ]);
        $context = $exception->getContext();
        $this->assertEquals(true, $context['isMalicious']);
        $this->assertEquals(50, $context['possibility']);
    }
}
