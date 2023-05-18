<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Config;

use Kerox\Fcm\Model\Notification\ApnsNotification;
use Kerox\Fcm\Model\Option\ApnsFcmOptions;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#apnsconfig
 */
final readonly class ApnsConfig
{
    /**
     * @param array<string, string> $headers
     */
    public function __construct(
        public array $headers = [],
        public ?ApnsNotification $payload = null,
        public ?ApnsFcmOptions $options = null,
    ) {
    }
}
