<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests\Model\Message\Notification;

use Kerox\Fcm\Model\Message\Notification\ApnsNotification;
use PHPUnit\Framework\TestCase;

class ApnsNotificationTest extends TestCase
{
    public function testApnsNotificationWithInvalidAlert(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('alert must be a string or an instance of "Kerox\Fcm\Model\Message\Notification\ApnsNotification\Alert".');

        (new ApnsNotification())->setAlert(true);
    }

    public function testApnsNotificationWithStringAlert(): void
    {
        $apnsNotification = (new ApnsNotification())->setAlert('Breaking News');

        self::assertJsonStringEqualsJsonFile(__DIR__ . '/../../../Mocks/Model/basic_apns_notification.json', json_encode($apnsNotification));
    }
}
