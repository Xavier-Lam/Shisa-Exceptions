<?php

namespace Shisa\Exceptions;


/**
 * This class represents an unexpected error that has occurred in your program.
 * 
 * It is critical to investigate the cause of this error, as it should never occur
 * unless there is a logical loophole in your code. You can treat this error as an
 * assertion that something has gone wrong and requires immediate attention.
 */
class ProgramError extends ServerError
{
    /**
     * Corresponds to the `MonoLog` library's ALERT level.
     */
    public static $defaultSeverity = 550;

    public static $defaultStatusCode = 500;
}
