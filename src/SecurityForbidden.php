<?php

namespace Shisa\Exceptions;


/**
 * This class extends the `Forbidden` exception but changes the default status code
 * to 200 to make the client think that their request has been accepted.
 */
class SecurityForbidden extends Forbidden
{
    public static $defaultStatusCode = 200;
}
