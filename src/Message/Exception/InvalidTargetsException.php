<?php
namespace ker0x\Fcm\Message\Exception;

class InvalidTargetsException extends AbstractException
{
    public static function invalidTarget()
    {
        return new static("Target must be a string or an array with at least 1 token.");
    }
}