<?php

namespace Shisa\Exceptions;


/**
 * Represents a PHP fatal error as an exception that can be handled like other
 * exceptions.
 * It encapsulates an error retrieved using `last_get_error`.
 */
class FatalError extends ServerError
{
    /**
     * Corresponds to the `MonoLog` library's `EMERGENCY` level.
     */
    public static $defaultSeverity = 600;

    public static $defaultStatusCode = 500;

    /**
     * A shortcut to create an instance of this class from an unrecoverable error. 
     *
     * @return static
     */
    public static function createFromLastError()
    {
        return static::_createFromLastError();
    }

    /**
     * A shortcut to throw an instance of this class from an unrecoverable error.
     * This is usually called in a shutdown function, when an unrecoverable error is
     * detected.
     *
     * @throws static
     * @return never
     */
    public static function raiseFromLastError()
    {
        throw static::_createFromLastError();
    }

    /**
     * Creates a new instance of this class from a PHP error array.
     *
     * @param array $error Error returned from `last_get_error`.
     * @return static
     */
    public static function createFromError(array $error, array $trace)
    {
        $exception = new static(
            $error['message'],
            $error['type']
        );

        $exception->line = $error['line'];
        $exception->file = $error['file'];

        $exception->setContext([
            'error_trace' => $trace
        ]);

        return $exception;
    }

    /**
     * Returns the error trace associated with this exception instead of using
     * `getTrace`.
     * 
     * @return array
     */
    public function getErrorTrace()
    {
        return $this->getContext()['error_trace'];
    }

    private static function _createFromLastError()
    {
        $error = error_get_last();
        // ignore caller
        $trace = array_slice(debug_backtrace(), 2);
        return static::createFromError($error, $trace);
    }
}
