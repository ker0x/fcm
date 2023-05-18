<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Notification;

use Kerox\Fcm\Enum\NotificationPriority;
use Kerox\Fcm\Enum\Visibility;
use Kerox\Fcm\Model\Notification\AndroidNotification\LightSettings;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidnotification
 */
final readonly class AndroidNotification
{
    /**
     * @param string[] $titleLocArgs
     * @param string[] $bodyLocArgs
     * @param string[] $vibrateTimings
     */
    public function __construct(
        public string $title,
        public string $body,
        public ?string $icon = null,
        public ?string $color = null,
        public ?string $sound = null,
        public ?string $tag = null,
        public ?string $clickAction = null,
        public ?string $titleLocKey = null,
        public array $titleLocArgs = [],
        public ?string $bodyLocKey = null,
        public array $bodyLocArgs = [],
        public ?string $channelId = null,
        public ?string $ticker = null,
        public bool $sticky = false,
        public ?string $eventTime = null,
        public bool $localOnly = false,
        public ?NotificationPriority $notificationPriority = null,
        public bool $defaultSound = false,
        public bool $defaultVibrateTimings = false,
        public bool $defaultLightSettings = false,
        public array $vibrateTimings = [],
        public ?Visibility $visibility = null,
        public int $notificationCount = 0,
        public ?LightSettings $lightSettings = null,
        public ?string $image = null,
    ) {
    }
}
