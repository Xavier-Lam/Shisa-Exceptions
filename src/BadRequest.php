<?php

namespace Shisa\Exceptions;


/**
 * A bad request send by a client
 */
class BadRequest extends ClientError
{
    public static $defaultStatusCode = 400;
}
