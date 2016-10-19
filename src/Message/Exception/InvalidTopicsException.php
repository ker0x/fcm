<?php
namespace Kerox\Fcm\Message\Exception;

/**
 * Class InvalidTopicsException
 * @package Kerox\Fcm\Message\Exception
 */
class InvalidTopicsException extends AbstractException
{

    public static function tooManyConditions()
    {
        return new static("There is too many conditions for topics. Only 2 conditions accepted.");
    }
}
