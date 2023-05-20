<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Notification;

use Kerox\Fcm\Enum\Direction;
use Kerox\Fcm\Enum\Permission;

/**
 * @see https://developer.mozilla.org/en-US/docs/Web/API/Notification
 */
final class WebpushNotification
{
    /**
     * @param array<int, array{action: string, title: string, icon: string}> $actions
     * @param array<string, mixed>                                           $data
     * @param int[]                                                          $vibrate
     */
    public function __construct(
        public Permission $permission = Permission::Default,
        public ?int $maxActions = null,
        public array $actions = [],
        public ?string $badge = null,
        public ?string $body = null,
        public array $data = [],
        public Direction $direction = Direction::Auto,
        public ?string $lang = null,
        public ?string $tag = null,
        public ?string $icon = null,
        public ?string $image = null,
        public bool $renotify = false,
        public bool $requireInteraction = false,
        public bool $silent = false,
        public ?int $timestamp = null,
        public ?string $title = null,
        public array $vibrate = [],
    ) {
    }
}
