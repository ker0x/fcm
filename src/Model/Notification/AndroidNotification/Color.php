<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Notification\AndroidNotification;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#Color
 */
final readonly class Color
{
    public function __construct(
        public float $red,
        public float $green,
        public float $blue,
        public float $alpha
    ) {
    }
}
