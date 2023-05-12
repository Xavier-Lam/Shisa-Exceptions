<?php

namespace Shisa\Exceptions;


/**
 * An error caused by the server-side.
 */
class ServerError extends BaseException
{
    /**
     * Corresponds to the `MonoLog` library's ERROR level.
     */
    public static $defaultSeverity = 400;

    private $severity;

    /**
     * Returns the severity score associated with this `ServerError`.
     *
     * The severity score can be used to determine the log level.
     * For example, a MySQL failure may be considered more severe than a timeout for
     * a third-party API request.
     *
     * @return int
     */
    public function getSeverity()
    {
        if (isset($this->severity)) {
            return $this->severity;
        }
        return static::$defaultSeverity;
    }

    /**
     * Set the severity score associated with this `ServerError`.
     *
     * The severity score can be used to determine the log level.
     * For example, a MySQL failure may be considered more severe than a timeout for
     * a third-party API request.
     *
     * @param int $severity
     * @return static
     */
    public function setSeverity(int $severity)
    {
        $this->severity = $severity;
        return $this;
    }

    public function getContext()
    {
        $context = parent::getContext();
        Helper::assignContext($context, 'severity', $this->getSeverity());
        return $context;
    }
}
