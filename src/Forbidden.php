<?php

namespace Shisa\Exceptions;


/**
 * Permission denied
 */
class Forbidden extends ClientError
{
    public static $defaultStatusCode = 403;

    protected $user = null;

    /**
     * Get the user associated with the forbidden request
     *
     * @return array|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the user associated with the forbidden request
     *
     * @param array $user
     * @return static
     */
    public function setUser(array $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getContext()
    {
        $context = parent::getContext();
        Helper::assignContext($context, 'forbidden_user', $this->getUser());
        return $context;
    }
}
