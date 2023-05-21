<?php

namespace Shisa\Exceptions;


/**
 * An third party dependency failure.
 *
 * This exception can be caused by a failure in the database, an unexpected response
 * from a third-party API, or a network error when connecting to a queue service.
 */
class ServiceError extends ServerError
{
    /**
     * Corresponds to the `MonoLog` library's WARNING level.
     */
    public static $defaultSeverity = 300;

    protected $service = null;

    /**
     * Returns the name of the service that caused the error
     *
     * @return string|null
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the name of the service that caused the error
     *
     * @return static
     */
    public function setService(string $service)
    {
        $this->service = $service;
        return $this;
    }

    public function getContext()
    {
        $context = parent::getContext();
        Helper::assignContext(
            $context,
            'service',
            $this->getService()
        );
        return $context;
    }
}
