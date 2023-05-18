<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Notification;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#notification
 */
final readonly class Notification
{
    public function __construct(
        public string $title,
        public ?string $body = null,
        public ?string $image = null,
    ) {
    }
}
