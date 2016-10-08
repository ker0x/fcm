<?php
namespace Kerox\Fcm\Test\TestCase\Message;

use Kerox\Fcm\Message\Exception\InvalidNotificationException;
use Kerox\Fcm\Message\NotificationBuilder;
use Kerox\Fcm\Test\TestCase\AbstractTestCase;

class NotificationBuilderTest extends AbstractTestCase
{
    public function testInvalidColor()
    {
        $this->expectException(InvalidNotificationException::class);
        $optionsBuilder = new NotificationBuilder('title');
        $optionsBuilder->setColor('color');
    }
}