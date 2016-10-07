<?php

use ker0x\Fcm\Message\Exception\InvalidNotificationException;
use ker0x\Fcm\Message\NotificationBuilder;

/**
 * Created by PhpStorm.
 * User: rmo
 * Date: 27/09/2016
 * Time: 00:24
 */
class NotificationBuilderTest extends PHPUnit_Framework_TestCase
{
    public function testInvalidColor()
    {
        $this->expectException(InvalidNotificationException::class);
        $optionsBuilder = new NotificationBuilder('title');
        $optionsBuilder->setColor('color');
    }
}