<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Config;

use Kerox\Fcm\Enum\AndroidMessagePriority;
use Kerox\Fcm\Model\Notification\AndroidNotification;
use Kerox\Fcm\Model\Option\AndroidFcmOptions;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidconfig
 */
final readonly class AndroidConfig
{
    /**
     * @param array<string, string> $data
     */
    public function __construct(
        public ?string $collapseKey = null,
        public ?AndroidMessagePriority $priority = null,
        public ?string $ttl = null,
        public ?string $restrictedPackageName = null,
        public array $data = [],
        public ?AndroidNotification $notification = null,
        public ?AndroidFcmOptions $options = null,
        public bool $directBootOk = false,
    ) {
    }
}
