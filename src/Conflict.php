<?php

namespace Shisa\Exceptions;


class Conflict extends ClientError
{
    public static $defaultStatusCode = 409;
}
