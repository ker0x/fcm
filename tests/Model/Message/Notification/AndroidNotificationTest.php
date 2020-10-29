<?php

declare(strict_types=1);

namespace Kerox\Fcm\Tests\Model\Message\Notification;

use Kerox\Fcm\Model\Message\Notification\AndroidNotification\Color;
use Kerox\Fcm\Model\Message\Notification\AndroidNotification\LightSettings;
use PHPUnit\Framework\TestCase;

class AndroidNotificationTest extends TestCase
{
    public function testLightSettingsWithInvalidColor(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('RGBA value must be between 0 and 1.');

        (new LightSettings(
            new Color(0.1, 0.2, 0.3, 2),
            '3,5s',
            '3,5s'
        ));
    }
}
