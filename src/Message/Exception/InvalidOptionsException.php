<?php
namespace Kerox\Fcm\Message\Exception;

class InvalidOptionsException extends AbstractException
{
    public static function invalidTimeToLive($value)
    {
        return new static("Time to live must be between 0 and 2419200. Current value is: {$value}");
    }

    public static function invalidPriority()
    {
        return new static("Priority can be either 'normal' or 'high'");
    }
}
