<?php
/**
 * Created by PhpStorm.
 * User: rmo
 * Date: 27/09/2016
 * Time: 02:05
 */

namespace ker0x\Fcm\Message\Exception;


class InvalidDataException extends AbstractException
{
    public static function invalidKey($key)
    {
        return new static("{$key} does not exist in array data.");
    }
}