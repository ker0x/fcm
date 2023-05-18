<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Notification\AndroidNotification;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#lightsettings
 */
final readonly class LightSettings
{
    public function __construct(
        public Color $color,
        public string $lightOnDuration,
        public string $lightOffDuration
    ) {
    }
}
