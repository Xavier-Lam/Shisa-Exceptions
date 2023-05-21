<?php

namespace Shisa\Exceptions;


function error_get_last()
{
    return [
        'message' => 'message',
        'type' => E_USER_NOTICE,
        'line' => 1,
        'file' => 'file'
    ];
}
