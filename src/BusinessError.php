<?php

namespace Shisa\Exceptions;


/**
 * Throw a `BusinessError` when a normal logical error occurred and you want to
 * terminate the following procedure. This type of error is not harmful and may not
 * require logging.
 *
 * For example, if a user tries to complete a payment with insufficient funds, you can
 * throw a `BusinessError` to remind them to deposit more money into their account
 * balance.
 */
class BusinessError extends BaseException
{
    private $friendlyMessageSet = false;

    /**
     * Returns a friendly message if one has been set, otherwise returns the error's
     * message.
     *
     * @return string
     */
    public function getFriendlyMessage()
    {
        if ($this->friendlyMessageSet) {
            return parent::getFriendlyMessage();
        } else {
            $message = $this->getMessage();
            return $message ?: parent::getFriendlyMessage();
        }
    }

    public function setFriendlyMessage(string $message)
    {
        $this->friendlyMessageSet = true;
        return parent::setFriendlyMessage($message);
    }
}
