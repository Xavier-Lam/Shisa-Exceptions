<?php

namespace Shisa\Exceptions;


/**
 * An error caused by a bad client request.
 */
class ClientError extends BaseException
{
    public static $defaultPossibility = 100;

    protected $isMalicious = false;

    /**
     * Check if the client request is malicious.
     *
     * @return bool
     */
    public function isMalicious()
    {
        return $this->isMalicious;
    }

    /**
     * Set whether or not the client request is malicious.
     *
     * @param bool $isMalicious
     * @return static
     */
    public function setMalice(bool $isMalicious)
    {
        $this->isMalicious = $isMalicious;
        return $this;
    }

    protected $possibility;

    /**
     * Get the possibility score of the request. You can record the exception and do
     * further analysis according to the score.
     * 
     * For example, if a wrong parameter is caused by a user typo, you can set the
     * possibility to 100, and the exception is not needed to be recorded.
     * If the bad request may have been caused by an automated bot attack, you can set
     * the value to 50 and record it for further analysis.
     * If you are sure the request could never happen if the user is operating their
     * user interface, set it to 0.
     *
     * @return int
     */
    public function getPossibility()
    {
        if (isset($this->possibility)) {
            return $this->possibility;
        }
        return static::$defaultPossibility;
    }

    /**
     * Set the possibility score of the request. You can record the exception and do
     * further analysis according to the score.
     * 
     * For example, if a wrong parameter is caused by a user typo, you can set the
     * possibility to 100, and the exception is not needed to be recorded.
     * If the bad request may have been caused by an automated bot attack, you can set
     * the value to 50 and record it for further analysis.
     * If you are sure the request could never happen if the user is operating their
     * user interface, set it to 0.
     *
     * @param int $possibility
     * @return static
     */
    public function setPossibility(int $possibility)
    {
        $this->possibility = $possibility;
        return $this;
    }

    public function getContext()
    {
        $context = parent::getContext();
        Helper::assignContext($context, 'isMalicious', $this->isMalicious());
        Helper::assignContext($context, 'possibility', $this->getPossibility());
        return $context;
    }
}
