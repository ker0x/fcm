<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Config;

use Kerox\Fcm\Model\Notification\WebpushNotification;
use Kerox\Fcm\Model\Option\WebpushFcmOptions;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#webpushconfig
 */
final readonly class WebpushConfig
{
    /**
     * @param array<string, string> $headers
     * @param array<string, string> $data
     */
    public function __construct(
        public array $headers = [],
        public array $data = [],
        public ?WebpushNotification $notification = null,
        public ?WebpushFcmOptions $options = null,
    ) {
    }
}
