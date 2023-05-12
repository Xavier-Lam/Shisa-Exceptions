<?php

namespace Shisa\Exceptions;

class Helper
{
    public static function assignContext(&$context, $key, $value)
    {
        if (array_key_exists($key, $context)) {
            trigger_error(
                "`$key` property in context will be replaced",
                E_USER_WARNING
            );
        }
        $context[$key] = $value;
    }
}
