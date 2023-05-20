<?php

declare(strict_types=1);

namespace Kerox\Fcm\Model\Option;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages?hl=fr#webpushfcmoptions
 */
final readonly class WebpushFcmOptions
{
    public function __construct(
        public ?string $analyticsLabel = null,
        public ?string $link = null,
    ) {
    }
}
