<?php
namespace Kerox\Fcm\Message\Exception;

use Exception;

abstract class AbstractException extends Exception
{
    public static function arrayEmpty()
    {
        return new static("Array can not be empty.");
    }
}
