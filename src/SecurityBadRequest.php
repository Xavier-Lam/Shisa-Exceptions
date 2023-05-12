<?php

namespace Shisa\Exceptions;


/**
 * This class extends the `BadRequest` exception but changes the default status code
 * to 200 to make the client think that their request has been accepted.
 * 
 * This is done to prevent malicious users from adjusting their script and improving
 * the attack, since they might realise their request has been blocked and figure out
 * another way to bypass it.
 */
class SecurityBadRequest extends BadRequest
{
    public static $defaultStatusCode = 200;
}
