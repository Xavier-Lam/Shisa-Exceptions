<?php

namespace Shisa\Exceptions;

use Exception;
use Throwable;


/**
 * The base exception class for all other custom exceptions.
 */
class BaseException extends Exception
{
    /**
     * Default error code to be used if not provided while creating an exception.
     *
     * @var int $defaultCode
     */
    public static $defaultCode = 0;

    /**
     * Default friendly error message to be displayed to the users.
     *
     * @var string $defaultFriendlyMessage
     */
    public static $defaultFriendlyMessage;

    /**
     * Default HTTP status code to be used in case of this error happened.
     *
     * @var int $defaultStatusCode
     */
    public static $defaultStatusCode = 200;

    /**
     * A shortcut static method to create an instance of this exception.
     *
     * @param string $message The message to be recorded in logs rather than displayed
     *                        directly to users
     * @param int|null $code If not provided, `$defaultCode` will be used
     * @return static
     */
    public static function create(string $message = '', int $code = null)
    {
        is_null($code) && $code = static::$defaultCode;
        return new static($message, $code);
    }

    /**
     * A shortcut static method to create an instance of this exception from another
     * exception.
     *
     * @param Throwable $previous The previous exception
     * @param string $message The message to be recorded in logs rather than displayed
     *                        directly to users
     * @param int|null $code If not provided, `$defaultCode` will be used
     * @return static
     */
    public static function createFrom(Throwable $previous, string $message = '', int $code = null)
    {
        is_null($code) && $code = static::$defaultCode;
        return new static($message, $code, $previous);
    }

    /**
     * A shortcut static method that creates and throws an instance of this exception.
     *
     * @param string $message The message to be recorded in logs rather than displayed
     *                        directly to users
     * @param int|null $code If not provided, `$defaultCode` will be used
     * @throws static
     * @return never
     */
    public static function raise(string $message = '', int $code = null)
    {
        throw static::create($message, $code);
    }

    /**
     * A shortcut static method that creates and throws an instance of this exception
     * from another exception.
     *
     * @param string $message The message to be recorded in logs rather than displayed
     *                        directly to users
     * @param int|null $code If not provided, `$defaultCode` will be used
     * @throws static
     * @return never
     */
    public static function raiseFrom(Throwable $previous, string $message = '', int $code = null)
    {
        throw static::createFrom($previous, $message, $code);
    }

    private $context = [];

    /**
     * Get the context of the error
     * 
     * This method should be used to record useful information that will help in
     * investigating exceptions. The context data should only be logged and never
     * displayed to users.
     *
     * @param array $context
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set the context of the error
     * 
     * This method should be used to record useful information that will help in
     * investigating exceptions. The context data should only be logged and never
     * displayed to users.
     * 
     * Note: The entire context will be replaced with the new array provided.
     *
     * @param array $context An array of additional information to help investigate
     *                       the exception.
     * @return static
     */
    public function setContext(array $context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * Update the context of the error
     * 
     * This method should be used to record useful information that will help in
     * investigating exceptions. The context data should only be logged and never
     * displayed to users.
     * 
     * Note: Existing keys and their corresponding values will be updated with the new
     *       array provided. New keys will be added to the context.
     *
     * @param array $context An array of additional information to help investigate
     *                       the exception.
     * @return static
     */
    public function updateContext(array $context)
    {
        $this->context = $context + $this->context;
        return $this;
    }

    private $extras = [];

    /**
     * Get additional information about the error.
     *
     * This information can be used to provide more information about the error to
     * the client, helping them to better understand the cause and potentially resolve
     * the issue. 
     * 
     * For example, if this is a validation error and the "password" field is missing,
     * you can include {"field": "password", "error": "This field is required"}
     * 
     * @return array
     */
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Set additional information about the error.
     *
     * This information can be used to provide more information about the error to
     * the client, helping them to better understand the cause and potentially resolve
     * the issue. 
     * 
     * For example, if this is a validation error and the "password" field is missing,
     * you can include {"field": "password", "error": "This field is required"}
     * 
     * Note: The entire extras will be replaced with the new array provided.
     * 
     * @return static
     */
    public function setExtras(array $extras)
    {
        $this->extras = $extras;
        return $this;
    }


    /**
     * Update additional information about the error.
     *
     * This information can be used to provide more information about the error to
     * the client, helping them to better understand the cause and potentially resolve
     * the issue. 
     * 
     * For example, if this is a validation error and the "password" field is missing,
     * you can include {"field": "password", "error": "This field is required"}
     * 
     * Note: Existing keys and their corresponding values will be updated with the new
     *       array provided. New keys will be added to the extras.
     * 
     * @return static
     */
    public function updateExtras(array $extras)
    {
        $this->extras = $extras + $this->extras;
        return $this;
    }

    private $friendlyMessage;

    /**
     * Returns the user-friendly message set for this error.
     * Returns `$defaultFriendlyMessage`. If none has been customized.
     *
     * @return string
     */
    public function getFriendlyMessage()
    {
        return isset($this->friendlyMessage) ?
            $this->friendlyMessage
            : static::$defaultFriendlyMessage;
    }

    /**
     * Set a friendly message to display to users when this error occurs.
     *
     * @param string $message
     * @return static
     */
    public function setFriendlyMessage(string $message)
    {
        $this->friendlyMessage = $message;
        return $this;
    }

    private $statusCode;

    /**
     * Returns the HTTP status code that should be returned for the error.
     * `$defaultStatusCode` will be returned if setStatus has never been called.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return isset($this->statusCode) ?
            $this->statusCode
            : static::$defaultStatusCode;
    }

    /**
     * Sets the HTTP status code for the error.
     *
     * @return static
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}


BaseException::$defaultFriendlyMessage  = _('Oops, there is something wrong.');
