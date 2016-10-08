<?php
/**
 * Created by PhpStorm.
 * User: rmo
 * Date: 26/09/2016
 * Time: 21:35
 */

namespace Kerox\Fcm\Message\Exception;


class InvalidNotificationException extends AbstractException
{
    public static function invalidColor()
    {
        return new static("The color must be expressed in #rrggbb format.");
    }

    public static function invalidArray()
    {
        return new static("Notification array must contain at least a key 'title'");
    }
}