<?php

namespace Shisa\Exceptions;

use Throwable;


/**
 * An uncaught exception used as a wrapper for other exceptions.
 * 
 * By wrapping an uncaught exception in your error handler, you can handle any kind of
 * error in the same way.
 */
class UncaughtException extends ServerError
{
    /**
     * Corresponds to the `MonoLog` library's CRITICAL level.
     */
    public static $defaultSeverity = 500;

    public static $defaultStatusCode = 500;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        !$previous && NotImplemented::raise();
        parent::__construct($message, $code, $previous);
    }
}
