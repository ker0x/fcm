<?php
namespace Kerox\Fcm\Message\Exception;

/**
 * Class InvalidDataException
 * @package Kerox\Fcm\Message\Exception
 */
class InvalidDataException extends AbstractException
{

    public static function invalidKey($key)
    {
        return new static("{$key} does not exist in array data.");
    }
}
