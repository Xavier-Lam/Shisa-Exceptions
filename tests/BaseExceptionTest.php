<?php

use PHPUnit\Framework\TestCase;
use Shisa\Exceptions\BaseException;


class BaseExceptionTest extends TestCase
{
    public function testCreate()
    {
        $exception = BaseException::create('test message');

        $this->assertSame('test message', $exception->getMessage());
        $this->assertSame(BaseException::$defaultCode, $exception->getCode());

        $exception = BaseException::create('test message', 1);

        $this->assertSame('test message', $exception->getMessage());
        $this->assertSame(1, $exception->getCode());
    }

    public function testCreateFrom()
    {
        $previous = new Exception('previous exception');
        $exception = BaseException::createFrom($previous, 'test message', 1);

        $this->assertSame('test message', $exception->getMessage());
        $this->assertSame(1, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testRaise()
    {
        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('test message');

        BaseException::raise('test message');
    }

    public function testRaiseFrom()
    {
        $previous = new Exception('previous exception');

        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('test message');
        $this->expectExceptionCode(42);

        BaseException::raiseFrom($previous, 'test message', 42);
    }

    public function testGetContext()
    {
        $exception = new BaseException();
        $this->assertEquals([], $exception->getContext());

        $context = ['key' => 'value'];
        $exception->setContext($context);
        $this->assertEquals($context, $exception->getContext());
    }

    public function testSetContext()
    {
        $exception = new BaseException();
        $context = ['key' => 'value'];

        $exception->setContext($context);
        $this->assertEquals($context, $exception->getContext());

        $newContext = ['newKey' => 'newValue'];
        $exception->setContext($newContext);
        $this->assertEquals($newContext, $exception->getContext());
    }

    public function testUpdateContext()
    {
        $exception = new BaseException();
        $context = ['key1' => 'value1'];

        $exception->setContext($context);
        $this->assertEquals($context, $exception->getContext());

        $newContext = ['key2' => 'value2'];
        $exception->updateContext($newContext);
        $expected = [
            'key1' => 'value1',
            'key2' => 'value2'
        ];
        $this->assertEquals($expected, $exception->getContext());

        $updatedContext = ['key1' => 'updatedValue'];
        $exception->updateContext($updatedContext);
        $expected = [
            'key1' => 'updatedValue',
            'key2' => 'value2'
        ];
        $this->assertEquals($expected, $exception->getContext());
    }

    public function testGetExtras()
    {
        $exception = new BaseException();
        $this->assertEquals([], $exception->getExtras());

        $extras = ['key' => 'value'];
        $exception->setExtras($extras);
        $this->assertEquals($extras, $exception->getExtras());
    }

    public function testSetExtras()
    {
        $exception = new BaseException();
        $extras = ['key' => 'value'];

        $exception->setExtras($extras);
        $this->assertEquals($extras, $exception->getExtras());

        $newExtras = ['newKey' => 'newValue'];
        $exception->setExtras($newExtras);
        $this->assertEquals($newExtras, $exception->getExtras());
    }

    public function testUpdateExtras()
    {
        $exception = new BaseException();
        $extras = ['key1' => 'value1'];

        $exception->setExtras($extras);
        $this->assertEquals($extras, $exception->getExtras());

        $newExtras = ['key2' => 'value2'];
        $exception->updateExtras($newExtras);
        $expected = [
            'key1' => 'value1',
            'key2' => 'value2'
        ];
        $this->assertEquals($expected, $exception->getExtras());

        $updatedExtras = ['key1' => 'updatedValue'];
        $exception->updateExtras($updatedExtras);
        $expected = [
            'key1' => 'updatedValue',
            'key2' => 'value2'
        ];
        $this->assertEquals($expected, $exception->getExtras());
    }

    public function testFriendlyMessage()
    {
        $exception = new BaseException();
        $this->assertEquals(BaseException::$defaultFriendlyMessage, $exception->getFriendlyMessage());

        $customMessage = 'This is a custom error message.';
        $exception->setFriendlyMessage($customMessage);
        $this->assertEquals($customMessage, $exception->getFriendlyMessage());

        $updatedMessage = 'This is a updated error message.';
        $exception->setFriendlyMessage($updatedMessage);
        $this->assertEquals($updatedMessage, $exception->getFriendlyMessage());
    }

    public function testStatusCode()
    {
        $exception = new BaseException();
        $this->assertEquals(BaseException::$defaultStatusCode, $exception->getStatusCode());

        $customStatusCode = 404;
        $exception->setStatusCode($customStatusCode);
        $this->assertEquals($customStatusCode, $exception->getStatusCode());

        $newStatusCode = 400;
        $exception->setStatusCode($newStatusCode);
        $this->assertEquals($newStatusCode, $exception->getStatusCode());
    }
}
