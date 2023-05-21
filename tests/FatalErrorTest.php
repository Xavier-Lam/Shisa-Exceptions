<?php

use PHPUnit\Framework\TestCase;
use Shisa\Exceptions\FatalError;


require_once __DIR__ . './MockErrorGetLast.php';


class FatalErrorTest extends TestCase
{
    public function testCreateFromLastError()
    {
        $message = 'message';
        $type = E_USER_NOTICE;
        $line = 1;
        $file = 'file';
        $trace = debug_backtrace();

        $exception = FatalError::createFromLastError();
        $this->assertInstanceOf(FatalError::class, $exception);
        $this->assertEquals($type, $exception->getCode());
        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($file, $exception->getFile());
        $this->assertEquals($line, $exception->getLine());
        $this->assertEquals($trace, $exception->getErrorTrace());
    }

    public function testRaiseFromLastError()
    {
        $message = 'message';
        $type = E_USER_NOTICE;
        $line = 1;
        $file = 'file';
        $trace = debug_backtrace();

        // Trigger a fatal error
        try {
            FatalError::raiseFromLastError();
        } catch (FatalError $exception) {
            $this->assertInstanceOf(FatalError::class, $exception);
            $this->assertEquals($type, $exception->getCode());
            $this->assertEquals($message, $exception->getMessage());
            $this->assertEquals($file, $exception->getFile());
            $this->assertEquals($line, $exception->getLine());
            $this->assertEquals($trace, $exception->getErrorTrace());
            return;
        }

        $this->assertFalse(true);
    }

    public function testCreateFromError()
    {
        $error = [
            'type' => E_WARNING,
            'message' => 'This is a warning message',
            'file' => '/path/to/another/file.php',
            'line' => 20,
        ];
        $trace = debug_backtrace();

        $exception = FatalError::createFromError($error, $trace);
        $this->assertInstanceOf(FatalError::class, $exception);
        $this->assertEquals($error['type'], $exception->getCode());
        $this->assertEquals($error['message'], $exception->getMessage());
        $this->assertEquals($error['file'], $exception->getFile());
        $this->assertEquals($error['line'], $exception->getLine());
        $this->assertEquals($trace, $exception->getContext()['error_trace']);
    }

    public function testGetErrorTrace()
    {
        $error = [
            'type' => E_NOTICE,
            'message' => 'Undefined variable: foo',
            'file' => '/path/to/one/more/file.php',
            'line' => 30,
        ];
        $trace = debug_backtrace();

        $exception = FatalError::createFromError($error, $trace);
        $this->assertEquals($trace, $exception->getErrorTrace());
    }

    public function testGetStatusCodeReturnsDefaultStatusCode()
    {
        $error = new FatalError();
        $this->assertEquals(500, $error->getStatusCode());
    }

    public function testGetSeverityReturnsDefaultSeverity()
    {
        $error = new FatalError();
        $this->assertEquals(600, $error->getSeverity());
    }
}
